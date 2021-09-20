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
    {{-- @include('layouts.nav') --}}
    <div class="container">
       <div class="card-header text-primary">
           <h4 style="text-align: center;">Create Blog Article</h4>
       </div>
       {!! Form::open(['action' => 'App\Http\Controllers\ArticlesController@store','method' => 'POST','enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {!! Form::label('title', 'Article Title') !!}
                {!! Form::text('title', '', ['class' => 'form-control']) !!}
                @error('title')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('body', 'Article Content') !!}
                {!! Form::textarea('body', '', ['class' => 'form-control']) !!}
                @error('body')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::file('image') !!}
            </div>
            <div class="form-group">
               {!! Form::submit('Submit', ['class' => 'btn btn-secondary']) !!}
            </div>
       {!! Form::close() !!}
    </div>
@endsection
