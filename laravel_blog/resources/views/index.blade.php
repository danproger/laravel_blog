@extends('layouts.app')

@section('page-title')
    Главная
@endsection

@section('content')
    <div class="bg-white p-3 rounded text-center">
        <div class="p-5 my-5">
            <h1>Интернет-блог</h1>
            <div class="my-5">
                <div class="my-5">
                    <h3>Вы можете читать статьи здесь:</h3>
                    <a href="/articles" class="btn btn-success btn-lg">Статьи</a>
                </div>
                <div class="my-5">
                    <h3>Чтобы писать статьи самому, вам нужно сначала зарегистрироваться:</h3>
                    <a href="/register" class="btn btn-success btn-lg">Регистрация</a>
                </div>
                <div class="my-5">
                    <h3>Если у вас уже есть аккаунт, авторизуйтесь:</h3>
                    <a href="/login" class="btn btn-success btn-lg">Войти</a>
                </div>
            </div>
        </div>
    </div>
@endsection
