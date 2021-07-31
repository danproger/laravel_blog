@extends('layouts/app')

@section('page-title')
    Новая статья
@endsection

@section('content')
    <div class="bg-white p-3 rounded">
        <div>
            <h1>Создание новой статьи:</h1>
        </div>
        <form action="{{ action('ArticlesController@store') }}" method="POST" enctype="multipart/form-data">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="form-group">
                <label for="title">Введите заголовок статьи: *</label>
                <input type="text" class="form-control" name="title" placeholder="Заголовок...">
            </div>
            <div class="form-group my-3">
                <label for="text">Введите текст статьи: *</label>
                <textarea id="text-editor" name="text" placeholder="Текст статьи..."></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="text">Вы можете прикрепить изображение к вашей статье:</label>
                <div class="text-center mt-1">
                    <input type="file" name="main_image">
                </div>
            </div>
            @include('blocks/ers')
            <div class="text-end">
                <button type="submit" class="btn btn-success">
                    Добавить
                </button>
            </div>
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
