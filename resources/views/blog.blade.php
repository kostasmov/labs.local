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
            <div class="blog" id="post-{{ $post->id }}">
                <h1>{!! nl2br(e(base64_decode($post->theme))) !!}</h1>

                <section>
                    <p>{!! nl2br(e(base64_decode($post->message))) !!}</p>

                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Изображение поста">
                    @endif
                </section>

                <p class="blog-datetime">{{ $post->created_at->format('d.m.Y H:i') }}</p>

                @auth
                    <div class="button-container">
                        <button class="blog-btn" onclick="openCommentModal({{ $post->id }})">
                            Добавить комментарий
                        </button>

                        @if ($user instanceof App\Models\User && $user->is_admin)
                            <button class="blog-btn" onclick="openRedactModal({{ $post }})">
                                Изменить
                            </button>
                        @endif
                    </div>
                @endauth

                <div class="comments" id="comments-{{ $post->id }}">
                    @foreach($post->comments as $comment)
                        <div class="comment">
                            <b>{{ $comment->user->name }}</b>
                            <p>{!! nl2br(e(base64_decode($comment->comment))) !!}</p>
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

@section('head-scripts')
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
            textarea.rows = 4;
            textarea.cols = 50;

            let buttonContainer = document.createElement('div');
            buttonContainer.classList.add('modal-buttons');

            let closeButton = document.createElement('button');
            closeButton.id = 'closeButton';
            closeButton.textContent = 'Отмена';

            let submitButton = document.createElement('button');
            submitButton.id = 'submitButton';
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

                sendComment(postID, commentText);

                document.body.removeChild(modal);
                document.body.classList.remove("no-scroll");
            });
        }

        function sendComment(postID, commentText) {
            fetch('{{ route('send-comment') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Cache-Control': 'no-cache',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    postID: postID,
                    userID: {{ optional(auth()->user())->id ?? 'null' }},
                    comment: commentText
                })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Fetch Response не ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data)

                    const comments = document.getElementById('comments-' + data.blog_id);

                    let commentContainer = document.createElement('div');
                    commentContainer.classList.add('comment');

                    let username = document.createElement('b');
                    username.textContent = data.user_name;

                    let commentTextElement = document.createElement('p');
                    commentTextElement.innerHTML = data.comment_text;

                    let commentDatetime = document.createElement('p');
                    commentDatetime.classList.add('comment-datetime');
                    commentDatetime.textContent = data.created_at;

                    commentContainer.appendChild(username);
                    commentContainer.appendChild(commentTextElement);
                    commentContainer.appendChild(commentDatetime);

                    comments.appendChild(commentContainer);
                })
                .catch(error => {
                    console.error('Проблема с FETCH:', error);
                    alert(error);
                });
        }

        function openRedactModal(post) {
            const postContainer = document.getElementById('post-' + post.id);
            const themeElement = postContainer.querySelector('h1');
            const messageElement = postContainer.querySelector('section p');

            let modal = document.createElement("div");
            modal.classList.add("modal");

            let modalContent = document.createElement("div");
            modalContent.classList.add("modal-content");

            let title = document.createElement('h2');
            title.textContent = 'Редактирование блога';

            /**
             * @type {HTMLIFrameElement}
             */
            let iframe = document.createElement('iframe');
            iframe.name = 'updateFrame';
            iframe.style.display = 'none';

            /**
             * @type {HTMLFormElement}
             */
            let form = document.createElement('form');
            form.target = 'updateFrame';
            form.method = 'post';
            form.action = '{{ route('update-blog') }}';

            /**
             * @type {HTMLInputElement}
             */
            let postIDInput = document.createElement('input');
            postIDInput.type = 'hidden';
            postIDInput.name = 'postID';
            postIDInput.value = post.id;
            form.appendChild(postIDInput);

            /**
             * @type {HTMLInputElement}
             */
            let input = document.createElement('input');
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            input.type = 'hidden';
            input.name = '_token';
            input.value = csrfToken;
            form.appendChild(input);

            /**
             * @type {HTMLInputElement}
             */
            let theme = document.createElement('input');
            theme.value = themeElement.textContent;
            theme.type = 'text';
            theme.name = 'theme';

            let textarea = document.createElement('textarea');
            textarea.value = messageElement.textContent;
            textarea.rows = 4;
            textarea.cols = 50;
            textarea.name = 'message';

            let buttonContainer = document.createElement('div');
            buttonContainer.classList.add('modal-buttons');

            let closeButton = document.createElement('button');
            closeButton.id = 'closeButton';
            closeButton.textContent = 'Отмена';

            /**
             * @type {HTMLButtonElement}
             */
            let submitButton = document.createElement('button');
            submitButton.id = 'submitButton';
            submitButton.type = 'submit';
            submitButton.textContent = 'Сохранить изменения';

            buttonContainer.appendChild(closeButton);
            buttonContainer.appendChild(submitButton);

            form.appendChild(theme);
            form.appendChild(textarea);
            form.appendChild(buttonContainer);

            modalContent.appendChild(title);
            modalContent.appendChild(form);
            modalContent.appendChild(iframe);

            modal.appendChild(modalContent);
            document.body.appendChild(modal);
            document.body.classList.add("no-scroll");

            closeButton.addEventListener('click', function () {
                document.body.removeChild(modal);
                document.body.classList.remove("no-scroll");
            });

            iframe.onload = function() {
                const response = iframe.contentDocument.body.innerText;

                if (!response) { return; }

                const result = JSON.parse(response);

                if (result.success) {
                    themeElement.innerHTML = result.theme;
                    messageElement.innerHTML = result.message;
                } else {
                    alert('Ошибка при обновлении поста');
                }

                document.body.removeChild(modal);
                document.body.classList.remove("no-scroll");

                // try {
                //     const response = iframe.contentDocument.body.innerText;
                //     console.log(response);
                //
                //     if (!response) return;
                //
                //     const parser = new DOMParser();
                //     const xmlDoc = parser.parseFromString(response, 'application/xml');
                //
                //     const success = xmlDoc.getElementsByTagName('success')[0].textContent === 'true';
                //
                //     if (success) {
                //         const theme = xmlDoc.getElementsByTagName('theme')[0].textContent;
                //         const message = xmlDoc.getElementsByTagName('message')[0].textContent;
                //
                //         themeElement.innerHTML = theme;
                //         messageElement.innerHTML = message;
                //     } else {
                //         const error = xmlDoc.getElementsByTagName('error')[0].textContent;
                //
                //         alert('Ошибка:' + error);
                //     }
                //
                //     document.body.removeChild(modal);
                //     document.body.classList.remove("no-scroll");
                //
                // } catch (error) {
                //     console.error(error);
                //     alert('Произошла ошибка');
                // }
            };

            submitButton.addEventListener('click', function (event) {
                event.preventDefault();
                form.submit();
            });
        }
    </script>
@endsection
