@extends('layouts.app')

@section('meta')
    <meta name="user-id" content="{{ auth()->user()->id }}">
@endsection

@section('content')
<div class="container">
    SHOWING BOARD
</div>
@endsection
