<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;
use App\Models\Payments;
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
        // $accounts = Sale::all();
       $accounts = DB::table('sales')
       ->join('sales_details','sales.id','=','sales_details.sale_id')
       ->join('customers','sales.customer_id','customers.customer_id')
       ->join('purchases','sales_details.product_id','purchases.id')
       ->get();

        return view('admin.Pages.accounts.billinghistory',compact('accounts'));
       // return $accounts;
    
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'account_head' => 'required',
            'amount' => 'required|integer',
            ]);
        $payments = new Payments;
        $payments->type = $request->type;
        $payments->account_head = $request->account_head;
        $payments->amount = $request->amount;
        

        $maincompany = Sale::where('id', 1)->first();
        if($request->type == 'Income'){
            $maincompany->total_price = $maincompany->total_price + $request->total_price;
        }
        elseif($request->type == 'Expense'){
            $maincompany->total_price = $maincompany->total_price - $request->total_price;
        }

        $maincompany->update();
        $payments->save();
        return response()->json($payments);
    }

}
