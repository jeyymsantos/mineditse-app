<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $primaryKey = 'card_id';
    protected $fillable = [
        'user_id',
        'prod_id',
        'prod_name',
        'prod_qr_code',
        'prod_img_path',     
        'prod_price',
    ];
}
