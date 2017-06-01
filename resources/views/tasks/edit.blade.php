@extends('layouts.default')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{!! Form::model($task, array('method'=>'PATCH','route' => array('tasks.update', $task->id))) !!}
  <div class="form-group">
    {{ Form::label('name', 'Nome') }}
    {{  Form::text('name', $task->name, ['class'=>'form-control','maxlength'=>'255', 'required'=>true]) }}
  </div>
  <div class="form-group">
    {{ Form::label('description', 'Descrição') }}
    {{  Form::textarea('description', $task->description, ['class'=>'form-control', 'rows'=>'3', 'maxlength'=>'600', 'required'=>true]) }}
    
  </div>
  <div class="form-group">
    {{ Form::label('initial_date', 'Data de início') }}
    {{  Form::text('initial_date', $task->initial_date->format('d/m/Y'), ['class'=>'form-control','maxlenght'=>'11', 'required'=>true]) }}
  </div>
  <div class="form-group">
  {{ Form::label('status_id', 'Status') }}
    {{ Form::select('status_id', $status , $task->status_id, ['class'=>'form-control', 'id'=>'status_id']) }}  
  </div>
  <div class="form-group">
    {{ Form::label('final_date', 'Data de fim') }}
    {{  Form::text('final_date', $task->final_date ? $task->final_date->format('d/m/Y'):null, ['class'=>'form-control','maxlenght'=>'11']) }}
  </div>
  <div class="form-group">
  {{ Form::label('active', 'Ativo') }}
    {{ Form::hidden('active', 0) }}  
    {{ Form::checkbox('active', 1, $task->active) }}  
  </div>
  {{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}

<script>
  $( document ).ready(function() {
    $( "#initial_date" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#final_date" ).datepicker({ dateFormat: "dd/mm/yy" });


$("select[name=status_id]").change(function() {
    if ($("select[name=status_id] option:selected").text() == "Concluído")
        $("input[name=final_date]").prop("disabled", false);
    else
        $("input[name=final_date]").prop("disabled", true);
    }).change();

  } );
</script>
@stop