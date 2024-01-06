@extends('admin.layouts.master')
@section('title')
    Profile
@endsection
@section('main-content')
@include('admin.profile.edit')
@include('admin.profile.update_password')
@include('admin.profile.delete_user')
{{-- @include('profile.partials.update-profile-information-form') --}}

@endsection