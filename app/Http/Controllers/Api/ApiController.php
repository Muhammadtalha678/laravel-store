<?php

namespace App\Http\Controllers\Api;

use App\Events\ProductUpdated;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Categories;
use App\Models\MobileUser;
use App\Models\Products;
use Exception;
use Illuminate\Http\Request;
use client;
use Hash;
use Auth;

use Illuminate\Validation\Rules;
use Laravel\Sanctum\PersonalAccessToken;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function categories()
    {
        $categories = Categories::all();
        $data = [
            "status" => "200",
            "categories" => $categories,
        ];
        return response()->json($data, 200);
    }
    public function products()
    {
        $products = Products::all();
        // event(new ProductUpdated('Hello'));
        $data = [

            "status" => "200",
            "products" => $products,
        ];
        return response()->json($data, 200);
    }
    public function phone(Request $request)
    {
        echo ($request->header('Authorization'));
        exit;
        // return response($request->all());
        $message = "This is testing from CodeSolutionStuff.com";
        try {
            $accountSid = getenv("TWILIO_SID");
            $authToken = getenv("TWILIO_AUTH_TOKEN");
            $twilioNumber = getenv("TWILIO_NUMBER");

            $twilio = new \Twilio\Rest\Client($accountSid, $authToken);

            // User's mobile number
            $userPhoneNumber = $request->phone;

            // Generate a random 6-digit OTP
            $otp = rand(100000, 999999);

            // Save the OTP in your backend for verification

            // Send OTP via Twilio
            $message = $twilio->messages
                ->create(
                    $userPhoneNumber, // To
                    ['from' => $twilioNumber, 'body' => "Your OTP is: $otp"]
                );

            // Check for successful message delivery
            if ($message->sid) {
                // OTP sent successfully
            } else {
                // Error handling
            }

        } catch (Exception $e) {
            dd("Error: " . $e->getMessage());
            return response()->json("Error: " . $e->getMessage());
        }


    }

    public function registerMobileUSer(Request $request)
    {

        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . MobileUser::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $mobileUser = MobileUser::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
        ]);
        if ($mobileUser) {
            return response()->json([
                'success' => 'Mobile User Created Successfully',
                'token' => $mobileUser->createToken('MobileApp')->plainTextToken
            ]);
        }
    }
    public function loginMobileUser(Request $request)
    {
        $validate = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
        $mobileLogin = MobileUser::where('email', $request->email)->first();
        // echo $mobileLogin;
        // var_dump( Hash::check($request->password, $mobileLogin->password));
        if (!$mobileLogin || !Hash::check($validate['password'], $mobileLogin->password)) {
            return response()->json([
                'email' => 'The provided credentials do not match our records.'
            ], 423);
        }
        return response()->json(['success' => 'Login Successfully', 'token' => $mobileLogin->createToken('MobileApp')->plainTextToken]);

    }
    public function cartData(Request $request)
    {
        $user = Auth::guard('mobile')->user();
        if ($user) {
            $prodIdPresent = Cart::where('mobileUser_id', $user->id)->where('product_id', $request->product_id)->first();
            if ($prodIdPresent) {
                if ($request->quantity > 1) {
                    $prodIdPresent->delete();
                    return response()->json(['success' => 'Item delete Successfully']);
                    # code...
                }

                if ($request->quantity === +1) {
                    $prodIdPresent->quantity += $request->quantity;
                    $prodIdPresent->price += $request->price;
                    $prodIdPresent->update();
                    return response()->json(['success' => 'Add to Cart Successfully']);

                }
                // if ($request->quantity === -1) {
                if ($prodIdPresent->quantity == 1) {
                    // return response()->json(['success' => $prodIdPresent->quantity == 1]);
                    // $prodIdPresent->quantity += $request->quantity;
                    // $prodIdPresent->price += $request->price;
                    $prodIdPresent->delete();
                    return response()->json(['success' => 'Item remove from Cart Successfully']);

                }
                if ($prodIdPresent->quantity > 0) {
                    $prodIdPresent->quantity += $request->quantity;
                    $prodIdPresent->price += $request->price;
                    $prodIdPresent->update();
                    return response()->json(['success' => 'Item remove from Cart Successfully']);

                }


                // }
            } else {
                if ($request->quantity === +1) {
                    Cart::create([
                        'mobileUser_id' => $user->id,
                        'product_id' => $request->product_id,
                        'price' => $request->price,
                        'quantity' => $request->quantity,
                    ]);

                    return response()->json(['success' => 'Add to Cart Successfully']);
                }
            }
        }
    }
    public function cart()
    {
        $user = Auth::guard('mobile')->user();
        if ($user) {
            $cart = Cart::where('mobileUser_id', $user->id)->get();
            return response()->json(['cartData' => $cart], 200);
        }
    }
    public function mobileUserlogout()
    {
        $user = Auth::guard('mobile')->user();
        if ($user) {
            // $f = $user->currentAccessToken()->revoke;
            $f = $user->currentAccessToken()->delete();
            return response()->json(['success' => "User Logout Successfull"]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function images()
    {
        $images = Banner::all();
        $data = [
            'status' => 200,
            'images' => $images
        ];
        return response()->json($data, 200);
    }
}
