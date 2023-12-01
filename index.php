<?php
session_start();
if (isset($_SESSION['user'])) {
    $rol = $_SESSION['user']['role_id'];
    if ($rol == 1 || $rol == 2) {
//        echo '<script>window.location.replace("app/modules/biblioteca/views/view_admin.php");</script>';

        header("Location: app/modules/biblioteca/views/view_admin.php");
    } else {
//                echo '<script>window.location.replace("app/modules/biblioteca/views/view_reader.php");</script>';

        header("Location: app/modules/biblioteca/views/view_reader.php");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"  />
        <title>Login</title>
    </head>

    <body>
        <div class="container mt-5 border">
            <div class="row  p-5">
                <div class="col-md-6 login-banner text-center">  
                    <img src="public/img/logo.png" width="300px">
                    <h3>Sistema de Biblioteca</h3>
                </div>
                <div class="col-md-6 login-form">
                    <div class="form-container">
                        <form id="formu" class="login" method="post" action="./app/Controllers/LoginController.php">
                            <h1 class="text-center">Bienvenido</h1>
                            <div class="form-group">
                                <label for="email">Correo o Usuario:</label>
                                <input type="text" id="email_user" name="email_user" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div> 
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">LogIn</button>
                            </div>
                            <br>
                        </form>
                        <div class="text-center">
                            <button class="btn btn-link"><a href="register.php">Crear Cuenta</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">
                    <span>Usuario Admin</span><br>
                    <span>user: pcris.994@gmail.com</span><br>
                    <span>pass: 305.cc</span>
                </div>
                <div class="col-md-4">
                    <span>Usuario Bibliotecario</span><br>
                    <span>user: victor</span><br>
                    <span>pass: 1234</span>
                </div>
                <div class="col-md-4">

                    <span>Usuario lector</span><br>
                    <span>user: pao</span><br>
                    <span>pass: 1234</span>
                </div>
            </div>
        </div>
    </body>

    <script src="public/plugins/sweetAlert2_11.js"></script>
    <script type="text/javascript">

        document.getElementById("formu").addEventListener('submit', function (e) {

            e.preventDefault();
            var formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            if (data.file === '1') {
                                window.location = "app/modules/biblioteca/views/view_admin.php";
                            } else if (data.file === '2') {
                                window.location = "app/modules/biblioteca/views/view_admin.php";
                            } else if (data.file === '3') {
                                window.location = "app/modules/biblioteca/views/view_reader.php";
                            }
                        } else if (data.status === "warning") {
                            swal.fire({
                                title: 'Atención',
                                icon: 'warning',
                                html: '<h5>' + data.file + '</h5>'
                            });
                        } else if (data.status === "fail") {
                            swal.fire({
                                title: 'Atención',
                                icon: 'error',
                                html: '<h5>' + data.file + '</h5>'
                            });
                        }

                    })
                    .catch(error => {
                        console.error('Error al enviar formulario:', error);
                    });
        });
    </script>

</html>