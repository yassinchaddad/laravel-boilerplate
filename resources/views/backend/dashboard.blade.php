@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => $logged_in_user->name])
        </x-slot>

        <x-slot name="body">
            @lang('Welcome to the Dashboard')
        </x-slot>
    </x-backend.card>

    <x-backend.card>
        <x-slot name="header">
            <h1>Total users count: {{ $countData ?? 0 }}</h1>
        </x-slot>
    </x-backend.card>

    <x-backend.card>
        <x-slot name="header">
            <h1>Users count by type</h1>
        </x-slot>
        <x-slot name="body">
            @if (count($typeData ?? []) <= 1)
            <p> No Data Available </p>
            @else
            <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
            @endif
        </x-slot>
    </x-backend.card>

    <x-backend.card>
        <x-slot name="header">
            <h1>Users count by date</h1>
        </x-slot>
        <x-slot name="body">
            @if (count($dateData ?? []) <= 1)
            <p> No Data Available </p>
            @else
            <div id="barchart_material" style="width: 900px; height: 500px;"></div>
            @endif
        </x-slot>
    </x-backend.card>
@endsection
