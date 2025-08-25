<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColaboratorsController;
use App\Http\Controllers\ConfirmAccountController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RhManagementController;
use App\Http\Controllers\RhUserController;
use App\Mail\ConfirmAccountEmail;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    //Rota para confirmação de email
    Route::get('/confir-account/{token}', [ConfirmAccountController::class, 'confirmAccount'])->name('confirm-account');

    Route::post('/confir-account', [ConfirmAccountController::class, 'confirmAccountSubmit'])->name('confirm-account-submit');
});

Route::middleware('auth')->group(function () {
    //Redirect
    Route::redirect('/', 'home');
    Route::get('/home', function(){
        //Verificar se o usuário é um admin
        if(auth()->user()->role === 'admin'){
            return redirect()->route('admin.home');
        }elseif(auth()->user()->role === 'rh'){
            return redirect()->route('rh.management.home');
        }else{
            return redirect()->route('colaborator');
        }
    })->name('home');

    //USER Profile page
    Route::get('/user/profile', [ProfileController::class, 'index'])->name('user.profile');
    //USER change password
    Route::post('/user/profile/update-password', [ProfileController::class, 'updatePassword'])->name('user.profile.update-password');
    //USER Change Perfil Usuário
    Route::post('/user/profile/update-user-data', [ProfileController::class, 'updateUserData'])->name('user.profile.update-user-data');
    Route::post('/user/profile/update-user-address', [ProfileController::class, 'updateUserAddress'])->name('user.profile.update-user-address');

    //Rota do DEPARTAMENTO
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    //New DEPARTAMENTO
    Route::get('/departments/new-department', [DepartmentController::class, 'newDepartment'])->name('departments.new-department');
    //Store(create) DEPARTAMENTO
    Route::post('/departments/create-department', [DepartmentController::class, 'createDepartment'])->name('departments.create-department');
    //Edit DEPARTAMENTO
    Route::get('/departments/edit-department/{id}', [DepartmentController::class, 'editDepartment'])->name('departments.edit-department');
    //Update DEPARTAMENTO
    Route::post('/departments/update-department', [DepartmentController::class, 'updateDepartment'])->name('departments.update-department');
    //Delete DEPARTAMENTO
    Route::get('/departments/delete-department/{id}', [DepartmentController::class, 'deleteDepartment'])->name('departments.delete-department');
    //Delete DEPARTAMENTO Confirm
    Route::get('/departments/delete-department-confirm/{id}', [DepartmentController::class, 'deleteDepartmentConfirm'])->name('departments.delete-department-confirm');


    //Rota dos colaboradores do RH
    Route::get('/rh-users', [RhUserController::class, 'index'])->name('colaborators.rh-users');
    //Novo Colaborador do RH
    Route::get('/rh-users/new-colaborators', [RhUserController::class, 'newColaborator'])->name('colaborators.rh.new-colaborators');
    //Criar Colaborador do RH
    Route::post('/rh-users/create-colaborators', [RhUserController::class, 'createRhColaborator'])->name('colaborators.rh.create-colaborators');
    //Edit Colaborador do RH
    Route::get('/rh-users/edit-colaborators/{id}', [RhUserController::class, 'editRhColaborator'])->name('colaborators.rh.edit-colaborators');
    //Update Colaborador do RH
    Route::post('/rh-users/update-colaborators', [RhUserController::class, 'updateRhColaborator'])->name('colaborators.rh.update-colaborators');
    //Delete Colaborador do RH
    Route::get('/rh-users/delete/{id}', [RhUserController::class, 'deleteRhColaborator'])->name('colaborators.rh.delete-colaborators');
    //Delete Confirm  do RH
    Route::get('/rh-users/delete-confirm/{id}', [RhUserController::class, 'deleteRhColaboratorConfirm'])->name('colaborators.rh.delete-confirm');
    //Restore do RH
    Route::get('/rh-users/restore/{id}',[RhUserController::class, 'restoreRhColaborator'])->name('colaborators.rh.restore');
    


    //Home do RH
    Route::get('/rh-users/management/home', [RhManagementController::class, 'home'])->name('rh.management.home');
    Route::get('/rh-users/management/new_colaborator', [RhManagementController::class, 'newColaborator'])->name('rh.management.new-colaborator');
    Route::post('/rh-users/management/create-colaborator', [RhManagementController::class, 'createColaborator'])->name('rh.management.create-colaborator');
    Route::get('/rh-user/management/edit-colaborator/{id}', [RhManagementController::class, 'editColaborator'])->name('rh.management.edit-colaborator');
    Route::post('/rh-user/management/update-colaborator', [RhManagementController::class, 'updateColaborator'])->name('rh.management.update-colaborator');
    Route::get('/rh-user/management/details-colaborator/{id}', [RhManagementController::class, 'showDetails'])->name('rh.management.details');

    //MANAGEMENT
    Route::get('/rh-user/management/delete/{id}', [RhManagementController::class, 'deleteColaborator'])->name('rh.management.delete');
    Route::get('/rh-user/management/delete-confirm/{id}', [RhManagementController::class, 'deleteColaboratorConfirm'])->name('rh.management.delete-confirm');
    Route::get('/rh-user/management/restore/{id}', [RhManagementController::class, 'restoreColaborator'])->name('rh.management.restore');


    //Lista de colaboradores ADMIN
    Route::get('/colaborators', [ColaboratorsController::class, 'index'])->name('colaborators.all-colaborators');
    //Detalhes dos colaboradores
    Route::get('/colaborators/details/{id}', [ColaboratorsController::class, 'showDetails'])->name('colaborators.details');
    //Delete colaborator
    Route::get('/colaborators/delete/{id}', [ColaboratorsController::class, 'deleteColaborator'])->name('colaborators.delete');
    Route::get('/colaborators/delete-confirm/{id}', [ColaboratorsController::class, 'deleteColaboratorConfirm'])->name('colaborators.delete-confirm');
    Route::get('/colaborators/restore/{id}',[ColaboratorsController::class, 'restoreColaborator'])->name('colaborators.restore');



    //Admin Routes
    Route::get('/admin/home', [AdminController::class, 'home'])->name('admin.home');

    //Colaborator Routes
    Route::get('/colaborator', [ColaboratorsController::class, 'home'])->name('colaborator');

});
