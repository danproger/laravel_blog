@extends('layouts.app')

@section('page-title')
    Личный кабинет
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>
                        Ваши статьи: ({{ count($articles) }})
                    </h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(count($articles) > 0)
                        <div class="row text-center">
                            @foreach($articles as $art)
                                <div class="col-12 col-md-6 col-lg-4 well mt-4">
                                    <a href="/public/articles/{{ $art->id }}">
                                        <img src="/public/storage/images/{{ $art->image }}" alt="~" class="img-thumbnail" style="width: 300px; height: 300px;">
                                        <h3>
                                            {{ $art->title }}
                                        </h3>
                                    </a>
                                    <p>Последнее обновление: {{ $art->updated_at }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>
                            Вы пока что не написали ни одной статьи...
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
