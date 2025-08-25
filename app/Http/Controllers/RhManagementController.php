<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Mail\ConfirmAccountEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RhManagementController extends Controller
{
    public function home()
    {
        if (!Auth::user()->can('rh')) {
            abort(403, 'Você não tem autorização para acessar essa página');
        }

        //Pegar todos os colaboradores que não são admin e nem rh
        $colaborators = User::with('detail', 'department')
                            ->where('role', 'colaborator')
                            ->withTrashed()
                            ->get();
        return view('colaborators.colaborators', compact('colaborators'));
    }

    public function newColaborator()
    {
        if (!Auth::user()->can('rh')) {
            abort(403, 'Você não tem autorização para acessar essa página');
        }

        $departments = Department::where('id', '>', 2)->get();

        if($departments->count() === 0){
            abort(403, 'Não existe nenhum departamento adicionado. Por favor, contate o administrador do sistema');
        }

        return view('colaborators.add-colaborator', compact('departments'));
    }

    public function createColaborator(Request $request)
    {
        Auth::user()->can('rh') ? : abort(403, 'Você não tem autorização para acessar essa página');

        //Validação do formulário
        $request->validate([
            "name" => "required|min:3|max:255",
            "email" => "required|email|max:255|unique:users,email," . auth()->id(),
            "select_department" => "required|exists:departments,id",
            "address" => "required|string|max:255",
            "zip_code" => "required|string|max:10",
            "city" => "required|string|max:50",
            "phone" => "required|string|max:20",
            "salary" => "required|decimal:2",
            "admission_date" => "required|date_format:Y-m-d",
        ]);

        //Checar se o departamento é > 2
        if($request->select_department <= 2){
            return redirect()->route('home');
        }

        //Criar token de confirmação de email
        $token = Str::random(60);


        //Criar novo usuário RH
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->confirmation_token = $token;
        $user->role = 'colaborator';
        $user->department_id = $request->select_department;
        $user->permissions = '["colaborator"]';
        $user->save();

        //Salvar Detalhes do Usuário
        $user->detail()->create([
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'phone' => $request->phone,
            'salary' => $request->salary,
            'admission_date' => $request->admission_date,
        ]);

        //Enviar email
        Mail::to($user->email)->send(new ConfirmAccountEmail(route('confirm-account', $token)));


        return redirect()->route('rh.management.home');
    }


    public function editColaborator($id)
    {
        Auth::user()->can('rh') ? : abort(403, 'Você não tem autorização para acessar essa página');

        $colaborator = User::with('detail')->findOrFail($id);
        $departments = Department::where('id', '>', 2)->get();

        return view('colaborators.edit-colaborator', compact('colaborator', 'departments'));
    }

    public function updateColaborator(Request $request)
    {
        Auth::user()->can('rh') ? : abort(403, 'Você não tem autorização para acessar essa página');

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'salary' => 'required|decimal:2',
            'admission_date' => 'required|date_format:Y-m-d',
            'select_department' => 'required|exists:departments,id'
        ]);

        //Verificar se o departmento é válido
        if($request->select_department <= 2)
        {
            return redirect()->route('home');
        }

        $user = User::with('detail')->findOrFail($request->user_id);
        $user->detail->salary = $request->salary;
        $user->detail->admission_date = $request->admission_date;
        $user->department_id = $request->select_department;

        $user->save();
        $user->detail->save();

        return redirect()->route('rh.management.home');
    }

    public function showDetails($id)
    {
        Auth::user()->can('rh') ? : abort(403, 'Você não tem autorização para acessar essa página');

        $colaborator = User::with('detail', 'department')->findOrFail($id);

        return view('colaborators.show-details', compact('colaborator'));
    }

    public function deleteColaborator($id)
    {
        Auth::user()->can('rh') ? : abort(403, 'Você não tem autorização para acessar essa página');

        $colaborator = User::findOrFail($id);

        return view('colaborators.delete-colaborator', compact('colaborator'));
    }

    public function deleteColaboratorConfirm($id)
    {
        Auth::user()->can('rh') ? : abort(403, 'Você não tem autorização para acessar essa página');

        $colaborator = User::findOrFail($id);

        $colaborator->delete();

        return redirect()->route('rh.management.home');
    }

    public function restoreColaborator($id)
    {
        Auth::user()->can('rh') ? : abort(403, 'Você não tem autorização para acessar essa página');

        $colaborator = User::withTrashed()->findOrFail($id);

        $colaborator->restore();

        return redirect()->route('rh.management.home');
    }
}
