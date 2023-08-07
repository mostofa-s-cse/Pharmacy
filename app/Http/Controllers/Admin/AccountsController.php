<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('admin.pages.accounts.billinghistory');
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
