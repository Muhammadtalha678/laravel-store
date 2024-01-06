<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function add()
    {
        return view('admin.banner.add');
    }
    public function store(Request $request)
    {
        $rules = [
            // for banner image
            'banner_image' => 'required|mimes:jpeg,jpg,png|max:2048',
            // for slider image
            'slider_images' => 'required|array|min:4',
        ];
        $messages = [
            //for Banner 
            'banner_image.required' => 'At least one image are required',
            //for check image is jpg or png or none
            'banner_image.mimes' => 'Banner image must be a file of type jpeg,png',
            //for check size
            'banner_image.max' => 'Banner image must be 2 mb image',

            //for Slider 
            'slider_images.required' => 'At least four images are required',
            //for Lenght of slider images
            'slider_images.min' => 'Slider Image must be at least 4 image',

        ];
        if ($request->has('slider_images')) {
            foreach ($request->file('slider_images') as $key => $value) {
                $rules['slider_images.' . $key] = ' mimes:jpeg,jpg,png|max:2048';
                $messages['slider_images.' . $key . '.mimes'] = 'Slider Image ' . ($key + 1) . ' must be a file of type: jpeg,png,jpg.';
                $messages['slider_images.' . $key . '.max'] = 'Slider Image ' . ($key + 1) . ' must be not greater than 2 mb.';
            }
        }
        $request->validate($rules, $messages);
        $bannerImage = null;
        $sliderImages = null;
        if ($request->hasFile('banner_image')) {
            $bannerName = time() . rand(1, 100) . '.' . $request->banner_image->extension();
            $request->banner_image->move(public_path('bannerImage'), $bannerName);
            $appUrl = config('app.url');
            $bannerFileName = url($appUrl . 'bannerImage/' . $bannerName);
            $bannerImage = $bannerFileName;
        }
        if ($request->hasFile('slider_images')) {
            foreach ($request->file('slider_images') as $value) {
                $sliderName = time() . rand(1, 100) . '.' . $value->extension();
                $value->move(public_path('sliderImage'), $sliderName);
                $appUrl = config('app.url');
                // $appUrl = env('APP_URL');
                $sliderFileName[] = $appUrl . 'sliderImages/' . $sliderName;
                // echo $value;
            }

            $sliderImages = json_encode($sliderFileName);
            // print_r($sliderImages);
        }
        Banner::create([
            'banner_image' => $bannerImage,
            'slider_images' => $sliderImages,
        ]);
        return redirect()->route('adminBanner.add')->with('success', 'Images Added Successfully');
    }
}
