@extends('layouts.app')
@php
    $data = $data ?? null;
    $indexRoute = route($data['route'].'.index');
    //dd($data);
    if ($data['action'] == 'store')
        $storeRoute = route($data['route'].'.store');
    else
        $updateRoute = route($data['route'].'.update', $data['entity']->id);

    $disabled = ($data['action'] == 'show') ? "disabled" : null;

@endphp
a
@section('content')
  {{-- Tag <form> --}}
    @if($data['action'] == 'store')
        {!! Form::open([
            'name' => 'autor',
            'files' => true,
            'url' => $storeRoute,
            'method' => 'POST',
        ]) !!}
    @else
        {!! Form::model($data['entity'], [
            'name' => 'autor',
            'method' => 'put',
            'files' => true,
            'url' => $updateRoute,
        ]) !!}
    @endif
        <div>
            <div class="form-row">
                {{ Form::hidden('id') }}
                <div class="col">
                    <div>
                        <div class="mt-2">
                            <label>
                                Nome:
                                <span class="text-danger">*</span>
                            </label>
    
                            {{ Form::text('name', null, [
                                'class' => 'form-control form-control-sm',
                                'maxlength' => 100,
                                $disabled,
                            ]) }}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div>
                        <div class="mt-2">
                            <label>
                                E-mail:
                                <span class="text-danger">*</span>
                            </label>
    
                            {{ Form::text('email', null, [
                                'class' => 'form-control form-control-sm',
                                'maxlength' => 100,
                                $disabled,
                            ]) }}

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <div class="mt-2">
                            <label>
                                Contato:
                                <span class="text-danger">*</span>
                            </label>
    
                            {{ Form::text('contact', null, [
                                'class' => 'form-control form-control-sm',
                                'maxlength' => 9,
                                $disabled,
                            ]) }}
                            @if ($errors->has('contact'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('contact') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="form-row">
                <div class="col">
                    <div>
                        <div class="mt-3">
                            @if($data['action'] !== 'show')
                                <button type="submit" class="btn  btn-sm">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    Salvar
                                </button>
                                <a href="{!! $indexRoute !!}" class="btn  btn-sm">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    Cancelar
                                </a>
                            @else 
                                <a href="{!! $indexRoute !!}" class="btn  btn-sm">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                    Voltar
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    
        {!! Form::close() !!}
    </div>
@endsection