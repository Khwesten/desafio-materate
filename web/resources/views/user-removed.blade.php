@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Usuários removidos</div>

                    <div class="panel-body">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td>Nome</td>
                                <td>Email</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="col-md-6">{{ $user->name }}</td>
                                    <td class="col-md-6">{{ $user->email }}</td>
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
