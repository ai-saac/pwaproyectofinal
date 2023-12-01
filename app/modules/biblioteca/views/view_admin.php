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

$rol = $_SESSION['user']['role_id'];
if ($rol === 3) {
    header("Location: view_reader.php");
}
?>
<head>
    <title>Biblioteca on line</title>
</head>

<main class="ml-4 pt-4 px-4">
    <section class="p-4 rounded-lg">

        <div class="container-fluid">
            <div class="row">
              
                <div class="col-xl-3 col-md-6 col-lg-12">
                    <a href="../components/view_books.php " style="text-decoration: none">
                        <div class="info-box bg-mod-gradient-gray ">

                            <span class="info-box-icon push-bottom"><i class="fas fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Opción</span>
                                <span class="info-box-number">Registrar Libros</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"> </div>
                                </div>
                                <div class="info-box-content text-right">
                                    <span class="progress-description">Ingresar <i class="fas fa-arrow-circle-up"></i></span>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-12">
                    <a href="../components/view_prestar_libro.php" style="text-decoration: none">
                        <div class="info-box bg-mod-gradient-info ">

                            <span class="info-box-icon push-bottom"><i class="fas fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Opción</span>
                                <span class="info-box-number">Prestar Libros</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"> </div>
                                </div>
                                <div class="info-box-content text-right">
                                    <span class="progress-description">Ingresar <i class="fas fa-arrow-circle-up"></i></span>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-12">
                    <a href="../components/view_lector.php" style="text-decoration: none">
                        <div class="info-box bg-mod-gradient-gray ">

                            <span class="info-box-icon push-bottom"><i class="fas fa-user-tie"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Opción</span>
                                <span class="info-box-number">Registrar Lector o Usuarios</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"> </div>
                                </div>
                                <div class="info-box-content text-right">
                                    <span class="progress-description">Ingresar <i class="fas fa-arrow-circle-up"></i></span>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>
                  <?php if($rol == 1 ) {?>
                <div class="col-xl-3 col-md-6 col-lg-12">
                    <a href="#" style="text-decoration: none">
                        <div class="info-box bg-mod-gradient-info ">

                            <span class="info-box-icon push-bottom"><i class="fas fa-chart-pie"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Opción</span>
                                <span class="info-box-number">Tendencias</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"> </div>
                                </div>
                                <div class="info-box-content text-right">
                                    <span class="progress-description">En construccion <i class="fas fa-arrow-circle-up"></i></span>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>
                  <?php }?>
            </div>
        </div>
    </section>
      <?php if($rol == 1 ) {?>
    <section class="p-4 rounded-lg">
        <h3><i class="fas fa-book"></i> Libros Prestados</h3>
        <table class="table table-bordered table-striped">
            <thead class="bg-secondary">
                <tr>
                    <th>#</th>
                    <th>Libro</th>
                    <th>Prestado por</th>
                    <th>Fecha de Prestamo</th>
                    <th>Lector</th>
                    <th>Fecha de devolución</th>
                    <th>Estado</th>
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

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
  <?php }?>
  
   
</main>