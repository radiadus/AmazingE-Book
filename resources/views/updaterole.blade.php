@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info">{{ __('general.updaterole') }}</div>

                <div class="card-body">
                    <form method="POST" action="/savingrole/{{$account->account_id}}">
                        @csrf
                        @method('put')
                        <div class="row">
                            <label for="name" class="col-form-label d-flex justify-content-center">{{$account->first_name}} {{$account->middle_name}} {{$account->last_name}}</label>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('general.role') }}</label>

                            <div class="col-md-6">
                                <select name="role_id" id="" class="form-select">
                                    <option value="1" {{ ($account->role_id==1)? "selected" : "" }}>{{ __('general.user') }}</option>
                                    <option value="0" {{ ($account->role_id==0)? "selected" : "" }}>Admin</option>
                                </select>
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
