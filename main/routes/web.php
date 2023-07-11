<?php

use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileManagementController;
use App\Http\Controllers\FileOportunidadesManagementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\HighchartController;
use App\Http\Controllers\MatrizSeguimientoController;
use App\Http\Controllers\PreFormularioController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UtilityController;
use App\Models\MatrizSeguimiento;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\String\Inflector\EnglishInflector;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {


    // $singular = "User";
    // $inflector = new EnglishInflector();
    // $plural = $inflector->pluralize($singular);
    // return $plural;
    // $role = Role::create(['name' => 'writer']);
    // $permission = Permission::create(['name' => 'crud']);
    // $user = User::find(1);
    // $user->assignRole('administrador');
    // $user->givePermissionTo('crud');

    return redirect(route('inicio'));
})->name('home');
Auth::routes(['register' => false]);


Route::middleware(['auth'])->group(function () {
    Route::get('/util/usuarios', [UsuarioController::class, 'lista_usuarios'])->name('util.lista_usuarios');
    Route::get('/util/candidatos', [CandidatoController::class, 'lista_candidatos'])->name('util.lista_candidatos');

    Route::get('/inicio', [HomeController::class, 'index'])->name('inicio');

    Route::get('/pre-formularios', [PreFormularioController::class, 'index'])->name('pre-formularios');
    Route::get('/pre-formularios/getall', [PreFormularioController::class, 'getAll'])->name('pre-formularios.tabla');
    Route::get('/pre-formularios/{id}/show', [PreFormularioController::class, 'show'])->name('pre-formularios.show');
    Route::get('/pre-formularios/{id}/edit', [PreFormularioController::class, 'edit'])->name('pre-formularios.edit');
    Route::put('/pre-formularios/{id}/update', [PreFormularioController::class, 'update'])->name('pre-formularios.update');
    Route::put('/pre-formularios/{id}/aprobar', [PreFormularioController::class, 'approvedInfo'])->name('pre-formularios.aprobar');
    Route::get('/pre-formularios/{id}/delete', [PreFormularioController::class, 'destroy'])->name('pre-formularios.destroy');


    Route::get('/formularios', [FormularioController::class, 'index'])->name('formularios');
    Route::get('/formularios/tabla', [FormularioController::class, 'tabla'])->name('formularios.tabla');
    Route::get('/formularios/crear', [FormularioController::class, 'crear'])->name('formularios.crear');
    Route::post('/formularios/crear', [FormularioController::class, 'crear_guardar'])->name('formularios.crear.guardar');
    Route::get('/formularios/{id}/ver', [FormularioController::class, 'ver'])->name('formularios.ver');
    Route::get('/formularios/{id}/actualizar', [FormularioController::class, 'actualizar'])->name('formularios.actualizar');
    Route::post('/formularios/{id}/actualizar', [FormularioController::class, 'actualizar_guardar'])->name('formularios.actualizar.guardar');
    Route::get('/formularios/{id}/eliminar', [FormularioController::class, 'eliminar'])->name('formularios.eliminar');
    Route::get('/formularios/{id}/eliminar/conf', [FormularioController::class, 'eliminar_confirmar'])->name('formularios.eliminar.confirmar');

    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios');
    Route::get('/usuarios/tabla', [UsuarioController::class, 'tabla'])->name('usuarios.tabla');
    Route::get('/usuarios/crear', [UsuarioController::class, 'crear'])->name('usuarios.crear');
    Route::post('/usuarios/crear', [UsuarioController::class, 'crear_guardar'])->name('usuarios.crear.guardar');
    Route::get('/usuarios/{id}/ver', [UsuarioController::class, 'ver'])->name('usuarios.ver');
    Route::get('/usuarios/{id}/actualizar', [UsuarioController::class, 'actualizar'])->name('usuarios.actualizar');
    Route::post('/usuarios/{id}/actualizar', [UsuarioController::class, 'actualizar_guardar'])->name('usuarios.actualizar.guardar');
    Route::get('/usuarios/{id}/eliminar', [UsuarioController::class, 'eliminar'])->name('usuarios.eliminar');
    Route::get('/usuarios/{id}/eliminar/conf', [UsuarioController::class, 'eliminar_confirmar'])->name('usuarios.eliminar.confirmar');

    Route::get('/candidatos', [CandidatoController::class, 'index'])->name('candidatos');
    Route::get('/candidatos/tabla', [CandidatoController::class, 'tabla'])->name('candidatos.tabla');
    Route::get('/candidatos/crear', [CandidatoController::class, 'crear'])->name('candidatos.crear');
    Route::post('/candidatos/crear', [CandidatoController::class, 'crear_guardar'])->name('candidatos.crear.guardar');
    Route::get('/candidatos/{id}/ver', [CandidatoController::class, 'ver'])->name('candidatos.ver');
    Route::get('/candidatos/{id}/actualizar', [CandidatoController::class, 'actualizar'])->name('candidatos.actualizar');
    Route::post('/candidatos/{id}/actualizar', [CandidatoController::class, 'actualizar_guardar'])->name('candidatos.actualizar.guardar');
    Route::get('/candidatos/{id}/eliminar', [CandidatoController::class, 'eliminar'])->name('candidatos.eliminar');
    Route::get('/candidatos/{id}/eliminar/conf', [CandidatoController::class, 'eliminar_confirmar'])->name('candidatos.eliminar.confirmar');

    Route::get('/cargos', [CargoController::class, 'index'])->name('cargos');
    Route::get('/cargos/tabla', [CargoController::class, 'tabla'])->name('cargos.tabla');
    Route::get('/cargos/crear', [CargoController::class, 'crear'])->name('cargos.crear');
    Route::post('/cargos/crear', [CargoController::class, 'crear_guardar'])->name('cargos.crear.guardar');
    Route::get('/cargos/{id}/ver', [CargoController::class, 'ver'])->name('cargos.ver');
    Route::get('/cargos/{id}/actualizar', [CargoController::class, 'actualizar'])->name('cargos.actualizar');
    Route::post('/cargos/{id}/actualizar', [CargoController::class, 'actualizar_guardar'])->name('cargos.actualizar.guardar');
    Route::get('/cargos/{id}/eliminar', [CargoController::class, 'eliminar'])->name('cargos.eliminar');
    Route::get('/cargos/{id}/eliminar/conf', [CargoController::class, 'eliminar_confirmar'])->name('cargos.eliminar.confirmar');


    Route::get('/export/formularios', [FileManagementController::class, 'exportFormulario'])->name('export.forms');
    Route::get('/import/viewss', [FileManagementController::class, 'importFormularioView'])->name('import.view');
    Route::post('/import/form', [FileManagementController::class, 'importFormulario'])->name('import.form');

    // utils
    Route::get('get_veredas_and_comunas', [UtilityController::class, 'getVeredasAndComunas']);
    Route::get('/statitics/{candidato_id?}', [HighchartController::class, 'handleChart']);
    Route::get('/statitics/{candidato_id?}/{zona?}/{zona_id?}', [HighchartController::class, 'handleChart']);

    //matriz seguimiento
    Route::get('/matrizSeguimiento',[MatrizSeguimientoController::class,'index'])->name('matriz');
    Route::get('/matrizSeguimiento/create',[MatrizSeguimientoController::class,'create'])->name('matriz.create');
    Route::get('/matrizSeguimiento/userForm',[MatrizSeguimientoController::class,'getUserForm']);
    Route::get('/matrizSeguimiento/statisticsIndex',[MatrizSeguimientoController::class,'statisticsIndex'])->name('statistics');
    Route::get('/matrizSeguimiento/statistics',[MatrizSeguimientoController::class,'getStatistics']);
    Route::get('/matrizSeguimiento/tabla', [MatrizSeguimientoController::class, 'tabla'])->name('matriz.tabla');
    Route::post('/matrizSeguimiento',[MatrizSeguimientoController::class,'store'])->name('matriz_create');
    Route::get('/matrizSeguimiento/delete/{id}',[MatrizSeguimientoController::class,'delete'])->name('matriz.delete');
    Route::get('/matrizSeguimiento/edit/{id}',[MatrizSeguimientoController::class,'edit'])->name('matriz.edit');
    Route::get('/matrizSeguimiento/view/{id}',[MatrizSeguimientoController::class,'view'])->name('matriz.view');
    Route::put('/matrizSeguimiento/update/{id}',[MatrizSeguimientoController::class,'update'])->name('matriz.update');
    //exportar matriz
    Route::get('/export/matrizSeguimiento', [FileManagementController::class, 'exportMatrizSeguimiento'])->name('export.matriz');

    /*  */
    Route::get('/oportunidades/{id}/edit', [ProblemController::class, 'edit'])->name('problems.edit');
    Route::get('/oportunidades/{id}/delete', [ProblemController::class, 'destroy'])->name('problems.destroy');
    Route::put('/oportunidades/{id}/update', [ProblemController::class, 'update'])->name('problems.update');
    Route::put('/oportunidades/{id}/status', [ProblemController::class, 'changeStatus'])->name('problems.changeStatus');
    Route::get('/oportunidades/export', [FileOportunidadesManagementController::class, 'export'])->name('problems.export');
});
Route::get('/oportunidades', [ProblemController::class, 'index'])->name('problems.index');
Route::get('/oportunidades/getall', [ProblemController::class, 'getAll'])->name('problems.getAll');
Route::get('/oportunidades/create', [ProblemController::class, 'create'])->name('problems.create');
Route::post('/oportunidades/create', [ProblemController::class, 'store'])->name('problems.store');
Route::get('/oportunidades/{id}/show', [ProblemController::class, 'show'])->name('problems.show');
