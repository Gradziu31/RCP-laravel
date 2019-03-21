@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dodaj godziny ręcznie</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! Form::open(['url' => '/coming', 'method' => 'post']) !!}
@foreach($errors->all() as $error)
    <li>{{$error}}</li>
@endforeach
    <div class="form-group row">
        <div class="col-12">
        {{ Form::label('created_at', 'Data i godzina rozpoczęcia:', ['class' => 'control-label']) }}
            {!! Form::text('created_at', null, ['class="form-control datapicker" autocomplete="off" required']) !!}
            </div>
    </div>

            <div class="form-group row">
        <div class="col-12">
        {{ Form::label('created_at', 'Data i godzina zakończenia:', ['class' => 'control-label']) }}
            {!! Form::text('updated_at', null, ['class="form-control datapicker" autocomplete="off" required']) !!}
            </div>
    </div>

            <div class="form-group row">
        <div class="col-12">
                    {{ Form::label('user', 'Komentarz opcjonalnie:', ['class' => 'control-label']) }}
            {!! Form::text('user', null, ['class="form-control"']) !!}
        </div>
    </div>

<!-- ID usera -->
{!! Form::text('user_id', Auth::user()->id, ['type="hidden"']) !!}

                        {!! Form::submit('Wyślij',['class="btn btn-success"']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
