@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-2">
            <div class="card">
                <div class=" p-3 offset-5"><h3>Register</h3></div> 
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group ">
                            <!-- <label for="username" class=" col-form-label text-md-right">{{ __('Username') }}</label> -->
                            <div class="">
                                <input id="username" type="text" class="form-control rounded-pill @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="" autofocus placeholder="Username">
                                    
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <!-- <label for="email" class=" col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
                            <div class="">
                                <input id="email" type="email" class="form-control rounded-pill @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email@something.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group ">
                            <div class="">
                                <select id="sex" class="form-control @error('sex') is-invalid @enderror " name="sex" value="{{ old('sex') }}" required placeholder="Sex" style="border-radius: 15px;">
                                    <option value="">Sex...</option>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                                @error('sex'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="">
                                <input id="location" type="text" class="form-control @error('location')  is-invalid @enderror" name="location" value="{{ old('location') }}" placeholder="Your Location" required placeholder="Location" style="border-radius: 15px;">

                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group ">
                            <label for="dob" class="col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                            <div class=""> 
                                <input type="date" name="birthday" id="birthday" class="form-control rounded-pill" placeholder="Date of birth">
                            
                            </div>
                        </div>
                        <div class="form-group ">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                            <div class="">
                                <input id="password" type="password" class="form-control rounded-pill @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <!-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> -->
                            <div class="">
                                <input id="password-confirm" type="password" class="form-control rounded-pill" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="categories" class="col-md-4 col-form-label text-md-right">{{ __('Categories of interest -  please pick categories for your feed') }}</label>
                                <div class="col-md-6">
                                    <select id="selected" name="categories[]" class="form-control selected" multiple="multiple" style="border-radius: 15px;">
                                    @foreach($cat as $category)
                                    {{$category}}
                                        @foreach($category->forums as $forum)
                                                <option value="{{$forum->id}}">{{$forum->name}}</option>
                                        @endforeach
                                    @endforeach
                                    </select>
                                </div>
                                    @error('categories')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                        <div class="form-group ">
                                        <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Upload Avatar') }}</label>

                                        <div class="">
                                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" style="border-radius: 15px;">
                                        </div>
                                        @error('avatar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-0">
                                <button type="submit" class="btn btn-secondary btn-block rounded-pill">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            <div class="col-md-6"><input type="reset" value="RESET" class="btn btn-primary btn-block rounded-pill">
                            </div>
                                
                         <span  class="offset-3">Have an account already? <span class="btn btn-link"> <a href="/login"> Login here </a> </span></span>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
