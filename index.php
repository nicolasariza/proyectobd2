<?php 
include("php/conectar.php");
$link = conectar();
extract($_POST);
error_reporting(0);
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
$result_per = mysqli_query($link, $query_per) ;
$datosPersona = mysqli_fetch_array($result_per);
extract($datosPersona);
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
      <header class="encabezado">
          <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse"><!--navbar-light bg-faded-->
          <div class="container">
  <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="index.php"><i class="fa fa-book fa-2x" aria-hidden="true"></i>Bibliocom</a>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-md-0">
      <li class="nav-item active badge-default"><!--el badge-deafult es para resaltar el texto inicio-->
        <a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i>     Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/proyectobd2/personas.php" ><i class="fa fa-address-book" aria-hidden="true"></i>      Personas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/proyectobd2/libros.php"><i class="fa fa-book" aria-hidden="true"></i>      Libros</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/proyectobd2/prestamos.php"><i class="fa fa-bookmark" aria-hidden="true"></i>      Prestamos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/proyectobd2/devoluciones.php"><i class="fa fa-bookmark-o" aria-hidden="true"></i>      Devoluciones</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/proyectobd2/listado_libros.php"><i class="fa fa-file-text" aria-hidden="true"></i>     Listado de libros</a>
      </li>
    </ul>
  </div>
  </div>
   <h1 class="navbar-brand mb-0">Bienvenido/a <?php echo "$nombre $apellido";  ?></h1>
</nav>
      </header>
      <div class="container espacioform">
        <h1 class="display-4 mb-3" style="text-align: center;">Bienvenidos a bibliocom</h1>
        <p style="text-align: center;">Este es un gestor de bibliotecas</p>
      </div>
    <footer class="footerr">
      <p>Nicolas Ariza - Biblioteca ©</p>
    </footer>
  </body>
</html>