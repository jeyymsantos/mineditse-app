<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'logo',
        'main_banner_photo',
        'long_quote',
        'short_quote',
        'secondary_banner_photo',
        'short_description',
        'long_description',
        'address',
        'contact',
        'email',
        'contact_hours'
    ];
}
