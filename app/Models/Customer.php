<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $timestamps= false;
    protected $primaryKey = 'cust_id';
    protected $fillable = [
        'cust_id',
        'cust_street',
        'cust_barangay',
        'cust_city',
        'cust_province',
        'cust_type'
    ];
}
