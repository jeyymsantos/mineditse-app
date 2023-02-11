<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps= false;
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'cust_id',
        'staff_id',
        'order_total', 
        'order_shipping_fee',
        'payment_method',
        'payment_status',
        'payment_cash',
        'order_method',
        'order_status',   
        'order_details',
        'order_date',
        'payment_date',
    ];
}
