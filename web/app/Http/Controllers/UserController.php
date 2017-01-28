<?php

namespace App\Http\Controllers;

use App\SessionLog;
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

    public function login(Request $request)
    {
        $email = $request->input("email");
        $password = $request->input("password");

        $user = User::where('email', $email)->first();

        $passwordIsEqual = ($user) ? Hash::check($password, $user->password) : false;

        if ($passwordIsEqual) {
            $userToEncode = ['id'=> $user->id, 'name' => $user->name, 'email' => $user->email];

            if (!$user->last_session) {
                $session = new SessionLog();
                $session->login_date = date("Y-m-d H:i:s");
                $session->user_id = $user->id;
                $session->save();

                $user->last_session = $session->id;
                $user->save();
            }

            return response($userToEncode, 200);
        } else {
            return response("Usuário não encontrado!", 404);
        }
    }

    public function logout(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        $sessionLog = SessionLog::where('id', $user->last_session)->first();

        if($sessionLog) {
            $sessionLog->logout_date = date("Y-m-d H:i:s");
            $sessionLog->save();
        }

        $user->last_session = null;
        $user->save();

        return;
    }

    public function sessions(Request $request, $id)
    {
        $sessionLog = SessionLog::where('user_id', $id)->get();

        return $sessionLog->toArray();
    }

    public function register(Request $request) {
        $password = $request->password;
        $name = $request->name;
        $email = $request->email;

        $user = User::where('email', $email)->first();

        if ($user) return response("Já existe um usuário com esse email, por favor tente outro!", 302);

        $error = $this->checkDataRoRegister($request);

        if ($error) return $error;

        $user = new User();

        $user->name = $name;
        $user->password = bcrypt($password);
        $user->email = $email;

        $user->save();

        return response("Usuário cadastrado com sucesso!", 200);
    }

    public function edit(Request $request, $id) {
        $password = $request->password;
        $name = $request->name;
        $email = $request->email;

        $user = User::where('id', $id)->first();

        $error = $this->checkDataRoRegister($request);

        if ($error) return $error;

        if ($user->email != $email) {
            $userWithNewEmail = User::where('email', $email)->first();
            if ($userWithNewEmail) return response("Já existe um usuário com esse email, por favor tente outro!", 302);
        }

        if ($request->password) $user->password = bcrypt($password);

        $user->name = $name;
        $user->email = $email;

        $user->save();

        return response("Usuário alterado com sucesso!", 200);
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

        $userToEdit = User::where('id', $id)->first();

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
        $user = User::where('id', $id)->first();

        if ($user) {
            $user->removed = true;
            $user->save();
        }

        return;
    }

    private function checkDataRoRegister($request) {
        if (!$request->name || !$request->email) {
            return response("Todos os campos são obrigatórios!", 400);
        }

        return false;
    }
}