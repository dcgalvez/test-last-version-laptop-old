<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get("/", [PruebaController::class, "index"])->name("prueba.index");

//Ruta para dropdown list
Route::get("/dropdown_list/{id}", [PruebaController::class, "list"])->name("prueba.list");

//Ruta para registro nuevo
Route::post("/registrar_empleado", [PruebaController::class, "create"])->name("prueba.create");

//Ruta para modificar registro
Route::post("/modificar_empleado", [PruebaController::class, "update"])->name("prueba.update");

//Ruta para eliminar registro
Route::post("/eliminar_empleado", [PruebaController::class, "delete"])->name("prueba.delete");

//Ruta para filtrar registro
Route::post("/buscar_empleado", [PruebaController::class, "filtro"])->name("prueba.filtro");

//Ruta para restart
Route::post("/resetear_empleados", [PruebaController::class, "restart"])->name("prueba.restart");

//Ruta para ver datos borrados
Route::post("/datos_eliminados", [PruebaController::class, "deleted_data"])->name("prueba.deleted_data");

//Ruta para restaurar datos borrados
Route::post("/restaurar", [PruebaController::class, "restore_data"])->name("prueba.restore_data");

