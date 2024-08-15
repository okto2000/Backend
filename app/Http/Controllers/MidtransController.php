<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use App\Services\CreateSnapTokenService;
use Midtrans\Notification;
use Midtrans\Config;

class MidtransController extends Controller
{
    public function gettoken(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'gross_amount' => 'required|numeric',
            'items' => 'required|array',
            'items.*.id' => 'required|integer',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer',
            'items.*.name' => 'required|string',
            'id_customer' => 'required|integer',
            'address' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $order = $request->only([
            'order_id',
            'gross_amount',
            'id_customer',
            'address',
            'name',
            'email',
            'phone',
            'items'
        ]);

        $midtrans = new CreateSnapTokenService($order);
        $snapToken = $midtrans->getSnapToken();

        $transaction = Transaction::create([
            'id' => $order['order_id'],
            'id_customer' => $order['id_customer'],
            'transaction_date' => now(),
            'address' => $order['address'],
            'payment_method' => $request->input('payment_method'),
            'status' => 'belum dibayar',
            'total' => array_reduce($order['items'], function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0),
        ]);

        // Simpan data ke tabel transaction_details
        foreach ($order['items'] as $item) {
            TransactionDetail::create([
                'id_transaction' => $transaction->id,
                'id_product' => $item['id'],
                'price' => $item['price'],
                'qty' => $item['quantity'],
                'transaction_date' => now(),
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        return response()->json(["token" => $snapToken]);
    }
    public function handleNotification()
    {
        $this->configureMidtrans();

        $notification = new Notification();
        $transaction = Transaction::find($notification->order_id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $this->updateTransactionStatus($transaction, $notification->transaction_status);

        return response()->json(['message' => 'Transaction status updated']);
    }

    protected function configureMidtrans()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    protected function updateTransactionStatus(Transaction $transaction, string $status)
    {
        switch ($status) {
            case 'capture':
            case 'settlement':
                $transaction->status = 'dibayar';
                $transaction->payment_method = $this->getPaymentMethodFromNotification();
                break;
            case 'pending':
                $transaction->status = 'pending';
                break;
            case 'deny':
            case 'cancel':
            case 'expire':
                $transaction->status = 'gagal';
                break;
            case 'refund':
                $transaction->status = 'refund';
                break;
        }

        $transaction->save();
    }
    protected function getPaymentMethodFromNotification(): string
    {
        $notification = new Notification();
        return $notification->payment_type; // Mengambil payment_method dari notifikasi Midtrans
    }
}
