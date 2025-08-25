<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index()
    {

        Auth::user()->can('admin') ? : abort(403, 'Você não tem autorização para acessar essa página');

        $departments = Department::all();

        return view('department.departments', compact('departments'));
    }

    public function newDepartment()
    {
        Auth::user()->can('admin') ? : abort(403, 'Você não tem autorização para acessar essa página');

        return view('department.add-department');
    }

    public function createDepartment(Request $request)
    {
        Auth::user()->can('admin') ? : abort(403, 'Você não tem autorização para acessar essa página');
        
        $request->validate([
            'name' => 'required|string|min:3|max:100|unique:departments'
        ]);

        Department::create([
            'name' => $request->name
        ]);

        return redirect()->route('departments');
    }

    public function editDepartment($id)
    {
        Auth::user()->can('admin') ? : abort(403, 'Você não tem autorização para acessar essa página');

        if($this->isDepartmentBlocked($id)){
            return redirect()->route('departments');
        }

        $department = Department::findOrFail($id);

        return view('department.edit-department', ['department' => $department]);
    }

    public function updateDepartment(Request $request)
    {
        Auth::user()->can('admin') ? : abort(403, 'Você não tem autorização para acessar essa página');

        if($this->isDepartmentBlocked($id)){
            return redirect()->route('departments');
        }

        $department = Department::findOrFail($request->id);

        $request->validate([
            'name' => 'required|string|unique:departments,name,' . $request->id
        ]);

        $department->update([
            'name' => $request->name
        ]);

        return redirect()->route('departments')
                     ->with('success_update_department', 'Departamento atualizado com sucesso!');
    }

    public function deleteDepartment($id)
    {
        Auth::user()->can('admin') ? : abort(403, 'Você não tem autorização para acessar essa página');

        if($this->isDepartmentBlocked($id)){
            return redirect()->route('departments');
        }

        $department = Department::findOrFail($id);

        return view('department.delete-department-confirm', compact('department'));

    }

    public function deleteDepartmentConfirm($id)
    {
        Auth::user()->can('admin') ? : abort(403, 'Você não tem autorização para acessar essa página');

        if($this->isDepartmentBlocked($id)){
            return redirect()->route('departments');
        }

        $department = Department::findOrFail($id);

        $department->delete();

        //Atualizar todos os departamento dos colaboradores para NULL
        User::where('department_id', $id)->update(['department_id' => null]);

        return redirect()->route('departments');
    }


    private function isDepartmentBlocked($id)
    {
        return in_array(intval($id), [1,2]);
    }
}
