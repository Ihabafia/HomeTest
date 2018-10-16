<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
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
        'user_id', 'email_address', 'is_default',
    ];

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public static function checkUsername($email)
    {
        return static::where(['email' => $email, 'is_default' => 1])->first();
    }

}
