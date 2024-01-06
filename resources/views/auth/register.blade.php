{{-- <x-guest-layout>
    @if (session('Error'))
    <div class="alert alert-danger">
        {{ session('Error') }}
    </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full"  name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register</title>

    <!-- Bootstrap -->
    <link href="/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="/assets/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/assets/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      {{-- <a class="hiddenanchor" id="signup"></a> --}}
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
            
            
            <section class="login_content">
                @if (session('Error'))
        <div class="alert alert-danger">
            {{session('Error')}}
        </div>
    @endif
              
              {{-- @if($errors->has('email'))
                    <div class="alert alert-danger mt-2">
                        {{$errors->first('email')}}
                    </div>
                @endif
                @error('email')
                <div class="alert alert-danger mt-2">
                    {{$message}}
                </div>
                @enderror --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{route('register')}}">
                    @csrf
                    <h1>Create Account</h1>
                    <div>
                      <input class="form-control" placeholder="Username" type="text" name="name" :value="old('name')"
                       required autofocus autocomplete="name"/>
                    </div>
                    <div>
                        <input class="form-control" placeholder="Email" type="email" name="email" :value="old('email')" 
                        required autocomplete="username" />
                      </div>
                    <div>
                      <input class="form-control" placeholder="Password" type="password"
                      name="password"
                      required autocomplete="new-password"/>
                    </div>
                    <div>
                        <input class="form-control" placeholder="Confirm Password" type="password"
                        name="password_confirmation" required autocomplete="new-password"/>
                      </div>
                    <div>
                      <button class="btn btn-primary " type="submit">Submit</button>
                    </div>
      
                    <div class="clearfix"></div>
      
                    <div class="separator">
                      <p class="change_link">Already a member ?
                        <a href="{{route('login')}}" class="to_register"> Log in </a>
                      </p>
      
                      <div class="clearfix"></div>
                      <br />
      
                      <div>
                        <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                        <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                      </div>
                    </div>
                  </form>
          </section>
        </div>

        
      </div>
    </div>
  </body>
</html>

