@extends('layouts.app')

@section('content')
    <div class="container ps-5">
        <div class="d-flex justify-content-center">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" class="text-center">{{ __('general.title') }}</th>
                </tr>
                </thead>
                <tbody>
                @if (count($cart)==0)
                    <tr>
                        <td class="text-center" colspan="2">No Data</td>
                    </tr>
                @else
                    @foreach ($cart as $c)
                        @foreach ($c->orders as $o)
                            <tr>
                                <td class="text-center">{{$c->title}}</td>
                                <td width="10%">
                                    <form action="deletecart/{{$o->order_id}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">{{ __('general.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="text-end">
            <form action="/submit" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning">{{ __('general.submit') }}</button>
            </form>
        </div>
    </div>
@endsection
