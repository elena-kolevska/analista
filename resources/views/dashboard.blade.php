@extends('layouts.app')

@section('page_title', 'Dashboard')

@section('main')

    <div class="row my-3">
        <div class="col">
            <a  href="{{route('tracked-terms.create')}}" class="btn btn-blue  float-right">Start tracking a new word</a>
        </div>
    </div>
@endsection
