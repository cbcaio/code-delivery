@extends('app')

@section('content')

    <div class="container">
        <h3>Editando Cliente: {{ $client->user->name }}</h3>

        @include('errors._check')

        {!! Form::model($client,['route' => ['admin.clients.update', $client->id] ]) !!}

        @include('admin.clients._form')

        <div class="form-group">
            {!! Form::submit('Salvar Usuário',['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>
@stop