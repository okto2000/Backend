<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', '');
        $transactions = Transaction::where('id_customer', 'LIKE', '%' . $search . '%')->paginate($perPage);
        return $this->baseResponse($transactions);
    }
}
