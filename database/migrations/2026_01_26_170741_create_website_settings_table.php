<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('landing_banner_image')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->text('hero_subtitle_line')->nullable();
            $table->string('hero_button_text')->nullable();
            $table->string('hero_button_link')->nullable();
            $table->boolean('show_hero_text')->nullable()->default(true);
            $table->boolean('show_hero_button')->nullable()->default(true);

            // Optional fields for future
            $table->string('contact_email')->nullable();    
            $table->string('contact_phone')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->text('footer_text')->nullable();

            $table->string('hero_title_color')->nullable();        // e.g. #ffffff
            $table->string('hero_subtitle_color')->nullable();     // e.g. #cccccc
            $table->string('hero_subtitle_line_color')->nullable();     // e.g. #cccccc
            $table->string('hero_button_text_color')->nullable();  // e.g. #ffffff
            $table->string('hero_button_bg_color')->nullable();    // e.g. #ff6600
            $table->string('footer_text_color')->nullable();       // e.g. #999999


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
