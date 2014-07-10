@extends('layouts.main')
@section('title',"$post->title")
@section('content')
@include('partials.post.viewcontent')
@include('partials.post.sidebar')
@stop