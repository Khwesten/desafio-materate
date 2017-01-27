<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Created by IntelliJ IDEA.
 * User: k-heiner@hotmail.com
 * Date: 26/01/2017
 * Time: 19:39
 */
class UserController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function login(Request $request)
    {
        $email = $request->input("email");
        $password = $request->input("password");

        $user = User::where('email', $email)->first();

        $userExist = Hash::check($password, $user->password);

        if ($userExist) {
            return response("Usuário logado com sucesso", 200);
        } else {
            return response("Usuário não encontrado!", 404);
        }
    }

    public function editView(Request $request, $id)
    {
        $userToEdit = User::where('id', $id)->first();

        return view('user-edit', ['user' => $userToEdit]);

    }

    public function editDetails(Request $request, $id)
    {
        $requestEmail = $request->email;
        $requestPassword = $request->password;
        $requestName = $request->name;

        $userToEdit = User::find($id);

        if ($requestEmail && $userToEdit->email != $requestEmail) {
            $hasUserWithNewEmail = $userToEdit = User::where('email', $requestEmail)->first();

            if (!$hasUserWithNewEmail) {
                $userToEdit->email = $requestEmail;
            } else {
                return view('user-edit',
                    [
                        'user' => $userToEdit,
                        'errorMail' => "Já existe um usuário com esse email, por favor, escolha outro!"
                    ]
                );
            }
        }

        $userToEdit->name = ($requestName && $requestName != $userToEdit->name) ? $requestName : $userToEdit->name;
        $userToEdit->password = ($requestPassword) ? $requestPassword : $userToEdit->password;

        $userToEdit->save();

        return view('user-edit', ['user' => $userToEdit]);
    }

    public function removedView()
    {
        $users = User::where('removed', true)->get();

        return view('user-removed',['users' => $users]);
    }

    public function removeUser(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->removed = true;
            $user->save();
        }

        return;
    }
}