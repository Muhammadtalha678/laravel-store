<?php

namespace App\Http\Controllers;

use App\Events\ProductUpdated;
use App\Models\Categories;
use App\Models\Products;
use Crypt;
use Illuminate\Http\Request;
use Auth;
use Session;

class ProductController extends Controller
{

    function index()
    {
        if (Session::has("productSearch")) {
            $productSearch = Session::get("productSearch");
            $products = Products::where("name", "LIKE", "%" . $productSearch . "%")->cursorPaginate(10);
            return view("admin.products.index", compact("products"));
        }
        $products = Products::cursorPaginate(10);
        return view("admin.products.index", compact("products"));
    }
    // SEARCH PRODUCT
    public function productSearch(Request $request)
    {
        if ($request->search != null) {
            Session::put('productSearch', $request->search);
            return redirect()->route('adminProduct.all');
        }
        Session::forget('productSearch');
        return redirect()->route('adminProduct.all');

    }
    public function add()
    {
        $categories = Categories::all();
        return view("admin.products.add ", compact("categories"));
    }
    public function store(Request $request)
    {


        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'subTitle' => ['required', 'string', 'max:255'],
            'SKU' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer'],
            'discount' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'category' => ['required', 'integer'],
        ];
        $messages = [];
        if (!$request->has('images') && !$request->has('videos')) {
            $rules['images'] = 'required';
            $rules['videos'] = 'required';
            $messages['images.required'] = 'At least one image is required';
            $messages['videos.required'] = 'At least one video is required';
        } else {
            if ($request->has('images')) {
                foreach ($request->file('images') as $key => $image) {
                    $rules['images.' . $key] = 'image|mimes:jpeg,png,jpg';
                    $messages['images.' . $key . '.image'] = 'Image ' . ($key + 1) . " must be an image.";
                    $messages['images.' . $key . '.mimes'] = 'Image ' . ($key + 1) . " must be a file of type: jpeg,png,jpg.";
                    $messages['images.' . $key . '.max'] = 'Image ' . ($key + 1) . " must be not greater than 2 mb.";
                }
            }
            // for videos 
            if ($request->has('videos')) {
                foreach ($request->file('videos') as $key => $video) {
                    $rules['videos.' . $key] = 'mimes:video/mp4,video/webm,video/ogg';
                    $messages['videos.' . $key . '.mimes'] = 'Video ' . ($key + 1) . " must be a file of type: mp4,webm,ogg.";
                    $messages['videos.' . $key . '.max'] = 'Video ' . ($key + 1) . " must be not greater than 2 mb.";
                }
            }
        }
        if (!$request->has("thumnbail")) {
            $rules["thumnbail"] = 'required';
            $messages['thumnbail.required'] = 'Thumbnail image is Required';
        } else {
            if ($request->has("thumnbail")) {
                $rules['thumnbail'] = 'image|mimes:jpeg,png,jpg';
                $messages['thumnbail.image'] = 'Thumnail must be an image.';
                $messages['thumnbail.mimes'] = 'Thumnail must be a file of type: jpeg,png,jpg.';
                $messages['thumnbail.max'] = 'Thumnail must be not greater than 2 mb.';
            }
        }
        $request->validate($rules, $messages);
        $images = null;
        $videos = null;
        $thumbnail = null;
        $products = Products::where('admin_id', Auth::user()->id)->get();
        foreach ($products as $product) {
            // var_dump($product->name == $request->name);exit;
            if ($product->name == $request->name) {
                return redirect()->route('adminProduct.add')->with('error', 'Product Added Previously');
            }
        }
        if ($request->hasFile('thumnbail')) {
            $thumbnailName = time() . rand(1, 100) . '.' . $request->thumnbail->extension();
            $request->thumnbail->move(public_path('productThumbnail'), $thumbnailName);
            $appUrl = config('app.url');
            $thumnbailfileName = url($appUrl . 'productThumbnail/' . $thumbnailName);

            // var_dump(json_encode($thumnbailfileName));exit;
            $thumbnail = $thumnbailfileName;
        }
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . rand(1, 100) . '.' . $image->extension();
                $image->move(public_path('productImage'), $imageName);
                $appUrl = config('app.url');
                $ImagefileName[] = url($appUrl . 'productImage/' . $imageName);
            }
            $images = json_encode($ImagefileName);
        }
        // for video
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $videoName = time() . rand(1, 100) . '.' . $video->extension();
                $video->move(public_path('productVideo'), $videoName);
                $appUrl = config('app.url');
                $VideofileName[] = url($appUrl . 'productVideo/' . $videoName);
            }
            $videos = json_encode($VideofileName);
        }
        $catName = Categories::where('id', $request->category)->first();

        $pro = Products::create(
            [
                "name" => $request->name,
                "title" => $request->title,
                "subTitle" => $request->subTitle,
                "SKU" => $request->SKU,
                "price" => $request->price,
                "discount" => $request->discount,
                "quantity" => $request->quantity,
                "images" => $images,
                "thumbnail" => $thumbnail,
                "video" => $videos,
                "category_id" => $request->category,
                "category_name" => $catName->name,
                "admin_id" => Auth::user()->id,
            ]
        );

        // Somewhere in your controller or service

        // 

        return redirect()->route('adminProduct.add')->with('success', 'Product Added Successfully');
    }

    public function edit($id)
    {
        $idDecrypt = Crypt::decrypt($id);
        $product = Products::find($idDecrypt);
        $categories = Categories::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => 'required',
            'string',
            'max:255',
            'title' => 'required',
            'string',
            'max:255',
            'subTitle' => 'required',
            'string',
            'max:255',
            'SKU' => 'required',
            'string',
            'max:255',
            'price' => 'required',
            'integer',
            'discount' => 'required',
            'integer',
            'quantity' => 'required',
            'integer',
            'category' => 'required',
            'integer',
        ];
        $messages = [];
        if ($request->has('images')) {
            foreach ($request->file('images') as $key => $image) {
                $rules['images.' . $key] = 'image|mimes:jpeg,png,jpg';
                $messages['images.' . $key . '.image'] = 'Image ' . ($key + 1) . " must be an image.";
                $messages['images.' . $key . '.mimes'] = 'Image ' . ($key + 1) . " must be a file of type: jpeg,png,jpg.";
                $messages['images.' . $key . '.max'] = 'Image ' . ($key + 1) . " must be not greater than 2 mb.";
            }
        }
        // for videos 
        if ($request->has('videos')) {
            foreach ($request->file('videos') as $key => $video) {
                $rules['videos.' . $key] = 'mimes:video/mp4,video/webm,video/ogg';
                $messages['videos.' . $key . '.mimes'] = 'Video ' . ($key + 1) . " must be a file of type: mp4,webm,ogg.";
                $messages['videos.' . $key . '.max'] = 'Video ' . ($key + 1) . " must be not greater than 2 mb.";
            }
        }
        if ($request->has("thumnbail")) {
            $rules['thumnbail'] = 'image|mimes:jpeg,png,jpg';
            $messages['thumnbail.image'] = 'Thumnail must be an image.';
            $messages['thumnbail.mimes'] = 'Thumnail must be a file of type: jpeg,png,jpg.';
            $messages['thumnbail.max'] = 'Thumnail must be not greater than 2 mb.';
        }
        $request->validate($rules, $messages);

        $idDec = Crypt::decrypt($request->id);
        $oldProduct = Products::find($idDec);
        $UpdateThumbnail = $oldProduct->thumbnail;
        $UpdateImages = $oldProduct->images;
        $UpdateVideos = $oldProduct->videos;
        // var_dump($UpdateImages);var_dump($UpdateVideos);exit;
        if ($oldProduct) {
            if ($request->hasFile("images")) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . rand(1, 100) . '.' . $image->extension();
                    $image->move(public_path('productImage/'), $imageName);
                    $appUrl = config('app.url');
                    $imagefileName[] = url($appUrl . 'productImage/' . $imageName);
                }
                $UpdateImages = json_encode($imagefileName);
                if ($oldProduct->images != null) {
                    foreach (json_decode($oldProduct->images) as $img) {
                        $appUrl = config('app.url');
                        $localPath = str_replace('/', '\\', str_replace($appUrl, '', $img));
                        $fullPath = public_path($localPath);
                        unlink($fullPath);

                    }
                }
            }
            if ($request->hasFile("videos")) {
                foreach ($request->file('videos') as $video) {
                    $videoName = time() . rand(1, 100) . '.' . $video->extension();
                    $video->move(public_path('productVideo/'), $videoName);
                    $appUrl = config('app.url');
                    $videofileName[] = url($appUrl . 'productVideo/' . $videoName);
                }
                $UpdateVideos = json_encode($videofileName);
                if ($oldProduct->videos != null) {
                    foreach (json_decode($oldProduct->videos) as $vid) {
                        $appUrl = config('app.url');
                        $localPath = str_replace('/', '\\', str_replace($appUrl, '', $vid));
                        $fullPath = public_path($localPath);
                        unlink($fullPath);

                    }
                }
            }
            if ($request->hasFile('thumbnail')) {
                echo
                    $thumbnailName = time() . rand(1, 100) . '.' . $request->thumbnail->extension();
                $request->thumbnail->move(public_path('productThumbnail'), $thumbnailName);
                $UpdateThumbnail = url(config('app.url') . 'productThumbnail/' . $thumbnailName);
                $localPath = str_replace('/', '\\', str_replace(config('app.url'), '', $oldProduct->thumbnail));
                unlink(public_path($localPath));

            }
            $pro = $oldProduct->fill([
                "name" => $request->name,
                "title" => $request->title,
                "subTitle" => $request->subTitle,
                "SKU" => $request->SKU,
                "price" => $request->price,
                "discount" => $request->discount,
                "quantity" => $request->quantity,
                "images" => $UpdateImages,
                "thumbnail" => $UpdateThumbnail,
                "video" => $UpdateVideos,
                "category_id" => $request->category,
                "admin_id" => Auth::user()->id,
            ]);
            $oldProduct->save();
            // Somewhere in your controller or service

            // var_dump($ee);exit;
