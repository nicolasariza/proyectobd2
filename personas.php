<?php
include("php/conectar.php");
$link = conectar();
extract($_POST);
error_reporting(0);//para no mostrar el error por variables aun no definidas
session_start();
if (!empty($_POST['salir'])) {
  $_SESSION['id_persona'] = '';
  session_destroy();
}
if (empty($_SESSION['id_per'])) {
  header("location:login.php");
}
$id_per = $_SESSION['id_per'];
$query_per = "SELECT * FROM persona WHERE id_persona = '$id_per'";
$result_per = mysqli_query($link, $query_per) or die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
$datosPersona = mysqli_fetch_array($result_per);
extract($datosPersona);
$ins = $link -> query("CALL registrarPersonas('$inputTipoDoc', '$inputNumeroDoc', '$inputNombre','$inputApellido', '$inputTelefono', '$inputDireccion', '$inputTipoUsu')");
$query_tipoDoc = "select id_tipo_doc, nombre_tipo_doc from tipo_doc";
$result_tipoDoc = mysqli_query($link, $query_tipoDoc) or die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
$query_tipoUsu = "SELECT id_tipo_usuario, nombre_tipo_usuario FROM tipo_usuario";
$result_tipoUsu = mysqli_query($link, $query_tipoUsu) or die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
//echo $enviarForm;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/estilosBiblioteca.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="js/jquery-slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
    <section class="bienvenidos">
      <header class="encabezado">
          <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse"><!--navbar-light bg-faded-->
          <div class="container">
  <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="index.html"><i class="fa fa-book fa-2x" aria-hidden="true"></i>Bibliocom</a>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-md-0">
      <li class="nav-item"><!--el badge-deafult es para resaltar el texto inicio-->
        <a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i>     Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active badge-default">
        <a class="nav-link" href="personas.php" ><i class="fa fa-address-book" aria-hidden="true"></i>      Personas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="libros.php"><i class="fa fa-book" aria-hidden="true"></i>      Libros</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="prestamos.php"><i class="fa fa-bookmark" aria-hidden="true"></i>      Prestamos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="devoluciones.php"><i class="fa fa-bookmark-o" aria-hidden="true"></i>      Devoluciones</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/proyectobd2/listado_libros.php"><i class="fa fa-file-text" aria-hidden="true"></i>     Listado de libros</a>
      </li>
    </ul>
  </div>
  </div>
  <h1 class="navbar-brand mb-0">Iniciaste cómo: <?php echo "$nombre $apellido";  ?></h1>
</nav>
<div class="alert alert-success alert-dismissable container col-sm-6 espacioform" role="alert" id="alertaExito" style="display: none">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Gracias</strong>   Tus datos han sido registrados con éxito
  </div>
  <div class="alert alert-danger alert-dismissable container col-sm-6 espacioform" role="alert" id="alertaError" style="display: none">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Error</strong>   Por favor verifica los datos
</div>
  <?php
 echo  mysqli_affected_rows($link);
 /* if ($link->query($ins) === TRUE) {
    echo '<div class="alert alert-success alert-dismissable container col-sm-6 espacioform" role="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Gracias</strong>   Tus datos han sido registrados con éxito
  </div>' ;
  }
  else if(mysqli_num_rows($ins) == 0)
  {
    echo '<div class="alert alert-danger alert-dismissable container col-sm-6 espacioform" role="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Error</strong>   Por favor verifica los datos
</div>';
  }*/
  ?>
        <div class="container col-sm-5 espacioform"><!-- col-sm-6 para centrar el container-->
          <form method="POST">
  <div class="form-group">
    <label for="inputName">Nombre(s)</label>
    <input type="text" class="form-control" id="inputName" name="inputNombre" aria-describedby="nombre" placeholder="Ingrese su(s) nombre(s)" required pattern="[a-zA-Z]{2-9}*">
  </div>
  <div class="form-group">
    <label for="inputApe">Apellido(s)</label>
    <input type="text" class="form-control" id="inputApe" name="inputApellido" placeholder="Ingrese su(s) apellido(s)" required pattern="[A-Za-z]{2-10}">
  </div>
  <div class="form-group">
    <label for="sl_tUsu">Tipo de usuario</label>
    <select class="form-control" id="sl_tUsu" name="inputTipoUsu" required>
      <option value='0'></option>;
            <?php
            while($fila_tipoUsu = mysqli_fetch_array($result_tipoUsu))
            {
              extract($fila_tipoUsu);
              echo "<option value='$id_tipo_usuario'>$nombre_tipo_usuario</option>";
            }         
            ?>
    </select>
  </div>
  <div class="form-group">
    <label for="sl_tipoDoc">Tipo de documento</label>
    <select class="form-control" id="sl_tipoDoc" name="inputTipoDoc" required>
      <option value='0'></option>;
            <?php
            while($fila_tipoDoc = mysqli_fetch_array($result_tipoDoc))
            {
              extract($fila_tipoDoc);
              echo "<option value='$id_tipo_doc'>$nombre_tipo_doc</option>";
                  
            }         
            ?>
    </select>
  </div>
  <div class="form-group">
    <label for="inputNumDoc">Número de documento</label>
    <input type="number" class="form-control" id="inputNumDoc" name="inputNumeroDoc" placeholder="Ingrese su número de documento" required>
  </div>
    <div class="form-group">
    <label for="inputTel">Teléfono</label>
    <input type="number" class="form-control" id="inputTel" name="inputTelefono" placeholder="Ingrese su teléfono" required >
  </div>
  <div class="form-group">
    <label for="inputDir">Dirección</label>
    <input type="tel" class="form-control" id="inputDir" name="inputDireccion" placeholder="Ingrese su dirección" required>
  </div>
  <div class="container col-sm-2"> 
    <button type="submit" class="btn btn-primary" onclick="insertf()">Guardar</button>
    <script type="text/javascript">
      function insertf(){
        alert ("Exito");
      }
    </script>
<!--    <?php 
    if ($ins) {
    ?>
    <script>
      function insertf() {
      document.getElementById('alertaExito').style.display = ''; 
      }
    </script>
    <?php
    }
    else{
    ?>
    <script>
      function insertf() {
      document.getElementById('alertaError').style.display = '';
      }
    </script>
    <?php
    }
     ?>-->
  </div>
  </form>
</div>
      </header>
    </section>
    <footer class="container col-sm-2 espacioform">
      <p>Nicolas Ariza - Biblioteca ©</p>
    </footer>
  </body>
</html>