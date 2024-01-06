<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Crypt;
use File;
use Illuminate\Http\Request;
use App\Models\Categories;
use Auth;
class CategoryController extends Controller
{
    // SHOW ALL CATEGORIES
    public function index(Request $request)  {
        
        if ($request->session()->has('search')) {
         $search = $request->session()->get('search'); 
            $allCategories =  Categories::where('name','like', '%' .$search. '%')->cursorPaginate(10);
             
            return view('admin.categories.index',compact('allCategories'));   
        }
         $allCategories = Categories::where('admin_id',Auth::user()->id)->cursorPaginate(10);
         return view('admin.categories.index',compact('allCategories'));   
     }

     // SEARCH ALL CATEGORIES
    public function categorySearch(Request $request) {
        if ($request->search != null) {
            // $search  = $request->session()->get('search');
            $request->session()->put('search', $request->search);
            
            
            return redirect()->route('adminCategory.all');
        }
        $request->session()->forget('search');
        
        return redirect()->route('adminCategory.all');
       

    }

    //SHOW ADD CATEGORIES
    public function add() {
        return view("admin.categories.add");
    }

    // STORE CATEGORIES
    public function store(Request $request)  {
        $rules = [
            "name"=> ["required","max:255",'string'],
            'desc'=>['nullable','string'],
        ];
        $messages = [];
        if (!$request->has('images')) {
            $rules['images'] = "required" ;
            $messages['images.required'] = 'At least one image is required';
        }else{
            if ($request->has('images')) {
                
                    $rules['images'] = 'image|mimes:jpeg,png,jpg' ;
                    $messages['images.image'] = 'Image  be an Image ' ;
                    $messages['images.mimes'] = 'Image  be a type of jpeg,png,jpg ' ;
                    $messages['images.max'] = 'Image  must be not greater than 2 mb. ' ;
                
            }
        }
        $request->validate($rules,$messages);
        $images = null;
        $category = Categories::where('admin_id',Auth::user()->id)->get();
        
        foreach ($category as $value) {
            if ($value->name == $request->name) {
                
                return redirect()->route('adminCategory')->with('error','Category Added Previously');
            }
        }
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time().rand(1,100).'.'.$image->extension();
            $image->move(public_path('categoryImage'), $imageName);
            $appUrl = config('app.url');
            // $appUrls = url($appUrl);
            $imagefileName = url($appUrl.'categoryImage/'.$imageName);
            // dd($imagefileName);
            // exit;
            
            $images = $imagefileName;
            // echo $images;exit;
            
        }
        // exit;
        Categories::create([
            'name' => $request->name,
            'desc'=> $request->desc,
            'images' => $images,
            'admin_id'=> Auth::user()->id
        ]);
        // OR
        // $category = new Categories();
        // $category->name = $request->name;
        // $category->desc = $request->desc;
        // $category->save();
        return redirect()->route('adminCategory')->with('success','Category Add Successfully');
    }
    
    
    // EDIT SHOW CATEGORIES
    public function edit($id) {
        $idDecrypt = Crypt::decrypt($id);
        $categories = Categories::find($idDecrypt);
        if ($categories) {
            return view('admin.categories.edit',compact('categories'));
            
        }
        // return redirect()->route('adminCategory')->with('success','Category Add Successfully');
        
    }
    
    // EDIT STORE CATEGORIES
    public function update(Request $request) {
        
        // echo $request->has('images');exit;
     
    $rules = [
        "name"=> ["required","max:255",'string'],
        'desc'=>['nullable','string'],
    ];
    $messages = [];
    
        if ($request->has('images')) {
            
                $rules['images'] = 'image|mimes:jpeg,png,jpg' ;
                $messages['images.image'] = 'Image  be an Image ' ;
                $messages['images.mimes'] = 'Image  be a type of jpeg,png,jpg ' ;
                $messages['images.max'] = 'Image  must be not greater than 2 mb. ' ;
            
        }
    
        $request->validate($rules, $messages);
        $idDecrypt = Crypt::decrypt($request->id);
        $oldCategory =  Categories::find($idDecrypt);
        $updateImages = $oldCategory->images;
        // echo $oldCategory;exit;
        if ($oldCategory) {
            if ($request->hasFile('images')) {
                    $image = $request->file('images');
                    $imageName = time().rand(1,100).'.'.$image->extension();
                    $image->move(public_path('categoryImage'), $imageName);

                    $imageFileName = url(config('app.url').'categoryImage/'.$imageName);
                    $updateImages = $imageFileName;
                    // echo $updateImages;
                    if ($oldCategory->images) {
                        // echo $oldCategory->images;exit;    
                        $basePath = config('app.url');
                        $oldCategoryImages = $oldCategory->images;
                        $localPath = str_replace('/', '\\',str_replace($basePath,'', $oldCategoryImages)); 
                        $fullPath = public_path($localPath);
                        // var_dump($fullPath);exit;
                            
                            unlink($fullPath);
                        
                    }
                }
                $oldCategory->fill([
                   'name' => $request->name,
                   'desc'=> $request->desc,
                   'images' => $updateImages,
                   'admin_id'=> Auth::user()->id
                ])->save();
                return back()->with('success','Category Updated Successfully');
            }
        }
        // echo $idDecrypt ;exit;
    
    public function delete($id) {
        $idDecrypt = Crypt::decrypt($id);
        // $singleProduct = Products::find($idDecrypt,'category_id');
        $singleProduct = Products::where('category_id',$idDecrypt)->first();
        // echo( $singleProduct);exit;
        if ($singleProduct) {
            if ($singleProduct->images) {
                foreach (json_decode($singleProduct->images) as $prodImg) {
                    unlink(public_path("productImage/".$prodImg));
                }    
            }
            if ($singleProduct->videos) {
                foreach (json_decode($singleProduct->videos) as $prodVid) {
                    unlink(public_path("productVideo/".$prodVid));
                }    
            }
            
        }
        // $singleCategory = Categories::find($idDecrypt);
        $singleCategory = Categories::where('id',$idDecrypt)->first();
        // echo( $singleCategory);exit;
        if ($singleCategory) {
                $basePath = config('app.url');
                
                $localPath = str_replace('/', '\\',str_replace($basePath,'', $singleCategory->images));
                $fullPath = public_path($localPath);
                // echo $fullPath;exit;
                // $fullPath = public_path("categoryImage/".$cateImg);
                
                unlink($fullPath);
            $singleCategory->delete();
            return back()->with('success','Category Deleted Successfully');
        }
        return back()->with('error','Product Not Found');
    }

    // CLEAR SESSION WHEN CLICK F5
    public function clearSearchSession(Request $request)
{
    $request->session()->forget('search');
    return response()->json(['message' => 'Session cleared']);
}

// API ONLY



    
}
