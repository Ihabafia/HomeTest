<?php

namespace App\Http\Requests;

use App\Purchase;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name'          => 'required',
            'share_instrument_name' => 'required',
            'quantity'              => 'required|integer',
            'price'                 => 'required|numeric',
            'certificate_number'    => 'required',
        ];
    }

    public function presist()
    {
        // $timestamp = '2018-10-13 16:07:00';
        // $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'UTC');
        // $date->setTimezone('UTC');
        // $date = Carbon::now('UTC');
        //$date->setTimezone('Europe/Stockholm');
        //$date->setTimezone('America/New_York');
        Purchase::create([
            'company_name'          => request('company_name'),
            'share_instrument_name' => request('share_instrument_name'),
            'quantity'              => request('quantity'),
            'price'                 => number_format(request('price'), 10, '.', ''),
            'total_investment'      => number_format(request('quantity') * request('price'), 10, '.', ''),
            'certificate_number'    => request('certificate_number'),
            'user_id'               => auth()->id(),
            'transaction_date'      => Carbon::now('UTC'),
        ]);
    }

}
