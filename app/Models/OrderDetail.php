<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    public $timestamps= false;
    protected $table = 'order_detail';
    protected $primaryKey = 'id';
    protected $fillable = [
        'order_id',
        'prod_id'
    ];
}