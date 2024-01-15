<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Crypt;

class BannerController extends Controller
{
    public function index()
    {
        $images = Banner::all();
        return view('admin.banner.index', compact('images'));
    }
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
                $value->move(public_path('sliderImages'), $sliderName);
                $appUrl = config('app.url');
                // $appUrl = env('APP_URL');
                $sliderFileName[] = $appUrl . 'sliderImages/' . $sliderName;
                // echo $value;
            }

            $sliderImages = json_encode
            ($sliderFileName);
            // print_r($sliderImages);
        }
        Banner::create([
            'banner_image' => $bannerImage,
            'slider_images' => $sliderImages,
        ]);
        return redirect()->route('adminBanner.index')->with('success', 'Images Added Successfully');
    }
    public function edit(Request $request, $id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
            $findData = Banner::findOrfail($decrypted);
            return view('admin.banner.edit', compact('findData'));
        } catch (DecryptException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function update(Request $request)
    {
        try {
            $decrypted = Crypt::decrypt($request->id);
            $findBanner = Banner::findorFail($decrypted);
            $bannerImage = $findBanner->banner_image;
            $sliderImage = $findBanner->slider_images;
            if ($findBanner) {
                if ($request->has('banner_image')) {
                    $rules = [
                        'banner_image' => 'mimes:jpg,jpeg,png|max:2048'
                    ];
                    $message = [
                        'banner_image.max' => 'Banner Image should not be greater than 2mb Image'
                    ];
                    $request->validate($rules, $message);


                }
                if ($request->has('slider_images')) {
                    $rules = [
                        'slider_images' => 'array|min:4',
                    ];
                    $message = [
                        'slider_images.min' => 'At least four images are required'
                    ];
                    foreach ($request->slider_images as $key => $value) {
                        $rules['slider_images.' . $key] = 'mimes:jpg,jpeg,png|max:2048';
                        $message['slider_images.' . $key . '.max'] = 'Slider Image ' . ($key + 1) . ' must be not greater than 2 mb.';
                        $message['slider_images.' . $key . '.mimes'] = 'Slider Image ' . ($key + 1) . ' must be a file of type: jpeg,png,jpg.';
                    }
                    $request->validate($rules, $message);
                }
                if ($request->hasFile('banner_image')) {
                    $bannerName = time() . rand(1, 100) . '.' . $request->banner_image->extension();
                    $request->banner_image->move(public_path('bannerImage'), $bannerName);
                    $bannerImage = config('app.url') . 'bannerImage/' . $bannerName;
                    $localPath = str_replace('/', '\\', str_replace(config('app.url'), '', $findBanner->banner_image));
                    unlink(public_path($localPath));
                    // echo public_path($localPath);
                    // echo $bannerImage;
                    // exit;
                }
                if ($request->hasFile('slider_images')) {
                    foreach ($request->file('slider_images') as $value) {
                        $sliderName = time() . rand(1, 100) . '.' . $value->extension();
                        $value->move(public_path('sliderImages'), $sliderName);
                        $sliderImages[] = config('app.url') . 'sliderImages/' . $sliderName;
                    }
                    $sliderImage = json_encode($sliderImages);
                    foreach (json_decode($findBanner->slider_images) as $value) {
                        $localPath = str_replace('/', '\\', str_replace(config('app.url'), '', $value));
                        unlink(public_path($localPath));
                    }
                }
                // echo $sliderImage;
                // echo $bannerImage;
                // exit;
                $findBanner->fill([
                    'banner_image' => $bannerImage,
                    'slider_images' => $sliderImage,
                ])->save();
                return redirect()->route('adminBanner.index')->with('success', 'Images Updated Successfully');
            }
        } catch (DecryptException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
