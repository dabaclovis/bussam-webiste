@extends('layouts.app')

@section('content')
@if (Session::get('success'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        {{ session::get('success') }}
    </div>
@endif
@if (!Auth::guest())
    {{-- @include('layout.nav') --}}
@endif
    <div class="container">
       @if (count($articles) > 0)
            <div class="card-header text-primary">
                <h4 style="text-align: center;">Created Articles</h4>
            </div>
            @foreach ($articles as $article)
                @if ($article->image == 'noimage')
                        <div class="card">
                          <div class="card-body">
                            <blockquote class="blockquote">
                                <h4><a href="/articles/{{ $article->id }}">{{ $article->title }}</a></h4>
                              <p>{{ $article->body }}</p>
                              <footer class="card-blockquote">
                                  <p>posted by {{ $article->user->first_name }}</p>
                                </footer>
                            </blockquote>
                          </div>
                        </div>
                    @else
                    <div class="card">
                        <div class="card-body">
                          <blockquote class="blockquote">
                              <h4><a href="/articles/{{ $article->id }}">{{ $article->title }}</a></h4>
                            <p>{{ $article->body }}</p>
                            <footer class="card-blockquote">
                                <p>posted by {{ $article->user->first_name }}</p>
                            </footer>
                          </blockquote>
                        </div>
                      </div>
                @endif
            @endforeach
            {{ $articles->links() }}
       @endif
    </div>
@endsection
