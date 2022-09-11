@extends('layout')
@section('title', 'show gig page')
@section('content')
    <h2>{{$gig['title']}}</h2>
    <p>{{$gig['description']}}</p>
@endsection