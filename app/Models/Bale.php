<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bale extends Model
{
    use HasFactory;
    public $timestamps= false;
    protected $primaryKey = 'bale_id';
    protected $fillable = [
        'bale_id',
        'supplier_id',
        'category_id',
        'bale_price',
        'bale_quantity'
    ];
}
