@extends('layout')

@section('title')
@stop

@section('content')
    <h1 class="section-header">
        {{ $user->display_name }}'s Profile
    </h1>
    <div style="color:white;padding:1rem;">
        <h2>{{ $user->display_name }} has used Streameroni since {{ $user->created_at->toFormattedDateString() }}.</h2>
        <h2>
            {{ $user->display_name }} is a subscriber!
        </h2>
    </div>
@stop

