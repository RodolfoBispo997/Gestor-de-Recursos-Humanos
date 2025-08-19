<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('user.profile');
    }

    public function updatePassword(Request $request)
    {
        //Validação de formulário
        $request->validate([
            'current_password' => "required|min:8|max:16",
            'new_password' => "required|min:8|max:16|different:current_password",
            'new_password_confirmation' => "required|same:new_password",
        ]);

        $user = auth()->user();
        //Checar a senha atual para ver se bate com a senha do banco
        if(!password_verify($request->current_password, $user->password)){
            return redirect()->back()->with('error', 'Senha atual está incorreta');
        }

        //Atualizar senha 
        $user->password = bcrypt($request->new_password);
        $user->save();
        return redirect()->back()->with('success', 'Senha atualizada com sucesso!');
    }

    public function updateUserData(Request $request)
    {
        //Validação do formulário
        $request->validate([
            "name" => "required|min:3|max:255",
            "email" => "required|email|max:255|unique:users,email," . auth()->id()
        ]);

        //Atualizar a base de dados
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success_change_data', 'Perfil atualizada com sucesso!');
    }
}
