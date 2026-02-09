@extends('layouts.admin')

@section('title', 'Coupons & Codes')

@section('content')
    <x-coupons-manager 
        :coupons="$coupons" 
        :requireCredits="false"
        createRoute="admin.coupons.store"
        deleteRoute="admin.coupons.destroy"
    />
@endsection
