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

{{--        <div id="commentModal" class="modal" style="display: none;">--}}
{{--            <div class="modal-content">--}}
{{--                <span class="close" onclick="closeCommentModal()">&times;</span>--}}
{{--                <h2>Добавить комментарий</h2>--}}
{{--                <textarea id="commentText" rows="4" cols="50"></textarea>--}}
{{--                <button id="submitComment">Отправить</button>--}}
{{--            </div>--}}
{{--        </div>--}}

        {{ $posts->links('vendor.pagination.custom') }}
    @else
        <p>Постов нет.</p>
    @endif
@endsection

@section('foot-scripts')
    <script>
        let currentPostId = null;

        function openCommentModal(postId) {
            currentPostId = postId;

            let modal = document.createElement("div");
            modal.classList.add("modal");

            document.body.classList.add("no-scroll");

            // let img = document.createElement("img");
            // img.classList.add("modal-content");
            // img.src = src;
            // img.alt = alt;

            // modal.appendChild(img);
            document.body.appendChild(modal);

            modal.addEventListener('click', function() {
                document.body.removeChild(modal);
                document.body.classList.remove("no-scroll");
            });

            // document.getElementById('commentModal').style.display = 'block';
        }

        //
        // function closeCommentModal() {
        //     document.getElementById('commentModal').style.display = 'none';
        //     document.getElementById('commentText').value = '';
        // }
        //
        // document.getElementById('submitComment').addEventListener('click', function() {
        //     const commentText = document.getElementById('commentText').value;
        //
        //     if (commentText.trim() === '') {
        //         alert('Комментарий не может быть пустым.');
        //         return;
        //     }
        //
        //     fetch('/comments', {
        //         method: 'POST',
        //         headers: {
        //             'Content-Type': 'application/json',
        //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //         },
        //         body: JSON.stringify({
        //             post_id: currentPostId,
        //             comment: commentText
        //         })
        //     })
        //         .then(response => response.json())
        //         .then(data => {
        //             const commentsDiv = document.getElementById('comments-' + currentPostId);
        //             const newComment = document.createElement('div');
        //             newComment.classList.add('comment');
        //             newComment.innerHTML = `<strong>${data.author}</strong><p>${data.comment}</p><p>${data.created_at}</p>`;
        //             commentsDiv.appendChild(newComment);
        //
        //             closeCommentModal();
        //         })
        //         .catch(error => console.error('Ошибка:', error));
        // });
    </script>
@endsection
