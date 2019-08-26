<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= base_url('/assets/css/custom.css');  ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/bootstrap.min.css');  ?>">
    <script src="<?= base_url('/assets/js/jquery-3.4.1.js');  ?>"></script>
    <script src="<?= base_url('/assets/js/bootstrap.min.js');  ?>"></script>
    <script src="<?= base_url('/assets/js/popper.min.js');  ?>"></script>
    <script src="<?= base_url('/assets/js/sweetalert2@8.js');  ?>"></script>
    <script src="<?= base_url('/assets/js/9af2ae507f.js');  ?>"></script>

    <title>Login</title>
  </head>
  <body class="fondo">
      <div class="container form-group mb-2">
        <form method="post">
          <h1 class="display-4">Login con Ajax</h1>
          <label for="user"><span><i class="far fa-user"></i></span> Usuario</label>
          <input class="form-control" type="text" name="usuario" value="" id="user" required placeholder="Ingrese su usuario">
          <label for="password"><span><i class="fas fa-user-lock"></i></span> Contraseña</label>
          <input class="form-control" type="password" name="clave" value="" id="password" required placeholder="Ingrese su contraseña">
          <hr>
          <div class="btn-group">
            <button class="btn btn-primary btn-sm" type="button" name="button" onclick="log()">Ingresar</button>
            <button class="btn btn-secondary btn-sm" type="button" name="button" onclick="registro()">Registrarse</button>

          </div>
          <button class="btn btn-danger btn-sm" type="button" name="button" onclick="info()">Modo de uso</button>
          <br>
        </form>
      </div>

      <div class="modal" tabindex="-1" role="dialog" id="info">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="display-4">Modo de uso</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Para pruebas se debe utitilizar la siguiente sentencia SQL habiendo
                configurado previamente una BDD:</p>
              <br>
              <pre>CREATE TABLE usuarios
                (id INT PRIMARY KEY,
                nombre VARCHAR(100),
                clave VARCHAR(100)
                ); </pre>
              <small>Las contraseñas se guardan cifradas con sha1</small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
          </div>
        </div>
      </div>
  </body>

  <!--Scripts y Ajax-->
  <script>
  //Funcion para llamar al modal de informacion
  function info(){
    $('#info').modal('show');
    }
    //funcion para loguearse
    function log(){
      var usuario = document.getElementById('user').value;
      var password = document.getElementById('password').value;
      if(usuario == '' || password == ''){
        Swal.fire({
          type: 'error',
          title: 'Error',
          text: 'Debe completar todos los campos',
          confirmButtonText:'Aceptar'
        });
      }else{
        $.ajax({
          type:'POST',
          url:'<?= base_url('UserController/login')?>',
          data:{
              usuario:usuario,
              password:password
          },
        success:function(response_array){
          data = JSON.parse(response_array);
          if(data['status'] != 'success'){
            Swal.fire({
              type: 'question',
              title: 'Usuario inexistente',
              confirmButtonText:'Aceptar',
              html:'<a href="#">He olvidado mi contraseña</a>'
            });
          }else{
            Swal.fire({
              type: 'success',
              title: 'Bienvenido',
              text: 'Ingresando..',
              confirmButtonText:'Aceptar'
            });
          }
        },
        error:function(){
          alert('Ocurrio un error inesperado.');
        }
        });
      }
    }
      //funcion para registrar
      function registro(){
        var usuario = document.getElementById('user').value;
        var password = document.getElementById('password').value;
        if(usuario == '' || password == ''){
          Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'Debe completar todos los campos!',
            confirmButtonText:'Aceptar'
          });
        }else{
        $.ajax({
          type:'POST',
          data:{
                usuario:usuario,
                password:password
          },
          url:'<?= base_url('UserController/registro')?>',
          success:function(response_array){
              data = JSON.parse(response_array);
              if(data['status'] == 'exists'){
                Swal.fire({
                  type: 'error',
                  title: 'Error',
                  text: 'El usuario ya existe!',
                  confirmButtonText:'Aceptar'
                });
              }else{
                Swal.fire({
                  type: 'success',
                  title: 'Registro exitoso!',
                  text: 'Se registro correctamente!',
                  confirmButtonText:'Aceptar'
                });
              }
          },
          error:function(){
            alert('Ocurrio un error inesperado.');
          }
        });
      }
    }
  </script>
</html>
