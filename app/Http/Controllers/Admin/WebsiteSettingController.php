<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Storage;

class WebsiteSettingController extends Controller
{
    public function edit()
    {
        $setting = WebsiteSetting::first();
        return view('website_settings.edit', compact('setting'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'landing_banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:500',
            'hero_button_text' => 'nullable|string|max:100',
            'hero_button_link' => 'nullable|url',
            'show_hero_text' => 'nullable|boolean',
            'show_hero_button' => 'nullable|boolean',
        ]);

        $setting = WebsiteSetting::first();

        if (!$setting) {
            $setting = WebsiteSetting::create([
                'show_hero_text' => true,
                'show_hero_button' => true,
            ]);
        }


        if ($request->hasFile('landing_banner_image')) {

            if ($setting->landing_banner_image) {
                Storage::disk('public')->delete($setting->landing_banner_image);
            }

            $path = $request->file('landing_banner_image')
                            ->store('banner', 'public');

            $setting->landing_banner_image = $path;
        }

        $setting->hero_title = $request->hero_title;
        $setting->hero_subtitle = $request->hero_subtitle;
        $setting->hero_button_text = $request->hero_button_text;
        $setting->hero_button_link = $request->hero_button_link;
        $setting->show_hero_text   = $request->input('show_hero_text', 1);  // defaults to true if missing
        $setting->show_hero_button = $request->input('show_hero_button', 1);

        $setting->save();

        /* 🎨 STORE COLORS IN SESSION */
        session([
            'hero_title_color'       => $request->hero_title_color ?? '#000000',
            'hero_subtitle_color'    => $request->hero_subtitle_color ?? '#000000',
            'hero_button_text_color' => $request->hero_button_text_color ?? '#000000',
            'hero_button_bg_color'   => $request->hero_button_bg_color ?? '#ffffff',
        ]);

        return redirect()->back()->with('success', 'Landing banner updated successfully.');
    }

}
