@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <x-User.banner.banner :sectionBanner="$sectionBanner"></x-User.banner.banner>
    <x-User.latestnews.latestnews></x-User.latestnews.latestnews>
    <x-User.3goals.3goals></x-User.3goals.3goals>
    <x-User.completeproj.completeproj></x-User.completeproj.completeproj>
    <x-User.teamdev.teamdev></x-User.teamdev.teamdev>
@endsection
