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

{!! Form::open(['route' => 'tasks.store']) !!}
  <div class="form-group">
    {{ Form::label('name', 'Nome') }}
    {{  Form::text('name', null, ['class'=>'form-control','maxlength'=>'255', 'required'=>true]) }}
  </div>
  <div class="form-group">
    {{ Form::label('description', 'Descrição') }}
    {{  Form::textarea('description', null, ['class'=>'form-control', 'rows'=>'3', 'maxlength'=>'600', 'required'=>true]) }}
    
  </div>
  <div class="form-group">
    {{ Form::label('initial_date', 'Data de início') }}
    {{  Form::text('initial_date', null, ['class'=>'form-control','maxlenght'=>'11', 'required'=>true]) }}
  </div>
  <div class="form-group">
  {{ Form::label('status_id', 'Status') }}
    {{ Form::select('status_id', $status , null, ['class'=>'form-control', 'id'=>'status_id']) }}  
  </div>
  <div class="form-group">
    {{ Form::label('final_date', 'Data de fim') }}
    {{  Form::text('final_date', null, ['class'=>'form-control','maxlenght'=>'11','disabled'=>'true']) }}
  </div>
  <div class="form-group">
  {{ Form::label('active', 'Ativo') }}
    {{ Form::hidden('active', 0) }}  
    {{ Form::checkbox('active', 1, true) }}  
  </div>
  {{ Form::submit('Adicionar', array('class' => 'btn btn-primary')) }}
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