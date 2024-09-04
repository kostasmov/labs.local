@extends('layouts.app')

@section('title', 'ЛР: Фотоальбом')

@section('content')
    <h1>Фотоальбом</h1>
    <div id="photo-album"></div>
@endsection

@section('foot-scripts')
    <script src="{{ asset('scripts/photos-table.js') }}"></script>
@endsection
