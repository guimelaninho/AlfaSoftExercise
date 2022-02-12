@extends('layouts.app')

@php
    
@endphp

@section('content')

<div>
    <table class="table table-sm table-hover table-striped table-bordered">
        <colgroup>
            <col>
            <col style="width: 10%;">
        </colgroup>
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Contato</th>
                <th class="text-center">Ação</th>
            </tr>
        </thead>
        <tbody>
            @if ($data['entity']->isEmpty() ?? false)
                <tr>
                    <td colspan="4" class="text-center">
                        <b>
                            {!! 'Sem Registros!' !!}
                        </b>
                    </td>
                </tr>
            @else
                @foreach($data['entity'] as $item)
                    @php

                        $item = $item ?? null;

                        $showRoute    = route($data['route'].'.show',$item->id);
                        $editRoute    = route($data['route'].'.edit',$item->id);
                        $destroyRoute = route($data['route'].'.destroy',$item->id);

                    @endphp

                    <tr>
                        <td>
                            {!! $item->name !!}
                        </td>
                        <td>
                            {!! $item->email !!}
                        </td>
                        <td>
                            {!! $item->contact !!}
                        </td>
                        <td class="text-center align-middle">
                            <div class="btn-group btn-group-sm" role="group">

                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => $destroyRoute,
                                        'accept-charset' => 'UTF-8',
                  
                                    ]) !!}
                                        <a class="btn  btn-sm" href="{!! $showRoute !!}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        @if ((Auth::check()))
                                                
                                            <a class="btn  btn-sm" href="{!! $editRoute !!}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>

                                            <button type="submit" class="btn  btn-sm" href="#">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        @endif

                                    
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
