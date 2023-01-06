<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps= false;
    protected $primaryKey = 'prod_id';
    protected $fillable = [
        'prod_name',
        'prod_unit',
        'prod_price',
        'prod_quantity',
        'prod_status'
    ];
}
