@extends('layouts.admin')

@section('title', 'Admin View')

@section('content')
<x-Admin.Ad-Header.Ad-Header :newsItems="$newsItems"></x-Admin.Ad-Header.Ad-Header>
@endsection