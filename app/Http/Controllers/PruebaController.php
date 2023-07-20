<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Models\Empleado;
use App\Models\Catalogo;
use App\Models\Empleado;

class PruebaController extends Controller
{
    public function index(Request $request)
    {
        // $datos = DB::select('select * from empleados');
        $datos = Catalogo::get();
        $datos = $this->prepararDatos($datos);
        // $departamentos = DB::select('SELECT * FROM catalogos WHERE grupo = "departamentos";');
        $departamentos = DB::table('catalogos')
            ->where('grupo', '=', 'departamentos')
            ->get();
        // $municipios = DB::select('SELECT * FROM catalogos WHERE grupo = "municipios";');
        $municipios = DB::table('catalogos')
            ->where('grupo', '=', 'municipios')
            ->get();
        $array = [
            "datos" => $datos,
            "departamentos" => $departamentos,
            "municipios" => $municipios
        ];
        return view("welcome")->with("array", $array);
    }

    private function prepararDatos($datos)
    {
        foreach ($datos as $empleado) {
            $municipioNombre = '';
            $departamentoNombre = '';
            // $municipioConsulta = DB::select('SELECT valor FROM catalogos WHERE grupo = "municipios" AND id=' . $empleado->id_municipio . ';');
            $municipioConsulta = DB::table('catalogos')
                ->select('valor')
                ->where('grupo', '=', 'municipios')
                ->where('id', '=', $empleado->id_municipio)
                ->get();
            // $departamentoConsulta = DB::select('SELECT valor FROM catalogos WHERE grupo = "departamentos" AND id=' . $empleado->id_depto . ';');
            $departamentoConsulta = DB::table('catalogos')
                ->select('valor')
                ->where('grupo', '=', 'departamentos')
                ->where('id', '=', $empleado->id_depto)
                ->get();
            foreach ($municipioConsulta as $mun_consulta) {
                $municipioNombre = $mun_consulta->valor;
            }
            foreach ($departamentoConsulta as $dep_consulta) {
                $departamentoNombre = $dep_consulta->valor;
            }
            $empleado->municipio_texto = $municipioNombre;
            $empleado->departamento_texto = $departamentoNombre;
        }
        return $datos;
    }

    public function list($id)
    {
        echo json_encode(DB::table('catalogos')->where('id_padre', $id)->get());
    }

    public function create(Request $request)
    {
        try {
            $sql = DB::insert('INSERT INTO empleados (nombre,apellido,correo,telefono,direccion,id_municipio,id_depto) VALUES (?,?,?,?,?,?,?)', [
                $request->new_empleado,
                $request->new_apellido,
                $request->new_correo,
                $request->new_telefono,
                $request->new_dirrecion,
                $request->new_municipio,
                $request->new_departamento
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }

        $datos = Empleado::get();
        $datos = $this->prepararDatos($datos);

        return [
            "status" => 200,
            "mensage" => "Se guardo con exito",
            "data" => $datos
        ];

        // //Mensaje de Respuesta
        // if ($sql == true) {
        //     return back()->with("Correcto", "Los datos fueron ingresados con exito");
        // } else {
        //     return back()->with("Incorrecto", "Error al ingresar los datos");
        // }
    }

    public function update(Request $request)
    {
        try {
            $sql = DB::update('UPDATE empleados SET nombre=?,apellido=?,correo=?,telefono=?,direccion=?,id_municipio=?,id_depto=? WHERE id = ?', [
                $request->new_empleado,
                $request->new_apellido,
                $request->new_correo,
                $request->new_telefono,
                $request->new_dirrecion,
                $request->new_municipio,
                $request->new_departamento,
                $request->new_id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        $datos = DB::select('select * from empleados');
        $datos = $this->prepararDatos($datos);

        return [
            "status" => 200,
            "message" => "Se guardo con exito",
            "data" => $datos
        ];
    }

    public function delete(Request $request)
    {
        $id_emp = $request->nuevo_id;

        $query = Catalogo::where('id', $id_emp);
        $query->delete();
        // $sql = DB::delete('DELETE FROM empleados WHERE id = ?', [
        //     $request->nuevo_id
        // ]);

        $datos = Empleado::get();
        $datos = $this->prepararDatos($datos);

        return [
            "status" => 200,
            "mensage" => "Se guardo con exito",
            "data" => $datos
        ];
    }

    public function filtro(Request $request)
    {
        // try {
        //     $sql = DB::select('SELECT * FROM empleados WHERE nombre = ?', [
        //         $request->new_empleado,
        //         $request->new_apellido,
        //         $request->new_correo,
        //         $request->new_telefono,
        //         $request->new_dirrecion,
        //         $request->new_municipio,
        //         $request->new_departamento
        //     ]);
        // } catch (\Throwable $th) {
        //     $sql = 0;
        // }
        $filtro_empleado = "";
        if ($request->new_empleado != "") {
            $filtro_empleado = DB::select('SELECT * FROM empleados WHERE nombre = "' . $request->new_empleado . '";');
        }
        if ($request->new_apellido != "") {
            $filtro_empleado = DB::select('SELECT * FROM empleados WHERE apellido = "' . $request->new_apellido . '";');
        }
        if ($request->new_correo != "") {
            $filtro_empleado = DB::select('SELECT * FROM empleados WHERE correo = "' . $request->new_correo . '";');
        }
        if ($request->new_telefono != "") {
            $filtro_empleado = DB::select('SELECT * FROM empleados WHERE telefono = "' . $request->new_telefono . '";');
        }
        if ($request->new_direccion != "") {
            $filtro_empleado = DB::select('SELECT * FROM empleados WHERE direccion = "' . $request->new_direccion . '";');
        }
        if ($request->new_departamento != "") {
            $filtro_empleado = DB::select('SELECT * FROM empleados WHERE id_depto = ' . $request->new_departamento . ';');
        }
        if ($request->new_municipio != "") {
            $filtro_empleado = DB::select('SELECT * FROM empleados WHERE id_municipio = ' . $request->new_municipio . ';');
        }

        $filtro_empleado = $this->prepararDatos($filtro_empleado);

        return [
            "status" => 200,
            "mensage" => "Se guardo con exito",
            "data" => $filtro_empleado
        ];
    }

    public function restart(Request $request)
    {
        $datos = Empleado::get();
        $datos = $this->prepararDatos($datos);

        return [
            "status" => 200,
            "mensage" => "Se guardo con exito",
            "data" => $datos
        ];
    }

    public function deleted_data(Request $request)
    {
        $datos = Empleado::onlyTrashed()->get();
        $datos = $this->prepararDatos($datos);

        return [
            "status" => 200,
            "mensage" => "Se guardo con exito",
            "data" => $datos
        ];
    }

    public function restore_data(Request $request)
    {
        $id_restored = $request->viejo_id;

        $query = Empleado::withTrashed()
        ->where('id',$id_restored)
        ->restore();

        $datos = Empleado::onlyTrashed()->get();
        $datos = $this->prepararDatos($datos);

        return [
            "status" => 200,
            "mensage" => "Se guardo con exito",
            "data" => $datos
        ];
    }

}
