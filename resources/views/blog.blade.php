@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    <x-User.banner.banner></x-User.banner.banner>
    <x-User.blogcontent.blogcontent :newsfeeds="$newsfeeds"></x-User.blogcontent.blogcontent>
@endsection