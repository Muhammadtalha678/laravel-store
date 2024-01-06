<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
class AdminProfileController extends Controller
{
    public function edit() {
        return view("admin.profile.profile");
    }
    public function update(Request $request){
        $request->validate([
            "name"=> ["string","max:255"],
            'email' => ['email',"max:255","unique:users,email,".Auth::user()->id]
        ]);
        // fiil ya kam krta  ha ky agr js ki value change hogi edit ma to usi ki hi val change kry ga
        $user = Auth::user()->fill([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        if (Auth::user()->isDirty('email')) {
            Auth::user()->email_verified_at = null;
        }
         $user->save();
         return redirect()->route('profile.edit')->with('status','profile-updated');
         
    }

    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // return Redirect::to('/');
        return redirect()->route('register');
    }


}
