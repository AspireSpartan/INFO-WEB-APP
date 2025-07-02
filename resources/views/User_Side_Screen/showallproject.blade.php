@extends('layouts.app')

@section('title', 'All Projects')

@section('content')
    <x-User.showallproject.showallproject :projects="$projects" :description="$description"></x-User.showallproject.showallproject>
@endsection

