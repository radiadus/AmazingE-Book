@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <div style="border-radius: 100%; width: 50vh; height: 50vh; border: 5px solid black" class="d-flex flex-column align-items-center justify-content-center">
            <h4 class="d-flex justify-content-center">{{ __('general.saved') }}</h4>
            <a href="/home" class="d-flex justify-content-center">{{ __('general.clickheretohome') }}</a>
        </div>
    </div>
</div>
@endsection
