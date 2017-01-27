@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar usuário</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/edit/'. $user->id)}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}"
                                       required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}"
                                       required autofocus>

                                @if (isset($errorMail))
                                    <span class="help-block">
                                        <strong><small>{{ $errorMail }}</small></strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">
                                Senha
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                                <small>Se você não digitar uma senha, a anterior se manterá.</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 pull-right">
                                <a href="/home" class="btn btn-default">
                                    cancelar
                                </a>
                                <a href="/user/remove/{{$user->id}}" class="btn btn-danger">
                                    Remover
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
