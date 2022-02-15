@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info">{{ __('general.updateprofile') }}</div>

                <div class="card-body">
                    <form method="POST" action="/profile" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('general.firstname') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value={{Auth()->user()->first_name}} required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="middle_name" class="col-md-4 col-form-label text-md-end">{{ __('general.middlename') }}</label>

                            <div class="col-md-6">
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{Auth()->user()->middle_name}}" required autocomplete="middle_name" autofocus>

                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('general.lastname') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{Auth()->user()->last_name}}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('general.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth()->user()->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('general.gender') }}</label>
                            <div class="col-md-6 d-flex align-items-center">
                                <input type="radio" name="gender_id" value="0" @if (Auth()->user()->gender_id==0)checked @endif class="form-check-input">
                                <label for="" class="me-3">{{ __('general.male') }}</label>
                                <input type="radio" name="gender_id" value="1" @if (Auth()->user()->gender_id==1)checked @endif class="form-check-input">
                                <label for="">{{ __('general.female') }}</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('general.role') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="col-md-4 col-form-label text-md-end" disabled value={{$show->role_desc}}>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('general.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="display_picture_link" class="col-md-4 col-form-label text-md-end">{{ __('general.picture') }}</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control @error('display_picture_link') is-invalid @enderror" name='display_picture_link'>
                                <img src="/storage/images/{{Auth()->user()->display_picture_link}}" alt="" width="200" height="200">
                            </div>
                        </div>

                        <div class="row mb-0 d-flex justify-content-center">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('general.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
