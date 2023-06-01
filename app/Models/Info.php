<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
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
        'contact_hours',
        'service_quote',
        'service_1_name',
        'service_1_img',
        'service_1_quote',
        'service_2_name',
        'service_2_img',
        'service_2_quote',
        'service_3_name',
        'service_3_img',
        'service_3_quote',
        'fb_link',
        'live_link',
        'live_title'
    ];
}
