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
include '../Models/get_books.php';
?>
<head>
    <title>Crear Libro</title>
</head>

<section class="p-4 rounded-lg">
    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_crear">Crear Libro</button>
    <table class="table table-bordered table-striped mt-3">
        <thead class="bg-secondary">
            <tr>
                <th>#</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Año</th>
                <th>Genero</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($list_libros as $val) {
                ?>
                <tr>
                    <td><?= $val['id'] ?></td>
                    <td><?= $val['title'] ?></td>
                    <td><?= $val['author'] ?></td>
                    <td class="text-center"><?= $val['year'] ?></td>
                    <td><?= $val['genre'] ?></td>
                    <td><?= $val['quantity'] ?></td>
                    <td class="text-center"><?= $val['state'] == 1 ? '.✅ ACTIVO' : 'INACTIVO' ?> </td>      

                    <td class="text-center">
                        <button class="btn btn-sm btn-warning" onclick="load_libro(<?= $val['id'] ?>)"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger" onclick="delete_libro(<?= $val['id'] ?>)"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<!-- Modal -->
<div class="modal fade" id="modal_crear" tabindex="-1" role="dialog" aria-labelledby="modal_crear" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formulario1" action="../Controllers/LibrosController.php" method="POST" enctype="multipart/form-data">
                    <!-- Columna 1 -->
                    <input type="hidden" id="id_libro" name="id_libro" value="">
                    <div class="col-span-2">
                        <label class="block mb-2 text-gray-700">Titulo:</label>
                        <input type="text" name="title" id="title" class="form-control" style="resize: none;">
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-2 text-gray-700">Autor:</label>
                        <input type="text" name="author" id="author" class="form-control" style="resize: none;">
                    </div>

                    <div class="col-span-1">
                        <label class="block mb-2 text-gray-700">Año:</label>
                        <input type="number" name="year" id="year" class="form-control" style="resize: none;">
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-2 text-gray-700">Genero:</label>
                        <input type="text" name="genre" id="genre" class="form-control" style="resize: none;">
                    </div>

                    <div class="col-span-1">
                        <label class="block mb-2 text-gray-700">Cantidad:</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" style="resize: none;">
                    </div>

                    <div class="col-span-1">
                        <label class="block mb-2 text-gray-700">Estado:</label>
                        <select class="form-control" name="state" id="state">
                            <option value="1">Activo</option>>
                            <option value="0">Inactivo</option>>
                        </select>
                    </div>

                    <!-- Botón de envío -->
                    <div class="text-right mt-4">   
                        <button type="submit" class="btn btn-primary">Crear</button>              
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

    document.getElementById("formulario1").addEventListener('submit', function (e) {

        e.preventDefault();
        var formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData
        })
                .then(response => response.json())
                .then(data => {
                    if (data.status.trim() === "success") {
                        document.getElementById('title').value = '';
                        document.getElementById('author').value = '';
                        document.getElementById('year').value = '';
                        document.getElementById('genre').value = '';
                        document.getElementById('quantity').value = '';
                        document.getElementById('id_libro').value = '';
                        swal.fire({
                            title: 'Atención',
                            icon: 'success',
                            html: '<h5>' + data.msg + '</h5>'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "view_books.php";
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
                        document.getElementById('title').value = '';
                        document.getElementById('author').value = '';
                        document.getElementById('year').value = '';
                        document.getElementById('genre').value = '';
                        document.getElementById('quantity').value = '';
                        document.getElementById('id_libro').value = '';
                        swal.fire({
                            title: 'Atención',
                            icon: 'success',
                            html: '<h5>' + data.msg + '</h5>'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "view_books.php";

                            }
                        });


                    }

                })
                .catch(error => {
                    console.log('Error al enviar formulario:', error);
                });
    });

    function load_libro(id) {
        const url = "../Controllers/LibrosController.php?action=load_libro&id=" + id;

        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('title').value = data[0].title;
                        document.getElementById('author').value = data[0].author;
                        document.getElementById('year').value = data[0].year;
                        document.getElementById('genre').value = data[0].genre;
                        document.getElementById('quantity').value = data[0].quantity;
                        document.getElementById('state').value = data[0].state;
                        document.getElementById('id_libro').value = data[0].id;
                        $("#modal_crear").modal();
                    } else {
                        swal.fire({
                            title: 'Atención',
                            icon: 'warning',
                            html: '<h5>No se han encontrado registros</h5>'
                        });
                    }

                })
    }
    function delete_libro(id) {
        const url = "../Controllers/LibrosController.php?action=delete_libro&id=" + id;

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
                                    window.location.href = "view_books.php";

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
