<div class="">
           
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Update Password <small>Ensure your account is using a long, random password to stay secure..</small></h2>
                    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    


                    <form method="POST" action="{{route('password.update')}}" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @method('PUT')
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="current_password">Current Password <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input name="current_password" type="password" id="current_password" class="form-control " autocomplete="current-password">
                                @if ($errors->updatePassword->has('current_password'))
                                <div  class="error" style="color: red ; font-size: 16px">
                                    {{ $errors->updatePassword->first('current_password') }}
                                </div>                      
                                @endif
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input name="password" type="password" id="password" class="form-control " autocomplete="current-password">
                                @if ($errors->updatePassword->has('password'))
                                <div  class="error" style="color: red ; font-size: 16px">
                                    {{ $errors->updatePassword->first('password') }}
                                </div>                      
                                @endif
                            </div>
                            
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="password_confirmation">password_confirmation<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input name="password_confirmation" type="password" id="password_confirmation" class="form-control " autocomplete="current-password">
                                @if ($errors->updatePassword->has('password_confirmation'))
                                <div  class="error" style="color: red ; font-size: 16px">
                                    {{ $errors->updatePassword->first('password_confirmation') }}
                                </div>                      
                                @endif
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success" >Submit</button>
                                @if (session('status') === 'password-updated')
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