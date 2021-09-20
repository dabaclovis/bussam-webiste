@extends('layouts.app')

@section('content')
    @if (Session::get('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            {{ session::get('fail') }}
        </div>
    @endif
    <a href="/articles" class="btn btn-secondary"> back</a>
    <div class="container">
        @if ($article->image == 'noimage')
            <div class="card">
              <div class="card-body">
                <blockquote class="blockquote">
                    <h4 style="font-weight: bolder;">{{ $article->title }}</h4>
                  <p>{{ $article->body }}</p>
                  <footer class="card-blockquote">
                    @if (!Auth::guest())
                    @if ($article->user->id === Auth::user()->id)
                    <a href="/articles/{{ $article->id }}/edit" class="btn btn-secondary"> Edit</a>
                    {!! Form::open(['action' => ['App\Http\Controllers\ArticlesController@destroy',$article->id],
                    'method' => 'POST','enctype' => 'multipart/form-data','class' => 'pull-right']) !!}
                      {!! Form::hidden('_method', 'DELETE') !!}
                      {!! Form::submit('DELETE', ['class' => 'btn btn-danger']) !!}
                    @endif
                  @else
                    <small>posted  by {{ $article->user->first_name }}</small><br>
                   <small> @php
                    echo date('l, Y / M / d')
                @endphp</small>
                  @endif
                  </footer>
                </blockquote>
              </div>
            </div>
        @else
        <div class="card">
            <img src="{{ asset('/storage/articles/'.$article->image) }}" style="width: 100%; height:508px;" alt="">
            <div class="card-body">
              <blockquote class="blockquote">
                <h4 style="font-weight: bolder;">{{ $article->title }}</h4>
                <p>{{ $article->body }}</p>
                <footer class="card-blockquote">
                    @if (!Auth::guest())
                    @if ($article->user->id === Auth::user()->id)
                    <a href="/articles/{{ $article->id }}/edit" class="btn btn-secondary"> Edit</a>
                    {!! Form::open(['action' => ['App\Http\Controllers\ArticlesController@destroy',$article->id],
                    'method' => 'POST','enctype' => 'multipart/form-data','class' => 'pull-right']) !!}
                      {!! Form::hidden('_method', 'DELETE') !!}
                      {!! Form::submit('DELETE', ['class' => 'btn btn-danger']) !!}
                      <hr>

                    @endif
                  @else
                    <small>posted  by {{ $article->user->first_name }}</small><br>
                    @php
                    echo date('l, Y / M / d')
                @endphp
                  @endif
                  </footer>
              </blockquote>
            </div>
          </div>
        @endif
    </div>
@endsection
