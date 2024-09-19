@extends('layouts.app')

@section('title', 'ЛР: Мой блог')

@php
    $user = auth()->user();
@endphp

@section('content')
    <h1>Мой блог</h1>

    @if(session('success'))
        <p class="success-box">{{ session('success') }}</p>
        <hr>
    @endif

    @if (auth()->check() && $user instanceof App\Models\User && $user->is_admin)
        <section>
            <a href='{{ route('blog-editor') }}'>Редактор блога</a> /
            <a href='{{ route('blog-loader') }}'>Загрузка сообщений блога</a>
        </section>
    @endif

    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="blog">
                <h1>{!! $post->theme !!}</h1>

                <section>
                    <p>{!! $post->message !!}</p>

                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Изображение поста">
                    @endif
                </section>

                <p class="blog-datetime">{{ $post->created_at }}</p>
            </div>
        @endforeach

        {{ $posts->links('vendor.pagination.custom') }}
    @else
        <p>Постов нет.</p>
    @endif
@endsection
