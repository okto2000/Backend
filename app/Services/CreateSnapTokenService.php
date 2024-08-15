<?php

namespace App\Services;

use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
    protected $order;

    public function __construct($order)
    {
        parent::__construct();

        $this->order = $order;
    }

    public function getSnapToken()
    {
        $totalPrice = 0;
        foreach ($this->order['items'] as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        $params = [
            'transaction_details' => [
                'order_id' => $this->order['order_id'],
                'gross_amount' => $totalPrice,
                'transaction_date' => date('Y-m-d H:i:s'),
            ],
            'item_details' => [
                [
                    'id' => $item['id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'name' => $item['name'],
                ]
            ],
            'customer_details' => [
                'id_customer' => $this->order['id_customer'],
                'first_name' => $this->order['name'],
                'email' => $this->order['email'],
                'phone' => $this->order['phone'],
            ],
            'shipping_address' => [
                'address' => $this->order['address'],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}