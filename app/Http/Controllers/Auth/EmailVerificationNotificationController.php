<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        $host = 'www.google.com';
        $port = 80;
        $timeout = 10; // Timeout in seconds
        try {
            $connected = @fsockopen($host,$port,$timeout);
            if ($connected) {
                @fclose($connected);
                $request->user()->sendEmailVerificationNotification();
        
                return back()->with('status', 'verification-link-sent');
            }
            else {
                return back()->with('Error', 'Oops! we couldn\' t connect to our server .Please check your internet connection and try again');
                
            }    
        } catch (\Exception $e) {
            return back()->with('Error', 'Oops! we couldn\' t connect to our server .Please check your internet connection and try again'.$e->getMessage());
            
        }
        
    }
}
