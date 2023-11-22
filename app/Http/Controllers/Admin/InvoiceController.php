<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        // $accounts = Payment::get();
        // return view('admin.pages.accounts.index',compact('accounts'));
        return view('admin.pages.invoice.index');

    }
}
