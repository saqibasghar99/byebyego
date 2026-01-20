<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_logo',
        'landing_banner_image',
        'hero_title',
        'hero_subtitle',
        'hero_button_text',
        'hero_button_link',
        'contact_email',
        'contact_phone',
        'facebook_url',
        'tiktok_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'footer_text',
    ];
}
