<div class="">
           
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Profile Information <small>Update your account's profile information and email address.</small></h2>
                    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    
                    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{route('verification.send')}}" method="post" id="send-verification">
                @csrf
                </form>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                    method="POST" action="{{route('profile.update')}}" 
                    >
                    @csrf
                    @method('patch')
                    <input type="hidden" name="id" value="{{Auth::user()->id}}">
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input name="name" type="text" value="{{old('name', Auth::user()->name)}}" id="first-name" required="required" class="form-control ">
                                {{-- <input :messages="$errors->get('name')"> --}}
                                {{-- @if($errors->has('email'))
                                    {{$message}}
                                @endif --}}
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Email <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input name="email" type="text" value="{{old('email', Auth::user()->email)}}" id="first-name" class="form-control ">
                            </div>
                        </div>
                        @php
                            $user = Auth::User();
                        @endphp
                        @if ($user instanceof Illuminate\Contracts\Auth\MustVerifyEmail && 
                        !$user->hasVerifiedEmail())
                        
                        <div class="item form-group">
                            <label style="color: red  ; " class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                <b>Your email address is unverified.</b>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <button form="send-verification"  class="btn btn-warning btn-sm">
                                    Click here to re-send the verification email
                                </button>
                            </div>
                        </div>
                        @endif
                        @if (session('Error'))
                        <div class="item form-group">
                            <label style="color: blue" class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <p style="margin-bottom: 4% ; color: red; font-size: 20px">{{session('Error')}}</p>
                                
                            </div>
                        </div>
                        @endif
                        @if (session('status') === 'verification-link-sent')
                        <div class="item form-group">
                            <label style="color: blue" class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <p style="margin-bottom: 4% ; color: green; font-size: 20px">
                                    A new verification link has been sent to your email address.    
                                </p>
                                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('') }}
                        </p>
                    </div>
                </div>
                @endif

                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success">Save</button>
                                @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif    
                            </div>
                            
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>