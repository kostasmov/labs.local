@extends('layouts.app')

@section('title', 'ЛР: Фотоальбом')

@section('content')
    <h1>Фотоальбом</h1>
    <div id="photo-album">
        @for ($i = 0; $i < count($photos); $i += 6)
            <div class="row">
                @for ($j = $i; $j < $i + 6 && $j < count($photos); $j++)
                    <div class="photo-container">
                        <img
                            src="{{ $photos[$j] }}"
                            alt="{{ $titles[$j] }}"
                            title="{{ $titles[$j] }}"
                            onclick="showImageModal('{{ $photos[$j] }}', '{{ $titles[$j] }}')"
                        />
                        <div class="caption">{{ $titles[$j] }}</div>
                    </div>
                @endfor
            </div>
        @endfor
    </div>
@endsection

@section('foot-scripts')
    @vite(['resources/js/photos-table.js'])
@endsection
