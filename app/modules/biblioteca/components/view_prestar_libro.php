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
include '../Models/get_transactions.php';
include '../Models/get_books_act.php';
include '../Models/get_users.php';
?>
<head>
    <title>Prestar Libro</title>
</head>

<section class="p-4 rounded-lg">
    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_prestar">Prestar Libro</button>
    <table class="table table-bordered table-striped mt-3">
        <thead class="bg-secondary">
            <tr>
                <th>#</th>
                <th>Libro</th>
                <th>Prestado por</th>
                <th>Fecha de Prestamo</th>
                <th>Lector</th>
                <th>Fecha de devolución</th>
                <th>Estado</th>
                <th>Acciones</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($transacciones as $transaccion) {
                ?>
                <tr>
                    <td><?= $transaccion['id'] ?></td>
                    <td><?= $transaccion['titulo'] ?></td>
                    <td><?= $transaccion['nombre_user_prestador'] ?></td>
                    <td><?= $transaccion['date_of_issue'] ?></td>
                    <td><?= $transaccion['nombre_lector'] ?></td>
                    <td><?= $transaccion['date_of_return'] ?></td>
                    <td><span class="badge bg-warning"><i class="fas fa-warning"></i> Prestado</span></td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-warning" onclick="load_prestamo(<?= $transaccion['id'] ?>)"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger" onclick="delete_prestamo(<?= $transaccion['id'] ?>)"><i class="fas fa-trash"></i></button>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<!-- Modal -->
<div class="modal fade" id="modal_prestar" tabindex="-1" role="dialog" aria-labelledby="modal_prestar" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Prestar Libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formulario3" action="../Controllers/PrestarController.php" method="POST" enctype="multipart/form-data">

                    <div class="col-span-2">
                        <input type="hidden" name="id_prestamo" id="id_prestamo">
                        <input type="hidden" name="id_user" id="id_user" value="<?= $_SESSION['user']['id'] ?>" style="resize: none;">
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-2 text-gray-700">Lector:</label>
                        <select class="form-control" name="lector_id" id="lector_id">
                            <?php foreach ($list_users as $us) { ?>
                                <option value="<?= $us['id'] ?>"><?= $us['nombres'] . ' ' . $us['apellidos'] ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <br>
                    <div class="col-span-1">
                        <label class="block mb-2 text-gray-700">Libro:</label>
                        <select class="form-control" name="libro_id" id="libro_id">
                            <?php foreach ($list_libros as $us) { ?>
                                <option value="<?= $us['id'] ?>"><?= $us['title'] ?></option>
                            <?php } ?>
                        </select>                  
                    </div>
                    <br>
                    <div class="col-span-2">
                        <label class="block mb-2 text-gray-700">Fecha de Devolución:</label>
                        <input type="date" class="form-control" name="f_devolucion" id="f_devolucion" value="<?php echo date('Y-m-d') ?>">
                    </div>


                    <!-- Botón de envío -->
                    <div class="text-right mt-4">   
                        <button type="submit" class="btn btn-primary">Prestar Libro</button>              
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<script>
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

                        swal.fire({
                            title: 'Atención',
                            icon: 'success',
                            html: '<h5>' + data.msg + '</h5>'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "view_prestar_libro.php";
                            }
                        });

                    } else if (data.status.trim() === "warning") {
                        swal.fire({
                            title: 'Atención',
                            icon: 'warning',
                            html: '<h5>' + data.msg + '</h5>'
                        });
                    } else if (data.status.trim() === "fail") {
                        swal.fire({
                            title: 'Atención',
                            icon: 'error',
                            html: '<h5>' + data.msg + '</h5>'
                        });
                    } else if (data.status.trim() === "succ_edit") {

                        swal.fire({
                            title: 'Atención',
                            icon: 'success',
                            html: '<h5>' + data.msg + '</h5>'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "view_prestar_libro.php";

                            }
                        });


                    }

                })
                .catch(error => {
                    console.log('Error al enviar formulario:', error);
                });
    });

    function load_prestamo(id) {
        const url = "../Controllers/PrestarController.php?action=load_prestamo&id=" + id;

        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('lector_id').value = data[0].lector_id;
                        document.getElementById('libro_id').value = data[0].book_id;
                        document.getElementById('f_devolucion').value = data[0].date_of_return;
                        document.getElementById('id_prestamo').value = data[0].id;
                        $("#modal_prestar").modal();
                    } else {
                        swal.fire({
                            title: 'Atención',
                            icon: 'warning',
                            html: '<h5>No se han encontrado registros</h5>'
                        });
                    }

                })
    }
    function delete_prestamo(id) {
        const url = "../Controllers/PrestarController.php?action=delete_prestamo&id=" + id;

        var userConfirmed = window.confirm('Esta seguro que desea eliminar el libro?');

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
                                    window.location.href = "view_prestar_libro.php";

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