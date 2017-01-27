@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Usuários</div>

                    <div class="panel-body">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td>Nome</td>
                                <td>Email</td>
                                <td class="text-center">Excluir</td>
                                <td class="text-center">Editar</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="col-md-3">{{ $user->name }}</td>
                                    <td class="col-md-5">{{ $user->email }}</td>
                                    <td class="col-md-2 text-center">
                                        <button type="button" userid="{{$user->id}}" class="btn btn-danger remove-user">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                    <td class="col-md-2 text-center">
                                        <a href="/user/edit/{{ $user->id }}" class="btn btn-primary">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
