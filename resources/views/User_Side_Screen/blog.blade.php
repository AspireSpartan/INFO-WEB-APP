@extends('layouts.app')

@section('title', 'Blog')

@section('content')

<x-User.banner.banner :sectionBanner="$sectionBanner"></x-User.banner.banner>
<x-User.Blog.index :blogfeeds="$blogfeeds"></x-User.Blog.index>

@endsection