<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'order_id',
        'method',
        'status',
        'currency',
        'shipping_cost',
        'total_due',
        'total_payable',
        'discount_rate',
        'discount_amount',
        'payment_due_date',
        'interest_rate',
        'account_ref',
        'tansaction_desc',
        'phone_number',
        'merchant_request_id',
        'checkout_request_id',
        'response_code',
        'response_message',
        'coupon_code',
        'deleted_at',
        'suspended_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

}
