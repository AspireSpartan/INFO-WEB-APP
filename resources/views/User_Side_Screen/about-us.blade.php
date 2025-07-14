{{-- Components/User_Side_Screen/about-us.blade.php --}}
@extends('layouts.app')

@section('title', 'About-us')

@section('content')
    {{-- Pass contentManager and contentOffer as props to the section-1 component --}}
    <x-User.about-us.section-1
        :contentManager="$contentManager"
        :contentOffer="$contentOffer"
    ></x-User.about-us.section-1>

    <x-User.about-us.section-2></x-User.about-us.section-2>
    <x-User.about-us.section-3></x-User.about-us.section-3>
    <x-User.about-us.section-4></x-User.about-us.section-4>
@endsection