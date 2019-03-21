@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edytujesz dzień o ID: {{$page->id}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Zalogowałeś się poprawnie! -->
                    <!-- <div class="work-status">
    <a href="/coming"><button class="btn btn-success">Check in</button></a>
</div> -->

                    <!-- {!! Form::open(['url' => '/coming', 'method' => 'post']) !!} -->
                    {!! Form::model($page, ['method' => 'PATCH', 'action' => ['WorkController@update', $page->id], 'class'=>'form-horizontal']) !!}
@foreach($errors->all() as $error)
    <li>{{$error}}</li>
@endforeach
    <div class="form-group row">
        <div class="col-12">
        {{ Form::label('created_at', 'Data i godzina rozpoczęcia:', ['class' => 'control-label']) }}
    {!! Form::text('created_at', null, ['class="form-control datapicker" autocomplete="off"']) !!}
        </div>
    </div>



    <div class="form-group row">
        <div class="col-12">
        {{ Form::label('updated_at', 'Data i godzina zakończenia:', ['class' => 'control-label']) }}
    {!! Form::text('updated_at', null, ['class="form-control datapicker" autocomplete="off"']) !!}
        </div>
    </div>

    <div class="form-group row">
        <div class="col-12">
            {{ Form::label('user', 'Komentarz opcjonalnie:', ['class' => 'control-label']) }}
            {!! Form::text('user', $page->user, ['class="form-control"']) !!}
        </div>
    </div>


                        {!! Form::submit('Wyślij',['class="btn btn-success"']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
