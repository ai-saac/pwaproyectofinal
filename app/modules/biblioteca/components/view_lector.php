<?php
/**
 * Description of view_books
 *
  /**
 * @author CRISTIAN PAZ
 * @date 30 nov. 2023
 * @time 15:08:50
 */
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

include '../../../dashboard.php';
include '../Models/get_users_all.php';

?>
<head>
    <title>Registrar Usuario</title>
</head>

<section class="p-4 rounded-lg">
    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_lector">Registrar Usuario</button>
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Usario</th>
                <th>Rol</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
<?php
foreach ($list_users as $val) {
    ?>
                <tr>
                    <td><?= $val['id'] ?></td>
                    <td><?= $val['nombres'] ?></td>
                    <td><?= $val['apellidos'] ?></td>
                    <td><?= $val['email'] ?></td>
                    <td><?= $val['username'] ?></td>
                    <td><?= $val['rol'] ?></td>

                    <td class="text-center"><?= $val['state'] == 1 ? '✅ ACTIVO' : 'INACTIVO' ?> </td>      

                    <td class="text-center">
                        <button class="btn btn-sm btn-warning" onclick="load_lector(<?= $val['id'] ?>)"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger" onclick="delete_lector(<?= $val['id'] ?>)"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
<?php } ?>
        </tbody>
    </table>
</section>

<!-- Modal -->
<div class="modal fade" id="modal_lector" tabindex="-1" role="dialog" aria-labelledby="modal_lector" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Lectores o Usuarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario3" class="registro" method="post" action="../../../Controllers/RegistroController.php">
                    <input type="hidden" name="id_lec" id="id_lec">
                    <div class="form-group">
                        <label for="username">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Usuario:</label>
                        <input type="text" id="username" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Confirmar contraseña:</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="role_id">Rol:</label>
                        <select id="role_id" name="role_id" class="form-control">
                            <option value="1">Administrador</option>
                            <option value="2">Librarian</option>
                            <option value="3">Reader</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="block mb-2 text-gray-700">Estado:</label>
                        <select class="form-control" name="state" id="state">
                            <option value="1">Activo</option>>
                            <option value="0">Inactivo</option>>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="submit">Registrar</button>
                    </div>
                </form>
            </div>
            <!--            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>-->
        </div>
    </div>
</div>
<script type="text/javascript">

    document.getElementById("formulario3").addEventListener('submit', function (e) {

        e.preventDefault();
        var formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData
        })
                .then(response => response.json())
                .then(data => {

                    if (data.status.trim() === "success") {
                        document.getElementById('nombre').value = '';
                        document.getElementById('apellido').value = '';
                        document.getElementById('email').value = '';
                        document.getElementById('username').value = '';
                        document.getElementById('password').value = '';
                        document.getElementById('confirm_password').value = '';
                        document.getElementById('id_lec').value = '';

                        swal.fire({
                            title: 'OK',
                            icon: 'success',
                            html: '<h5>USUARIO REGISTRADO EXITOSAMENTE</h5>'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "view_lector.php";

                            }
                        });
                    } else if (data.status.trim() === "succ_edit") {
                        document.getElementById('nombre').value = '';
                        document.getElementById('apellido').value = '';
                        document.getElementById('email').value = '';
                        document.getElementById('username').value = '';
                        document.getElementById('password').value = '';
                        document.getElementById('confirm_password').value = '';
                        document.getElementById('id_lec').value = '';

                        swal.fire({
                            title: 'OK',
                            icon: 'success',
                            html: '<h5>USUARIO ACTUALIZADO EXITOSAMENTE</h5>'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "view_lector.php";

                            }
                        });
                    } else if (data.status.trim() === "warning") {
                        swal.fire({
                            title: 'Atención',
                            icon: 'error',
                            html: '<h5>' + data.msg + '</h5>'
                        });
                    }

                })
                .catch(error => {
                    console.error('Error al enviar formulario:', error);
                });
    });

    function load_lector(id) {
        const url = "../Controllers/LectoresController.php?action=load_lector&id=" + id;

        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('nombre').value = data[0].nombres;
                        document.getElementById('apellido').value = data[0].apellidos;
                        document.getElementById('email').value = data[0].email;
                        document.getElementById('username').value = data[0].username;
                        document.getElementById('password').value = data[0].password;
                        document.getElementById('confirm_password').value = data[0].password;
                        document.getElementById('id_lec').value = data[0].id;
                        $("#modal_lector").modal();
                    } else {
                        swal.fire({
                            title: 'Atención',
                            icon: 'warning',
                            html: '<h5>No se han encontrado registros</h5>'
                        });
                    }

                })
    }
    function delete_lector(id) {
        const url = "../Controllers/LectoresController.php?action=delete_lector&id=" + id;

        var userConfirmed = window.confirm('Esta seguro que desea eliminar el usuario?');

        if (userConfirmed) {

            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status.trim() === "success") {
                            swal.fire({
                                title: 'Atención',
                                icon: 'success',
                                html: '<h5>' + data.msg + '</h5>'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "view_lector.php";

                                }
                            });
                        } else {
                            swal.fire({
                                title: 'Atención',
                                icon: 'warning',
                                html: '<h5>' + data.msg + '</h5>'
                            });
                        }

                    })
        }
    }
</script>
