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
$result_per = mysqli_query($link, $query_per);
$datosPersona = mysqli_fetch_array($result_per);
extract($datosPersona);
$insertLibro = "INSERT INTO libro (titulo, id_autor_fk, id_editorial_fk, id_genero_lit_fk, edicion, id_idioma_fk) VALUES ('$inputTitulo', '$inputAutor', '$inputEditorial','$inputGenLit', '$inputEdicion', '$inputIdioma')";
$ins = $link -> query($insertLibro);
$query_autor = "select id_autor, nombre_autor from autor";
//echo "('', '$inputTitulo', '$inputAutor', '$inputEditorial','$inputGenLit', '$inputAnio', '$inputEdicion', '$inputIdioma')";
$result_autor = mysqli_query($link, $query_autor) or die('Error de Conexión (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error()); //Query de autor
$query_editorial = "SELECT id_editorial, nombre_editorial FROM editorial";
$result_editorial = mysqli_query($link, $query_editorial) ; //Query editorial
$query_genLit = "SELECT id_genero_lit, nombre_genero_lit FROM genero_lit";
$result_genLit = mysqli_query($link, $query_genLit) ; //Query genero literario
$query_idioma = "SELECT id_idioma, nombre_idioma FROM idioma";//consulta a la base de datos
$result_idioma = mysqli_query($link, $query_idioma) ; //Query idioma - se llama a la conexión
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
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="index.php"><i class="fa fa-book fa-2x" aria-hidden="true"></i>Bibliocom</a>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-md-0">
      <li class="nav-item"><!--el badge-deafult es para resaltar el texto inicio-->
        <a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i>     Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="personas.php" ><i class="fa fa-address-book" aria-hidden="true"></i>      Personas</a>
      </li>
      <li class="nav-item active badge-default">
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
<?php
   echo mysqli_affected_rows($link);
  if ($ins) {
     echo '<div class="alert alert-success alert-dismissable container col-sm-6 espacioform" role="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Gracias</strong>   Tus datos han sido registrados con éxito
</div>';
  }
  ?>
        <div class="container col-sm-5 espacioform"><!-- col-sm-6 para centrar el container-->
          <form method="POST">
  <div class="form-group">
    <label for="inputTitulo">Título</label>
    <input type="text" class="form-control" id="inputTitulo" name="inputTitulo" aria-describedby="nombre" placeholder="Ingrese el título del libro">
  </div>
    <label for="sl_autor">Autor</label>
   <div class="input-group"><!--el input group hace que el botón quede al lado-->
    <select class="form-control" id="sl_autor" name="inputAutor" >
      <option value='0'></option>;
            <?php
            while($fila_autor = mysqli_fetch_array($result_autor))
            {
              extract($fila_autor);
              echo "<option value='$id_autor'>$nombre_autor</option>";
            }
            ?>
    </select>
        <button class="btn btn-primary" type="button" onclick="window.open('autor.php','','top=150, left=300,width=700,height=400,noresize')">Añadir autor</button>
  </div>
  <br><label for="sl_editorial">Editorial</label>
  <div class="input-group">
    <select class="form-control" id="sl_editorial" name="inputEditorial">
      <option value='0'></option>;
            <?php
            while($fila_editorial = mysqli_fetch_array($result_editorial))
            {
              extract($fila_editorial);
              echo "<option value='$id_editorial'>$nombre_editorial</option>";
            }
            ?>
    </select>
        <button class="btn btn-primary" type="button" onclick="window.open('editorial.php','','top=150, left=300,width=700,height=400,noresize')">Añadir editorial</button>
  </div>  
  <br><label for="sl_genLit">Genero literario</label>
  <div class="input-group">
    <select class="form-control" id="sl_genLit" name="inputGenLit">
      <option value='0'></option>;
            <?php
            while($fila_genLit = mysqli_fetch_array($result_genLit))
            {
              extract($fila_genLit);
              echo "<option value='$id_genero_lit'>$nombre_genero_lit</option>";
            }
            ?>
    </select>
        <button class="btn btn-primary" type="button" onclick="window.open('generoLit.php','','top=150, left=300,width=700,height=400,noresize')">Añadir Género</button>
  </div>
  <div class="form-group">
    <br><label for="inputAnio">Año</label>
    <input type="number" class="form-control" id="inputAnio" name="inputAnio" placeholder="Ingrese el año">
  </div>
    <div class="form-group">
    <label for="inputEdicion">Edición</label>
    <input type="number" class="form-control" id="inputEdicion" name="inputEdicion" placeholder="Ingrese la edición del libro">
  </div>
    <label for="sl_idioma">Idioma</label>
  <div class="input-group">
    <select class="form-control" id="sl_idioma" name="inputIdioma">
      <option value='0'></option>;
            <?php
            while($fila_idioma = mysqli_fetch_array($result_idioma))
            {
              extract($fila_idioma);
              echo "<option value='$id_idioma'>$nombre_idioma</option>";
            }
            ?>
    </select>
        <button class="btn btn-primary" type="button" onclick="window.open('idioma.php','','top=150, left=300,width=700,height=400,noresize')">Añadir Idioma</button>
  </div>
  <div class="container col-sm-2">
  <br>
    <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
 </form>
</div>
      </header>
    </section>
    <footer class="container col-sm-2 espacioform">
      <p class="font-italic">Nicolas Ariza - Biblioteca ©</p>
    </footer>
  </body>
</html>