{{-- /resources/views/User_Side_Screen/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {{-- Corrected path to the user-side banner component --}}
    {{-- It should be 'Components.User.banner.banner' based on your provided file structure --}}
    @include('Components.User.banner.banner', ['pageContent' => $pageContent])
    <x-User.latestnews.latestnews :newsItems="$newsItems" :logos="$logos" :caption="$caption"></x-User.latestnews.latestnews>
    <x-User.3goals.3goals></x-User.3goals.3goals>
    <x-User.completeproj.completeproj :projects="$projects" :description="$description"></x-User.completeproj.completeproj>
    <x-User.teamdev.teamdev></x-User.teamdev.teamdev>
@endsection
