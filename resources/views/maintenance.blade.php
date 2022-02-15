@extends('layouts.app')

@section('content')
<div class="container ps-5">
    <div class="d-flex justify-content-center">
        <table class="table">
            <thead>
              <tr>
                <th scope="col" class="text-center">{{ __('general.account') }}</th>
                <th scope="col" class="text-center">{{ __('general.action') }}</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($show as $s)
                    <tr>
                        <td class="text-center">{{$s->first_name}} {{$s->last_name}} - {{$s->role_desc}}</td>
                        <td class="text-center d-flex justify-content-around">
                            <a href="/updaterole/{{$s->account_id}}">{{ __('general.updaterole') }}</a>
                            <form action="/delete-account/{{$s->account_id}}" method="POST">
                                @csrf
                                @method('put')
                                <button class="text-primary bg-white border-0"><u>{{ __('general.delete') }}</u></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection
