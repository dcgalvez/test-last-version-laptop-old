console.log('Siuuuuuuuuu')


$(document).on('click', '#btn_registrar', function (event) {
    event.preventDefault();

    var formData = {
        new_empleado: $("#new_empleado").val(),
        new_apellido: $("#new_apellido").val(),
        new_correo: $("#new_correo").val(),
        new_telefono: $("#new_telefono").val(),
        new_dirrecion: $("#new_dirrecion").val(),
        new_municipio: $("#nuevo_municipio").val(),
        new_departamento: $("#nuevo_departamento").val(),
    };

    console.log(formData);

    enviar_ajax(formData, "/registrar_empleado");

    Swal.fire(
        'Exito!',
        'Se ha guardado Correctamente',
        'success'
    )

    $('#registro_nuevo').modal('hide');



});

$(document).on('click', '#btn_filtro', function (event) {
    event.preventDefault();

    var formData = {
        new_empleado: $("#nombre_filtro").val(),
        new_apellido: $("#apellido_filtro").val(),
        new_correo: $("#correo_filtro").val(),
        new_telefono: $("#telefono_filtro").val(),
        new_dirrecion: $("#direccion_filtro").val(),
        new_municipio: $("#nuevo_municipio3").val(),
        new_departamento: $("#nuevo_departamento3").val(),
    };

    console.log(formData);

    enviar_ajax(formData, "/buscar_empleado");
});

$(document).on('click', '#btn_restart', function (event) {
    event.preventDefault();

    enviar_ajax({}, "/resetear_empleados");
});

$(document).on('click', '#btn_deleted_data', function (event) {
    event.preventDefault();

    enviar_ajax_deleted_data({}, "/datos_eliminados");
});

$(document).on('click', '#btn_actualizar', function (event) {
    event.preventDefault();

    var formData_act = {
        new_empleado: $("#nombre_emp").val(),
        new_apellido: $("#apellido_emp").val(),
        new_correo: $("#correo_emp").val(),
        new_telefono: $("#telefono_emp").val(),
        new_dirrecion: $("#direccion_emp").val(),
        new_municipio: $("#nuevo_municipio2").val(),
        new_departamento: $("#nuevo_departamento2").val(),
        new_id: $("#id_emp").val()
    };

    console.log(formData_act);

    enviar_ajax(formData_act, "/modificar_empleado");

    Swal.fire(
        'Exito!',
        'Se ha guardado Correctamente',
        'success'
    )

    $('#modificar_registro_modal').modal('hide');
});

$(document).on('click', '#btnEditar', function () {
    console.log(this.dataset.codigo)
    const id = this.dataset.codigo;
    const encontrarEmpleado = empleados.find(empleado => (empleado.id == id));
    if (encontrarEmpleado) {
        $('#id_emp').val(encontrarEmpleado.id);
        $('#nombre_emp').val(encontrarEmpleado.nombre);
        $('#apellido_emp').val(encontrarEmpleado.apellido);
        $('#correo_emp').val(encontrarEmpleado.correo);
        $('#telefono_emp').val(encontrarEmpleado.telefono);
        $('#direccion_emp').val(encontrarEmpleado.direccion);
        $('#nuevo_departamento2').val(`${encontrarEmpleado.id_depto}`);
        cambiarMunicipio(encontrarEmpleado.id_depto, true);
        $('#nuevo_municipio2').val(`${encontrarEmpleado.id_municipio}`);
        $('#modificar_registro_modal').modal('show');
    }
});

$(document).on('click', '#btnEliminar', function (event) {
    event.preventDefault();

    Swal.fire({
        title: 'Estas seguro de eliminar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            const id = this.dataset.codigo;

            var formData_del = {
                nuevo_id: id
            };

            console.log(formData_del);

            enviar_ajax(formData_del, "/eliminar_empleado");

            Swal.fire(
                'Eliminado!',
                'El registro ha sido eliminado',
                'success'
            )
        }
    })

});


$(document).on('click', '#btn_restore', function (event) {
    event.preventDefault();


    const id = this.dataset.deleted;

    var formData_deleted_data = {
        viejo_id: id
    };

    console.log(formData_deleted_data);

    enviar_ajax_deleted_data(formData_deleted_data, "/restaurar");

    Swal.fire(
        'Exito',
        'El registro ha sido restaurado',
        'success'
    )

});

$(document).on('change', '#nuevo_departamento', function () {
    let id = $(this).val();
    cambiarMunicipio(id);
});

$(document).on('change', '#nuevo_departamento2', function () {
    let id = $(this).val();
    cambiarMunicipio(id, true);
});

$(document).on('change', '#nuevo_departamento3', function () {
    let id = $(this).val();
    cambiarMunicipio_filtro(id);
});



function cambiarMunicipio(departamento, editar = false) {
    $('#nuevo_municipio').empty();
    $('#nuevo_municipio2').empty();
    const encontrarMunicipios = municipios.map(municipio => {
        if (municipio.id_padre == departamento) {
            console.log(municipio)
            if (editar) {
                $('#nuevo_municipio2').append(`<option value="${municipio.id}">${municipio.valor}</option>`);
            } else {
                $('#nuevo_municipio').append(`<option value="${municipio.id}">${municipio.valor}</option>`);
            }
        }
    });
}

function cambiarMunicipio_filtro(departamento) {
    $('#nuevo_municipio3').empty();
    $('#nuevo_municipio3').append(`<option value="">Seleccione un Municipio</option>`);
    const encontrarMunicipios = municipios.map(municipio => {
        if (municipio.id_padre == departamento) {
            console.log(municipio)
            $('#nuevo_municipio3').append(`<option value="${municipio.id}">${municipio.valor}</option>`);

        }
    });
}


function actualizar_tabla(empleados) {
    $('#tabla_body').empty();
    empleados.forEach(empleado => {
        $('#tabla_body').append(`<tr>
        <td>${empleado.nombre}</td>
        <td>${empleado.apellido}</td>
        <td>${empleado.correo}</td>
        <td>${empleado.telefono}</td>
        <td>${empleado.direccion}</td>
        <td>${empleado.departamento_texto}</td>
        <td>${empleado.municipio_texto}</td>
        <td>
        <button type="button" id="btnEditar" data-codigo="${empleado.id}" class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
        <button type="button" id="btnEliminar"  data-codigo="${empleado.id}" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
        </td>                
        </tr>`);
    });
}

function actualizar_tabla_deleted_data(empleados) {
    $('#tabla_body').empty();
    empleados.forEach(empleado => {
        $('#tabla_body').append(`<tr>
        <td>${empleado.nombre}</td>
        <td>${empleado.apellido}</td>
        <td>${empleado.correo}</td>
        <td>${empleado.telefono}</td>
        <td>${empleado.direccion}</td>
        <td>${empleado.departamento_texto}</td>
        <td>${empleado.municipio_texto}</td>
        <td>
        <button type="submit" id="btn_restore" data-deleted="${empleado.id}" class="btn btn-warning">Restaurar</button>
        </td>                
        </tr>`);
        console.log(empleado.id);
    });
}

function enviar_ajax(info, ruta) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: ruta,
        data: info,
        dataType: "json",
        success: function (res) {
            console.log(res)
            empleados = res.data;
            actualizar_tabla(empleados);

        },
        error: function (error) {
            console.log(error)
        },
    });
}
function enviar_ajax_deleted_data(info, ruta) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: ruta,
        data: info,
        dataType: "json",
        success: function (res) {
            console.log(res)
            empleados = res.data;
            actualizar_tabla_deleted_data(empleados);

        },
        error: function (error) {
            console.log(error)
        },
    });
}

$(document).ready(function () {
    $('#tabla_pruebas').DataTable();

});
