@extends('layouts.app')
@section('title', 'Initialize Monthly Bonus')

@section('content')
    <div class="container">
        <div class="card">
            <div class='card-header'>
                <h5>Enter Time Span </h5>
            </div>
            <div class="card card-body">
                <form method="get" action="{{route('start2')}}">
                    @csrf
                    <input id="start" name="start" type="text" value="{{$start}}">
                    <input id="end" name="end" type="text" value="{{$end}}">
                    <button type="submit" name="notes" value="notes"
                            class="btn btn-success btn-sm text-xl-right">
                        Ready Set Go
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
