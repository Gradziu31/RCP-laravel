@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informacje o wybranym dniu:</div>

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
<ul>
<li>ID: {{$work->id}}</li>
@if ($work->user)
<li>Komentarz: {{$work->user}}</li>
@endif
<li>Utworzono: {{$work->created_at}}</li>
<li>Zakończono: {{$work->updated_at}}</li>
<li>Użytkownik: {{$work->parent->email}}</li>
</ul>
<span><a href="{{ url()->previous() }}" class="btn btn-success">Wróć</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
