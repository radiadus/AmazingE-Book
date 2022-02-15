@extends('layouts.app')

@section('content')
<div class="container pt-4 pb-4">
    <h4><u>E-Book Detail</u></h4>
    <div class="row">
        <div class="col-2">
            <p>{{ __('general.title') }}:</p>
            <p>{{ __('general.author') }}:</p>
            <p>{{ __('general.desc') }}:</p>
        </div>
        <div class="col">
            <p>{{$ebook->title}}</p>
            <p>{{$ebook->author}}</p>
            <p>{{$ebook->description}}</p>
        </div>
    </div>
    <div class="text-end">
        <form action="/ebookdetail/{id}" method="POST">
            @csrf
            <input type="hidden" name="ebook_id" value="{{$ebook->ebook_id}}">
            <button type="submit" class="btn btn-warning">{{ __('general.rent') }}</button>
        </form>
    </div>
</div>
@endsection
