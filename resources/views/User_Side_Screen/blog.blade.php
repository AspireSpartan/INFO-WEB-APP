@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    @include('Components.User.banner.banner', ['pageContent' => $pageContent]) 
    <x-User.Blog.index :blogfeeds="$blogfeeds"></x-User.Blog.index>

@endsection