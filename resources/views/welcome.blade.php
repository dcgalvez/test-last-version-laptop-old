<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="stylesheet" href="/css/aver.css">
    <title>prueba-david_cordova</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="sweetalert2.min.js"></script>

    <script>
        let municipios = JSON.parse('{!! json_encode($array["municipios"]) !!}');
        let empleados = JSON.parse('{!! json_encode($array["datos"]) !!}');
    </script>

    <script src="/js/main-script.js"></script>

    <h1 class="text-center p-3">Laravel Prueba</h1>
    @if (session("Correcto"))
    <div class="alert alert-success">{{session("Correcto")}}</div>
    @endif

    @if (session("Incorrecto"))
    <div class="alert alert-danger">{{session("Incorrecto")}}</div>
    @endif


    <div class="p-3">

        <div class="row">
            <div class="mb-3 col-3">
                <label for="nombre_emp" class="form-label">Nombres</label>
                <input type="input" class="form-control" id="nombre_filtro" aria-describedby="nombreempleado" name="new_empleado" required>
            </div>
            <div class="mb-3 col-3">
                <label for="apellido_emp" class="form-label">Apellidos</label>
                <input type="input" class="form-control" id="apellido_filtro" aria-describedby="nombreempleado" name="new_apellido" required>
            </div>



            <div class="mb-3 col-3">
                <label for="correo_emp" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo_filtro" aria-describedby="nombreempleado" name="new_correo" required>
            </div>
            <div class="mb-3 col-3">
                <label for="telefono_emp" class="form-label">Telefono</label>
                <input type="input" class="form-control" maxlength="8" id="telefono_filtro" aria-describedby="nombreempleado" name="new_telefono" required>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-4">
                <label for="direccion_emp" class="form-label">Dirreccion</label>
                <input type="text" class="form-control" id="direccion_filtro" aria-describedby="nombreempleado" name="new_dirrecion" required>
            </div>

            <div class="mb-3 col-4">

                <label for="#n_depto" class="form-label">Departamento</label>
                <select class="form-select mb-3" name="new_departamento" id="nuevo_departamento3" placeholder="Seleccionar una categoria" required>
                    <option value=""> Selecciona una categoria</option>
                    @foreach ($array['departamentos'] as $dept)
                    <option value="{{$dept->id}}">{{ucfirst($dept->valor)}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-4">
                <label for="#" class="form-label">Municipio</label>
                <select class="form-select mb-3" name="new_municipio" id="nuevo_municipio3" required>
                </select>
            </div>

        </div>
        <button type="button" class="btn btn-success m-2" id="btn_filtro"> Buscar </button>
        <button type="button" class="btn btn-warning m-2" id="btn_restart"><i class="bi bi-arrow-clockwise"></i></button>

        <!-- Activacion Modal -->
        <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#registro_nuevo"> Nuevo </button>

        <!-- Modal Registrar -->
        <div class="modal fade" id="registro_nuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Empleado</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="new_empleado" class="form-label">Nombres</label>
                                    <input type="input" class="form-control" id="new_empleado" aria-describedby="nombreempleado" name="new_empleado" required>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="new_apellido" class="form-label">Apellidos</label>
                                    <input type="input" class="form-control" id="new_apellido" aria-describedby="nombreempleado" name="new_apellido" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-8">
                                    <label for="new_correo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" id="new_correo" aria-describedby="nombreempleado" name="new_correo" required>
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="new_telefono" class="form-label">Telefono</label>
                                    <input type="input" class="form-control" maxlength="8" id="new_telefono" aria-describedby="nombreempleado" name="new_telefono" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="new_dirrecion" class="form-label">Dirreccion</label>
                                <input type="text" class="form-control" id="new_dirrecion" aria-describedby="nombreempleado" name="new_dirrecion" required>
                            </div>

                            <div class="row">


                                <label for="#n_depto">Departamento</label>
                                <select class="form-select form-select-sm mb-3" name="new_departamento" id="nuevo_departamento" placeholder="Seleccionar una categoria" required>
                                    <option value=0> Selecciona una categoria</option>
                                    @foreach ($array['departamentos'] as $dept)
                                    <option value="{{$dept->id}}">{{ucfirst($dept->valor)}}</option>
                                    @endforeach
                                </select>


                                <label for="#">Municipio</label>
                                <select class="form-select form-select-sm mb-3" name="new_municipio" id="nuevo_municipio" required>
                                </select>

                                <!-- @foreach ($array['municipios'] as $municipios)

                                <option value="{{$municipios->id}}">{{$municipios->valor}} {{$municipios->id}}</option>

                                @endforeach -->
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" id="btn_registrar">Registrar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <table class="table table-dark table-striped-columns m-2" id="tabla_pruebas">
        <button type="button" class="btn btn-dark m-2" id="btn_deleted_data">Datos Eliminados</button>

            <thead>
                <tr>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Municipio</th>
                    <th scope="col">Acciones</th>
                </tr>

            </thead>
            <tbody id="tabla_body">
                @foreach ($array['datos'] as $info)
                <tr>
                    <th scope="col">{{$info->nombre}}</th>
                    <th scope="col">{{$info->apellido}}</th>
                    <th scope="col">{{$info->correo}}</th>
                    <th scope="col">{{$info->telefono}}</th>
                    <th scope="col">{{$info->direccion}}</th>
                    <th scope="col">{{$info->departamento_texto}}</th>
                    <th scope="col">{{$info->municipio_texto}}</th>
                    <th scope="col">
                        <button type="button" id="btnEditar" data-codigo="{{$info->id}}" class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" id="btnEliminar" data-codigo="{{$info->id}}" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button>
                    </th>
                </tr>

                <!-- Modal Actualizar -->
                <div class="modal fade" id="modificar_registro_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Empleado</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{route('prueba.update')}}">
                                    @csrf
                                    <input type="text" name="new_id" id="id_emp" hidden>
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="nombre_emp" class="form-label">Nombres</label>
                                            <input type="input" class="form-control" id="nombre_emp" aria-describedby="nombreempleado" name="new_empleado" required>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="apellido_emp" class="form-label">Apellidos</label>
                                            <input type="input" class="form-control" id="apellido_emp" aria-describedby="nombreempleado" name="new_apellido" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-8">
                                            <label for="correo_emp" class="form-label">Correo</label>
                                            <input type="email" class="form-control" id="correo_emp" aria-describedby="nombreempleado" name="new_correo" required>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label for="telefono_emp" class="form-label">Telefono</label>
                                            <input type="input" class="form-control" maxlength="8" id="telefono_emp" aria-describedby="nombreempleado" name="new_telefono" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="direccion_emp" class="form-label">Dirreccion</label>
                                        <input type="text" class="form-control" id="direccion_emp" aria-describedby="nombreempleado" name="new_dirrecion" required>
                                    </div>

                                    <div class="row">


                                        <label for="#n_depto">Departamento</label>
                                        <select class="form-select form-select-sm mb-3" name="new_departamento" id="nuevo_departamento2" placeholder="Seleccionar una categoria" required>
                                            <option value=""> Selecciona una categoria</option>
                                            @foreach ($array['departamentos'] as $dept)
                                            <option value="{{$dept->id}}">{{ucfirst($dept->valor)}}</option>
                                            @endforeach
                                        </select>


                                        <label for="#">Municipio</label>
                                        <select class="form-select form-select-sm mb-3" name="new_municipio" id="nuevo_municipio2" required>
                                        </select>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" id="btn_actualizar">Actualizar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>


                @endforeach
            </tbody>
        </table>

        <!-- <script>
        
        $(document).on('change','#n_depto', function (e) {
            console.log(this.val)
        });
    </script> -->


</body>

</html>