//             return back()->with('success',"Product Edit Successfully");
        } else {
            return back()->with('error', "Product not Found");
        }

    }

    public function delete($id)
    {
        $idDecrypt = Crypt::decrypt($id);
        // $product = Products::find($idDecrypt);
        $singleProduct = Products::where('id', $idDecrypt)->first();
        // var_dump( $singleProduct);exit;
        if ($singleProduct) {
            if ($singleProduct->images) {
                foreach (json_decode($singleProduct->images) as $productImg) {
                    $localPath = str_replace('/', '\\', str_replace(config('app.url'), '', $productImg));
                    unlink(public_path($localPath));
                }
            }
            if ($singleProduct->videos) {
                foreach (json_decode($singleProduct->images) as $productVid) {
                    $localPath = str_replace('/', '\\', str_replace(config('app.url'), '', $productVid));
                    unlink(public_path($localPath));
                }
            }
            $localPath = str_replace('/', '\\', str_replace(config('app.url'), '', $singleProduct->thumbnail));
            unlink(public_path($localPath));

            $singleProduct->delete();
            return back()->with('success', 'Product Deleted Successfully');
        }
        return back()->with('error', 'Product Not Found');
    }

    public function clearSearchSession(Request $request)
    {
        $request->session()->forget('productSearch');
        return response()->json(['message' => 'Session cleared']);
    }

}
