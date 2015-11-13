@extends('app')

@section('content')

    <div class="container">
        <h3>Cupoms</h3>
        <br>
        <a href="{{ route('admin.cupoms.create') }}" class="btn btn-default">
            Novo Cupom
        </a>
        <br><br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Valor</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cupoms as $cupom)
            <tr>
                <td>{{ $cupom->id }}</td>
                <td>{{ $cupom->code }}</td>
                <td>{{ $cupom->value }}</td>
                <td>
                    <a href="{{ route('admin.cupoms.edit',['id' => $cupom->id]) }}" class="btn btn-default btn-sm">
                        Editar
                    </a>
                    <a href="{{ route('admin.cupoms.destroy',['id' => $cupom->id]) }}" class="btn btn-danger btn-sm">
                        Remover
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {!! $cupoms->render() !!}
    </div>


@stop