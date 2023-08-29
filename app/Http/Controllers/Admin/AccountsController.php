<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AccountsController extends Controller
{

    //index view.........................
    public function index()
    {
        return view('admin.pages.accounts.index');
    }
    // BillingHistoryindex index view.........................
    public function BillingHistoryindex()
    {
       $accounts = DB::table('sales')
       ->join('sales_details','sales.customer_id','=','sales_details.sale_id')
       ->get();

       return $accounts;
    }


    // OtherTransactionIndex index view.........................
    public function OtherTransactionIndex()
    {
        return view('admin.pages.accounts.othertransaction');
    }

    // TransactionHistoryIndex index view.........................
    public function TransactionHistoryIndex()
    {
        return view('admin.pages.accounts.transactionhistory');
    }


    // BarcodeScanning index view...........................................
    public function BarcodeScanning()
    {
        return view('admin.pages.accounts.barcodescanning');
    }
    // CashMemo index view...........................................
    public function CashMemo()
    {
        return view('admin.pages.accounts.cashmemo');
    }


}
