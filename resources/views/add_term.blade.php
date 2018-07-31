@extends('layouts.app')

@section('page_title', 'Add new tracking term')

@section('main')

    <div class="row mt-4">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Enter the new term you want to track</h5>
                    <form action="{{route('tracked-terms.store')}}" method="post" class="form-inline">
                        {{csrf_field()}}
                        <label class="sr-only" for="inlineFormInputName2">Add a new term to be tracked</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" name="tracked_term" id="tracked_term"
                               placeholder="" maxlength="30">
                        <button class="btn btn-blue mb-2" type="submit">Add</button>
                    </form>
                    @if(!$errors->isEmpty())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                <small class="text-danger d-block">{{ $err }}</small>
                            @endforeach
                        </div>
                    @endif
                    <a href="{{route('dashboard')}}">Cancel</a>
                </div>
            </div>
        </div>
    </div>

@endsection
