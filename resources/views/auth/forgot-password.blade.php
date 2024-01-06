<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<style>
        body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    width: 100vh;
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    
}

button {
    border: 1px solid #ccc;
    padding: 10px 20px;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    background-color: black;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px;
}
p{
    font-size: 16px;
    line-height: 25px
}
input {
    height: 20px; /* Set the input height */
    padding: 10px; /* Add some padding for spacing inside the input field */
    border: 1px solid #ccc; /* Add a border for visual separation */
    border-radius: 10px; /* Add rounded corners */
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
    font-size: 15px; /* Set the font size */
}

/* Style for when the input is focused */
input:focus {
    border-color: #007BFF; /* Change border color on focus */
    box-shadow: 2px 2px 5px rgba(0, 123, 255, 0.5); /* Change the shadow on focus */
}

    </style>
<title>Forgot Password</title>    
</head>
<body>
    <div class="container">
        @if (session('Error'))
    <div>
        
        <p style="margin-bottom: 4% ; color: red; font-size: 20px">{{session('Error')}}</p>
    </div>
    @endif
    @if (session('status'))
    <div>
        <p style="margin-bottom: 4% ; color: green; font-size: 20px">{{session('status')}}</p>
        
    </div>
@endif
        <p style="margin-bottom: 4% ; color: black;">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
        @if (session('status') == 'verification-link-sent')
        <b><p style="color: green ; margin-bottom: 4% ; "></b>
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </p>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
    
                <div>

                        <input style="margin-bottom: 2%" type="email" name="email" :value="old('email')"  autofocus >
                        @if ($errors->has('email'))
                        
                        <p style="margin-bottom: 2% ; color: red;">{{$errors->first('email')}}</p>
                        @endif
                    </div>
                    <button style="" type="submit">
                        {{ __('Email Password Reset Link') }}
                    </button>
            </form>
            
    </div>
</body>
</html>
{{-- 
<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
