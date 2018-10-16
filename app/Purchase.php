<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * To switch of timestamps.
     *
     * @var array
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'company_name',
            'share_instrument_name',
            'quantity',
            'price',
            'total_investment',
            'certificate_number',
            'user_id',
            'transaction_date',
    ];

    public function getTransactionDateAttribute($date)
    {
        return Carbon::parse($date);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
