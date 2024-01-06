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
button:hover {
    background-color: #0056b3; /* Change button color on hover */
}

    </style>
<title>Verfiy Email</title>    
</head>
<body>
    <div class="container">
        @if (session('Error'))
    <div>
        
        <p style="margin-bottom: 4% ; color: red; font-size: 20px">{{session('Error')}}</p>
    </div>
    @endif

        <p style="margin-bottom: 4% ; color: black;">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another..</p>
        @if (session('status') == 'verification-link-sent')
        <b><p style="color: green ; margin-bottom: 4% ; "></b>
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </p>
            @endif
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
    
                <div>
                    
                        
                        <button type="submit">{{ __('Resend Verification Email') }}</button>
                    
                </div>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
    
                <button style="background-color: red" type="submit">
                    {{ __('Log Out') }}
                </button>
            </form>
    </div>
</body>
</html>
