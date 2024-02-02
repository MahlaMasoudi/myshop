<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $payments = Payment::all();
        return view('admin.market.payment.index', compact('payments'));
    }

    public function offline()
    {
        $payments = Payment::where('paymentable_type', 'App\Models\Market\OfflinePayment')->get();
        return view('admin.market.payment.index', compact('payments'));
    }
    public function online()
    {
        $payments = Payment::where('paymentable_type', 'App\Models\Market\OnlinePayment')->get();
        return view('admin.market.payment.index', compact('payments'));
    }
    public function cash()
    {
        $payments = Payment::where('paymentable_type', 'App\Models\Market\CashPayment')->get();
        return view('admin.market.payment.index', compact('payments'));
    }
    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function canceled(Payment $payment)
    {
        $payment->status = 2;
        $payment->save();
        return redirect()->route('admin.market.payment.index')->with('swal-success', 'تغییر شما با موفقیت انجام شد');
    }

    public function returned(Payment $payment)
    {
        $payment->status = 3;
        $payment->save();
        return redirect()->route('admin.market.payment.index')->with('swal-success', 'تغییر شما با موفقیت انجام شد');
    }

    public function show(Payment $payment)
    {
        return view('admin.market.payment.show', compact('payment'));
    }
}
