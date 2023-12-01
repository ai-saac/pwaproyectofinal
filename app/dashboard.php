<?php
/**
 * Description of view_books
 
/**
 * @author CRISTIAN PAZ
 * @date 30 nov. 2023
 * @time 15:08:50
 */     
 
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

session_start();
if (!isset($_SESSION['user'])) {
   header("Location: ../../../../index.php");
    exit;
}
?>

<!--<!DOCTYPE html>-->
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Biblioteca</title>
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"  />
        <!-- Bootstrap 4 -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- style modulos -->
        <link rel="stylesheet" href="../../../../public/css/styleModules.css">
        <!-- SweetAlert2 -->
        <script src="../../../../public/plugins/sweetAlert2_11.js"></script>
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script src="https://kit.fontawesome.com/9d60ee0290.js" crossorigin="anonymous"></script>
    </head>

    <body >
        <!-- Sidebar -->
        <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="../../../../index.php">Biblioteca Online</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../../../../index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#contactos">Contactos</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-slate-600 font-semibold mr-4">
                                <strong><?php echo $_SESSION['user']['nombres'] . ' ' . $_SESSION['user']['apellidos'] ?></strong>
                            </span><i class="fas fa-door-open"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Perfil</a>
                            <div class="dropdown-divider"></div>
                            <a href="../../../../auth/logout.php" class="dropdown-item" href="#"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesción</a>
                        </div>
                    </li>
                </ul>

            </div>
        </nav>
        
<!-- Modal -->
<div class="modal fade" id="contactos" tabindex="-1" role="dialog" aria-labelledby="contactos" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contactos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <span>Dev: Cristian Paz</span><br>
          <span>Telefono: 0992094788</span><br>
          <span>Correo: pcris.994@gmail.com</span>
          <hr>
           <span>Dev: Aisac Joel Ordoñes</span><br>
          <span>Telefono: 0982554788</span><br>
          <span>Correo: aisac.994@gmail.com</span>
          <hr>
           <span>Dev: Franz Riofrio</span><br>
          <span>Telefono: 0992025665</span><br>
          <span>Correo: franz.444@gmail.com</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 