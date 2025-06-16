@extends('layouts.app')

@section('title', 'More News')

@section('content')
    <x-User.newscontent.newscontent :newsItems="$newsItems"></x-User.newscontent.newscontent>
@endsection