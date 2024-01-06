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
    width: 300px; /* Set the input width */
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
<title>Reset Password</title>    
</head>
<body>
    <div class="container">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                
                <!-- Email Address -->
                <div style="margin-bottom: 3%">
                    <label style="font-size: 20px ;" for="email">Email:</label>
                        <input style="margin-bottom: 2%" type="email" name="email" value="{{old('email', $request->email)}}" required autofocus autocomplete="username" >
                        @if ($errors->has('email'))
                        
                        <p style="margin-bottom: 2% ; color: red;">{{$errors->first('email')}}</p>
                        @endif
                    </div>

                    <!-- Password -->
                    <div style="margin-bottom: 3%">
                        <label style="font-size: 20px ;" for="password">Password:</label>
                            <input style="margin-bottom: 2%"  type="password" name="password" required autocomplete="new-password"  >
                            @if ($errors->has('password'))
                            
                            <p style="margin-bottom: 2% ; color: red;">{{$errors->first('password')}}</p>
                            @endif
                        </div>
                        
                        <!-- Confirm Password -->
                        <div style="margin-bottom: 3%">
                            <label style="font-size: 20px ;" for="password_confirmation">Confirm Password:</label>
                                <input style="margin-bottom: 2%"type="password"
                                name="password_confirmation" required autocomplete="new-password" >
                                @if ($errors->has('password_confirmation'))
                                
                                <p style="margin-bottom: 2% ; color: red;">{{$errors->first('password_confirmation')}}</p>
                                @endif
                            </div>
                            <button style="" type="submit">
                                {{ __('Reset Password') }}
                            </button>
            </form>
            
    </div>
</body>
</html>

