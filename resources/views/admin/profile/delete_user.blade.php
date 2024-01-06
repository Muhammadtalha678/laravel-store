<div class="">
    
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Delete Account </h2>
                    <div class="clearfix"></div>
                </div>
                <h6>Once your account is deleted, all of its resources and data will be permanently deleted.
                    Before deleting your account, please download any data or information that you wish to retain.</h6>
                    
                        <div class="col-md-6 col-sm-6 ">
                            <button id="deleteButton" class="btn btn-danger">Delete</button>
                        </div>
                    
                <div class="x_content">
                    <br />
                    
                    {{-- <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                            @csrf
                            @method('delete')
                
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Are you sure you want to delete your account?') }}
                            </h2>
                
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                            </p>
                
                            <div class="mt-6">
                                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                
                                <x-text-input
                                    id="password"
                                    name="password"
                                    type="password"
                                    class="mt-1 block w-3/4"
                                    placeholder="{{ __('Password') }}"
                           `     />
                
                            `    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                            </div>
                
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                
                                <x-danger-button class="ml-3">
                                    {{ __('Delete Account') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal> --}}
                    {{-- <form method="POST" style="display: none"  id="confirmationForm" data-parsley-validate class="form-horizontal form-label-left">
                        <h6>Once your account is deleted, all of its resources and data will be permanently deleted.
                            Before deleting your account, <br>please download any data or information that you wish to retain.</h6>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 ">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </div>

                    </form> --}}
                    <form method="POST" style="display: none ; border: 1px solid #ccc;
                    padding: 20px;
                    background-color: #f7f7f7;
                    text-align: center;"  id="confirmationForm" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @method('delete')
                        <h2 style="color: coral"><b>Are You Sure You Want To Delete Your Account?</b></h2>
                        <h6 class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </h6>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input name="password" type="password" id="password" class="form-control " autocomplete="current-password">
                                @if ($errors->userDeletion->has('password'))
                                <div  id="errorMessage" class="error" style="color: red ; font-size: 16px">
                                    {{ $errors->userDeletion->first('password') }}
                                </div>                      
                                @endif
                            </div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 ">
                                    <button id="cancelButton" type="button" class="btn btn-primary">Cancel</button>
                                </div>
                            </div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 ">
                                    <button type="submit" id="del" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    
                </div>
            </div>
        </div>
    </div>


</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButton = document.getElementById("deleteButton");
        const confirmationForm = document.getElementById("confirmationForm");
        const cancelButton = document.getElementById("cancelButton");
        const del = document.getElementById("del");
        // const errorMessage = document.getElementById("errorMessage");

        deleteButton.addEventListener("click", function () {
            confirmationForm.style.display = "block";
        });

        cancelButton.addEventListener("click", function () {
            confirmationForm.style.display = "none";
        });
        del.addEventListener("click", function () {
            confirmationForm.style.display = "block";
        });
        
    });
</script>
