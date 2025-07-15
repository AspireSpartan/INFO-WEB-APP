{{-- /resources/views/User_Side_Screen/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {{-- Corrected path to the user-side Hero component --}}
    {{-- It should be 'Components.User.Hero.Hero' based on your provided file structure --}}
    @include('Components.User.Hero.Hero', ['pageContent' => $pageContent])
    <x-User.latestnews.latestnews :newsItems="$newsItems" :logos="$logos"
                                  :caption="$caption"></x-User.latestnews.latestnews>
    <x-User.announcement.announcement></x-User.announcement.announcement>
    <x-User.completeproj.completeproj :projects="$projects"
                                      :description="$description"></x-User.completeproj.completeproj>
    <x-User.PublicOfficials.PublicOfficials :officials="$officials"
                            :publicOfficialCaption="$publicOfficialCaption"></x-User.PublicOfficials.PublicOfficials>
<x-user.footer.footer
    :keepInTouch="$keepInTouch"
    :footerLogo="$footerLogo"
    :aboutGovph="$aboutGovph"
    :govphLinks="$govphLinks"
    :governmentlinks="$governmentlinks"
    :footertitle="$footertitle"
/>
@endsection
