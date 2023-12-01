<!DOCTYPE html>
<!--
/**
 * Description of registerr
 *
/**
 * @author CRISTIAN PAZ
 * @date 1 dic. 2023
 * @time 14:29:52
 */       
 
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>Registro</title>
    </head>

    <body>
        <div class="container mt-5">
            <div class="row p-5" style="display: flex; place-content: center">

                <div class="col-md-6 login-form border p-3">
                    <div class="form-container">
                        <form id="form" class="registro" method="post" action="./app/Controllers/RegistroController.php">
                            <h1 class="text-center">Formulario de Registro</h1>
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
                                    <!--                                    <option value="1">Administrador</option>
                                                                        <option value="2">Librarian</option>-->
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
                                <a href="index.php" class="btn btn-secondary" name="submit">LogIn</a>
                                <button type="submit" class="btn btn-primary" name="submit">Registrarse</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="public/plugins/sweetAlert2_11.js"></script>
    <script type="text/javascript">

        document.getElementById("form").addEventListener('submit', function (e) {

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
                            swal.fire({
                                title: 'OK',
                                icon: 'success',
                                html: '<h5>USUARIO REGISTRADO EXITOSAMENTE</h5>'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "index.php";

                                }
                            });
                        } else if (data.status.trim() === "warning") {
                            swal.fire({
                                title: 'Atención',
                                icon: 'warning',
                                html: '<h5>' + data.msg + '</h5>'
                            });
                        } else {
                            swal.fire({
                                title: 'Atención',
                                icon: 'warning',
                                html: '<h5>' + data.msg + '</h5>'
                            });
                        }

                    })
                    .catch(error => {
                        console.log('Error al enviar formulario:', error);
                    });
        });
    </script>

</html>