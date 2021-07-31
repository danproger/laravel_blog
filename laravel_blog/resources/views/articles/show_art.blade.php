@extends('layouts/app')

@section('page-title')
    {{ $article->title }}
@endsection

@section('content')
    <div class="bg-white px-5 py-4 rounded">
        <div>
            <h1 class="text-center">{{ $article->title }}</h1>
            <p>{!! $article->text !!}</p>
        </div>
        <div class="text-center text-md-end">
            <p>
                Автор: {{ $article->user->name }}
            </p>
            <p>
                Дата создания: {{ explode(" ", $article->created_at)[0] }}
            </p>
        </div>
        @if(!Auth::guest())
            @if(Auth::user()->id == $article->user_id)
                <hr>
                <div class="d-flex flex-row justify-content-between">
                    <a href="/articles/{{$article->id}}/edit" class="btn btn-outline-success">
                        Редактировать
                    </a>
                    <form action="{{ action('ArticlesController@destroy', $article->id) }}" method="POST">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-success">
                            Удалить
                        </button>
                        @method('DELETE')
                    </form>
                </div>
            @endif
        @endif
    </div>

    <div class="bg-white p-3 rounded mt-3">
        <h3>
            Комментарии:
        </h3>
        <div class="mt-3 comment-form">
            <form action="{{ action('ArticlesController@comment', $article->id) }}" method="POST" enctype="multipart/form-data">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                <textarea name="comment_text" rows="3" class="form-control my-3" placeholder="Оставьте комментарий..."></textarea>
                @include('blocks/ers')
                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        Оставить комментарий
                    </button>
                </div>
            </form>
            <hr>
            <div class="comments">
                @foreach($comments as $comment)
                    <div class="alert alert-success">
                        <div class="d-flex flex-column flex-md-row justify-content-md-between">
                            @if($comment->author == Auth::user()->name)
                                <h6 style="color: orangered;">Вы</h6>
                            @else
                                <h6>{{ $comment->author }}</h6>
                            @endif
                            <span>{{ $comment->created_at }}</span>
                        </div>
                        <p>
                            {{ $comment->text }}
                        </p>
                        @if(Auth::user()->name == $comment->author)
                            <form action="{{ action('ArticlesController@delete_comment', $comment->id) }}" method="GET" class="text-end">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger">
                                    Удалить
                                </button>
                                @method('DELETE')
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
