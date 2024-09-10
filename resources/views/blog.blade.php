@extends('layouts.app')

@section('title', 'ЛР: Мой блог')

@section('content')
    <h1>Мой блог</h1>

    @if(session('success'))
        <p class="success-box">{{ session('success') }}</p>
        <hr>
    @endif

    <section>
        <a href='{{ route('blog-editor') }}'>Редактор блога</a> /
        <a href='{{ route('blog-loader') }}'>Загрузка сообщений блога</a>
    </section>

    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="blog">
                <h1>{{ $post->theme }}</h1>

                <section>
                    <p>{!! nl2br(e($post->message)) !!}</p>

                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Изображение поста">
                    @endif
                </section>

                <p class="blog-datetime">{{ $post->created_at }}</p>
            </div>
        @endforeach
    @else
        <p>Постов нет.</p>
    @endif
@endsection
