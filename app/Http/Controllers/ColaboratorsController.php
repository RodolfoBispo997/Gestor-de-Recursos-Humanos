<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColaboratorsController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ? : abort(403, 'Você não tem autorização para acessar essa página');

        $colaborators = User::withTrashed()
                                ->with('detail', 'department')
                                ->where('role', '<>', 'admin')
                                ->get();

        return view('colaborators.admin-all-colaborators', compact('colaborators'));
    }

    public function showDetails($id)
    {
        Auth::user()->can('admin', 'rh') ? : abort(403, 'Você não tem autorização para acessar essa página');

        if(Auth::user()->id === $id)
        {
            return redirect()->route('home');
        }

        $colaborator = User::with('detail', 'department')
                                ->where('id', $id)
                                ->first();

        // Verificar se o colaborador está ativo
        if(!$colaborator){
            abort(403);
        }

        return view('colaborators.show-details', compact('colaborator'));
    }

    public function deleteColaborator($id)
    {
        Auth::user()->can('admin', 'rh') ? : abort(403, 'Você não tem autorização para acessar essa página');

        if(Auth::user()->id === $id)
        {
            return redirect()->route('home');
        }

        $colaborator = User::findOrFail($id);

        return view('colaborators.delete-colaborator-confirm', compact('colaborator'));
    }

    public function deleteColaboratorConfirm($id)
    {
        Auth::user()->can('admin', 'rh') ? : abort(403, 'Você não tem autorização para acessar essa página');

        if(Auth::user()->id === $id)
        {
            return redirect()->route('home');
        }

        $colaborator = User::findOrFail($id);
        $colaborator->delete();

        return redirect()->route('colaborators.all-colaborators');
    }

    public function restoreColaborator($id)
    {
        Auth::user()->can('admin', 'rh') ? : abort(403, 'Você não tem autorização para acessar essa página');

        $colaborator = User::withTrashed()->findOrFail($id);

        $colaborator->restore();

        return redirect()->route('colaborators.all-colaborators');
    }

    public function home()
    {
        Auth::user()->can('colaborator') ? : abort(403, 'Você não tem autorização para acessar essa página');

        $colaborator = User::with('detail', 'department')
                                ->where('id', Auth::user()->id)
                                ->first();

        return view('colaborators.show-details', compact('colaborator'));
    }
}
