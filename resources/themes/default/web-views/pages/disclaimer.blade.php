@extends('layouts.front-end.app')

@section('title', translate('disclaimer'))

@section('content')
    <div class="container py-5 rtl text-align-direction">
        <h2 class="text-center mb-3 headerTitle">{{translate('disclaimer')}}</h2>
        <div class="card __card">
            <div class="card-body text-justify">
                {!! $disclaimer !!}
            </div>
        </div>
    </div>
@endsection
