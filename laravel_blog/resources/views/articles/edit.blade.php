@extends('layouts/app')

@section('page-title')
    Новая статья
@endsection

@section('content')
    <div class="bg-white p-3 rounded">
        <div>
            <h1>Обновление статьи:</h1>
        </div>
        <form action="{{ action('ArticlesController@update', $article->id) }}" method="POST" enctype="multipart/form-data">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="title">Введите заголовок статьи: *</label>
                <input value="{{ $article->title }}" type="text" class="form-control" name="title" placeholder="Заголовок...">
            </div>
            <div class="form-group my-3">
                <label for="text">Введите текст статьи: *</label>
                <textarea id="text-editor" name="text" placeholder="Текст статьи...">{{ $article->text }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="text">Прикрепить изображение к статье:</label>
                <div class="text-center mt-1">
                    <input type="file" name="new_image">
                </div>
            </div>
            @method('PUT')
            @include('blocks/ers')
            <hr>
            <button type="submit" class="btn btn-success">
                Обновить
            </button>
        </form>
    </div>
@endsection

@section('additional-scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#text-editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
