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
        'order_cash',
        'order_change'
    ];
}
