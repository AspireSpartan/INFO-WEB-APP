@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    @include('Components.User.Hero.Hero', ['pageContent' => $pageContent])
    <x-User.Blog.index :blogfeeds="$blogfeeds"></x-User.Blog.index>

@endsection
