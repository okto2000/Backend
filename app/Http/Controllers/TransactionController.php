<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends BaseController
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', '');
        $transactions = Transaction::where('id_customer', 'LIKE', '%' . $search . '%')->paginate($perPage);
        return $this->baseResponse($transactions);
    }
    public function transactions()
    {
        $results = DB::table('transactions')
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.id_transaction')
            ->join('products', 'transaction_details.id_product', '=', 'products.id')
            ->select(
                'transactions.*',
                'transaction_details.qty',
                'transaction_details.subtotal',
                'products.product_name',
                'products.id_category as product_category',
                'products.price as product_price',
                'products.image as product_image'
            )
            ->get();

        return $this->baseResponse($results);
    }
}
