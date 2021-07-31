@extends('layouts/app')

@section('page-title')
    Все статьи
@endsection

@section('content')
    <div class="bg-white p-3 rounded">
        <h2 class="d-block text-center">Все статьи:</h2>
        @if(count($articles) > 0)
            <div class="row text-center">
                @foreach($articles as $art)
                    <div class="col-12 col-md-6 col-lg-4 well mt-4">
                        <a href="/articles/{{ $art->id }}">
                            <img src="/storage/images/{{ $art->image }}" alt="~" class="img-thumbnail" style="width: 300px; height: 300px;">
                            <h3>
                                {{ $art->title }}
                            </h3>
                        </a>
                        <p>
                            Автор: {{ $art->user->name }}
                            <br>
                            Последнее обновление: {{ $art->updated_at }}
                        </p>
                    </div>
                @endforeach
            </div>
            <div style="max-height: 40px;" class="text-center pagination-my">
                {{ $articles->links() }}
            </div>
        @else
            <div class="text-center">
                <p>
                    На данный момент тут нет статей!
                </p>
            </div>
        @endif
    </div>
@endsection
