@extends('layout')

@section('title', 'Comentarios de ' . $restaurant->name)

@section('bodyClass', 'class=comment')

@section('content')

<div class="comment-section">
    <h1>Comentarios para {{ $restaurant->name }}</h1>

    @if ($comments->isEmpty())
        <p>{{__('No hay comentarios para este restaurante')}}</p>
    @else
        <div class="comments-container">
            @foreach ($comments as $comment)
                <div class="comment-item">
                    <div class="comment-header">
                        <strong>{{ $comment->user->fullName }}</strong>
                        <span>{{ $comment->created_at->format('d-m-Y') }}</span>
                    </div>
                    <p class="comment-text">{{ $comment->commentText }}</p>

                    <div class="comment-footer">
                        @if (Auth::check())
                            @if (!$comment->hasLikedBy(Auth::user()))
                                <form action="{{ route('comment.like', $comment->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-like">
                                        <i class="fa-solid fa-thumbs-up"></i> {{ $comment->likes }}
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('comment.unlike', $comment->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-unlike">
                                        <i class="fa-solid fa-thumbs-down"></i> {{ $comment->likes }}
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>

                    @if ($comment->restaurantReply)
                        <div class="comment-reply">
                            <p><strong>{{__('Respuesta del restaurante')}}:</strong></p>
                            <p>{{ $comment->restaurantReply }}</p>
                        </div>
                    @endif

                    @if (Auth::check() && Auth::user()->role === 'restaurant')
                        <form action="{{ route('restaurant.reply', $comment->id) }}" method="POST">
                            @csrf
                            <textarea name="reply" placeholder="Responder al comentario" required></textarea>
                            <button type="submit" class="btn-reply">{{__('Responder')}}</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    @if (Auth::check() && $hasOrdered)
        <div class="add-comment">
            <h2>{{__('Añadir un comentario')}}</h2>
            <form action="{{ route('comments.store', $restaurant->id) }}" method="POST">
                @csrf
                <textarea name="commentText" placeholder="Escribe tu comentario" required></textarea>
                <button type="submit" class="btn-submit">Enviar</button>
            </form>
        </div>
    @else
        <p class="warning">{{__('Solo los usuarios registrados que han realizado un pedido en este restaurante pueden añadir comentarios')}}.</p>
    @endif
    <div class="btn">
        <a href="{{ route('restaurant.show', $restaurant->id) }}" class="btn-back">{{__('Volver al restaurante')}}</a>
    </div>
</div>

@endsection
