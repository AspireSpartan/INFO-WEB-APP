{{-- Components/User_Side_Screen/about-us.blade.php --}}
@extends('layouts.app')

@section('title', 'About-us')

@section('content')
    {{-- Pass communityContent and carouselImages as props to the section-3 component --}}
    <x-User.about-us.section-1
        :contentManager="$contentManager"
        :contentOffer="$contentOffer"
    ></x-User.about-us.section-1>

    <x-User.about-us.section-2 
    :contentMlogos="$contentMlogos" 
    :vmgEditableContentData="$vmgEditableContentData"
    :strategicPlans="$strategicPlans"></x-User.about-us.section-2>

    {{-- Pass the fetched data to section-3 --}}
    <x-User.about-us.section-3
        :communityContent="$communityContent"
        :carouselImages="$carouselImages"
    ></x-User.about-us.section-3>

    <x-User.about-us.section-4></x-User.about-us.section-4>

    <x-user.footer.footer
    :keepInTouch="$keepInTouch"
    :footerLogo="$footerLogo"
    :aboutGovph="$aboutGovph"
    :govphLinks="$govphLinks"
    :governmentlinks="$governmentlinks"
    :footertitle="$footertitle"
    :contactUsTitle="$contactUsTitle"
    :contactUsDetails="$contactUsDetails"
    :initialContactUsData="$initialContactUsData"
/>
@endsection