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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   @include('layouts.nav')
                </div>

                <div class="card-body">
                    @if (count($articles) > 0)
                    <div class="card-header text-primary">
                        <h4 style="text-align: center;">Your created Articles</h4>
                    </div><br>
                    @foreach ($articles as $article)
                        <div class="form-group">
                            <a href="/articles/{{ $article->id }}" class="form-control" style="font-size: large;">{{ $article->title }}
                            <i class="fa fa-user text-primary pull-right" aria-hidden="true"> {{ $article->user->last_name }}</i> </a>
                        </div>
                    @endforeach
                @else
                        <p>You have not created any article create <a href="/articles/create">one </a> to get started</p>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
