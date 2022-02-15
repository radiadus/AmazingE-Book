@extends('layouts.app')

@section('content')
<div class="container ps-5">
    <div class="d-flex justify-content-center">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">{{ __('general.author') }}</th>
                <th scope="col">{{ __('general.title') }}</th>
              </tr>
            </thead>
            <tbody>
                @if (count($ebooks)==0)
                    <tr>
                            <td colspan="2">{{ __('general.nodata') }}</td>
                    </tr>
                @else
                    @foreach ($ebooks as $e)
                        <tr>
                            <td>{{$e->author}}</td>
                            <td><a href="/ebookdetail/{{$e->ebook_id}}">{{$e->title}}</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
          </table>
    </div>
</div>
@endsection
