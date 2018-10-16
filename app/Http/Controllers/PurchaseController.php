<?php

namespace App\Http\Controllers;

use App\Purchase;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseForm;

class PurchaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::whereUserId(auth()->user()->id);

        return view('home', ['total' => number_format($purchases->get()->sum('total_investment'),2), 'purchases' => $purchases->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseForm $form)
    {
        $form->presist();

        return redirect(route('purchase.index'))->withStatus("Instrument has been created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        dd('SHOW');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        return view('purchases.edit', compact('purchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseForm $form, Purchase $purchase)
    {
        $purchase->fill([
            'company_name'          => $form->company_name,
            'share_instrument_name' => $form->share_instrument_name,
            'quantity'              => $form->quantity,
            'price'                 => number_format($form->price, 10, '.', ''),
            'total_investment'      => number_format($form->quantity * $form->price, 10, '.', ''),
            'certificate_number'    => $form->certificate_number,
        ])->save();

        return redirect(route('purchase.index'))->withStatus("Instrument has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(isset($request->id)){
            $purchase = Purchase::findOrFail($request->id);
            $purchase->delete();
            session()->flash('status', 'Instrument has been successfully deleted');
            return 'success';
        }
    }
}
