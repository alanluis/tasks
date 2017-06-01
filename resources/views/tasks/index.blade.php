@extends('layouts.default')

@section('content')
@if (count($tasks))
<table class="table table-condensed">
    <thead>
        <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>Descrição</td>
            <td>Status</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)
        <tr {!! $task->status->status=='Concluído' ? "class=\"bg-success\"" : ''!!}>
            <td>{{ $task->id }}</td>
            <td>{{ $task->name }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->status->status }}</td>
            <td>
                <a class="btn btn-small btn-info" href="{{ route('tasks.edit', $task->id) }}">Editar</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endif

<a class="btn btn-small btn-primary" href="{{ route('tasks.create') }}">Adicionar nova atividade</a>
@stop