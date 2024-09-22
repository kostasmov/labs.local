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
                <h1>{!! nl2br(e(base64_decode($post->theme))) !!}</h1>

                <section>
                    <p>{!! nl2br(e(base64_decode($post->message))) !!}</p>

                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Изображение поста">
                    @endif
                </section>

                <p class="blog-datetime">{{ $post->created_at->format('d.m.Y H:i') }}</p>

                @if(auth()->check())
                    <button class="comment-btn" onclick="openCommentModal({{ $post->id }})">
                        Добавить комментарий
                    </button>
                @endif

                <div class="comments" id="comments-{{ $post->id }}">
                    @foreach($post->comments as $comment)
                        <div class="comment">
                            <b>{{ $comment->user->name }}</b>
                            <p>{{ $comment->comment }}</p>
                            <p class="comment-datetime">
                                {{ $comment->created_at->format('d.m.Y H:i') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        {{ $posts->links('vendor.pagination.custom') }}
    @else
        <p>Постов нет.</p>
    @endif
@endsection

@section('foot-scripts')
    <script>
        function openCommentModal(postID) {
            let modal = document.createElement("div");
            modal.classList.add("modal");

            let modalContent = document.createElement("div");
            modalContent.classList.add("modal-content");

            let title = document.createElement('h2');
            title.textContent = 'Добавить комментарий';

            /**
             * @type {HTMLTextAreaElement}
             */
            let textarea = document.createElement('textarea');
            textarea.id = 'commentText';
            textarea.rows = 4;
            textarea.cols = 50;

            let buttonContainer = document.createElement('div');
            buttonContainer.classList.add('comment-buttons');

            let closeButton = document.createElement('button');
            closeButton.id = 'closeComment';
            closeButton.textContent = 'Отмена';

            let submitButton = document.createElement('button');
            submitButton.id = 'submitComment';
            submitButton.textContent = 'Отправить';

            buttonContainer.appendChild(closeButton);
            buttonContainer.appendChild(submitButton);

            modalContent.appendChild(title);
            modalContent.appendChild(textarea);
            modalContent.appendChild(buttonContainer);

            modal.appendChild(modalContent);
            document.body.appendChild(modal);

            document.body.classList.add("no-scroll");

            closeButton.addEventListener('click', function() {
                document.body.removeChild(modal);
                document.body.classList.remove("no-scroll");
            });

            submitButton.addEventListener('click', function() {
                let commentText = textarea.value;

                sendCommentToServer(postID, commentText);

                document.body.removeChild(modal);
                document.body.classList.remove("no-scroll");
            });
        }

        function sendCommentToServer(postID, commentText) {
            {{--fetch({{ route('send-comment') }}, {--}}
            {{--    method: 'POST',--}}
            {{--    headers: {--}}
            {{--        'Content-Type': 'application/json'--}}
            {{--    },--}}
            {{--    body: JSON.stringify({--}}
            {{--        postID: postID,--}}
            {{--        user: {{ auth()->user() }},--}}
            {{--        comment: commentText--}}
            {{--    })--}}
            {{--})--}}
            {{--    // .then(response => {--}}
            {{--    //     // Работа с объектом Response--}}
            {{--    // })--}}
            {{--    // .catch(error => {--}}
            {{--    //     // Обработка ошибок--}}
            {{--    // });--}}
        }
    </script>
@endsection
