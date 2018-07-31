@extends('layouts.app')

@section('page_title', 'Dashboard')

@section('main')

    <div class="row my-3">
        <div class="col">

        </div>
    </div>

    <div class="row my-3">
        <div class="col-md-3">
            <h4>Tracked terms:</h4>
            <ul class="list-group list-group-flush">
                @foreach($trackedTerms as $term)
                    <li class="list-group-item"><a href="{{route('dashboard', ['term' => $term])}}">{{$term}}</a></li>
                @endforeach
            </ul>
            <a  href="{{route('tracked-terms.create')}}" class="btn btn-outline-blue mt-3">Start tracking a new word</a>
        </div>
        <div class="col-md-9"></div>
    </div>
@endsection
