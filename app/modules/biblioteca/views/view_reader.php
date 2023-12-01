<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

/**
 *
 * @author CRISTIAN PAZ
 * @date 1 dic. 2023
 * @time 14:37:46
 */

include '../../../dashboard.php';
include '../Models/get_books_act.php';
?>

<head>
    <title>Reader</title>
</head>

<main>
    <div class="container">
        <div class="row">
            <?php foreach ($list_libros as $val) { ?>
                <div class="container mt-5 p-3 col-md-3">
                    <div class="card" style="width: 15rem;">
                        <img src="../../../../public/img/books/<?= $val['img'] ?> " class="card-img-top" alt="Portada del Libro">
                        <div class="card-body">
                            <h5 class="card-title"><?= $val['title'] ?></h5>
                            <p class="card-text"><strong>Autor:</strong> <?= $val['author'] ?></p>
                            <p class="card-text"><strong>Género:</strong> <?= $val['genre'] ?></p>
                            <a href="#" class="btn btn-info">Más Detalles</a>
                            <a href="#" class="btn btn-primary" onclick="solicitar()">Solicitar</a>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal_detalle">Demo</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>

<div class="modal fade" id="modal_detalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Demo del libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eos laborum esse adipisci nisi nulla nam dicta earum a quod aliquam voluptates, excepturi corrupti consequatur dolorum vero culpa, architecto ut molestiae?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    function solicitar() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta punto de solicitar el prestamo de este libro, Desea continuar',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('¡Acción confirmada!', 'El prestamo se ha proceado exitosamente', 'success');
            }
        });
    }

</script>