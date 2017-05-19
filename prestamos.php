<?php
include("php/conectar.php");
$link = conectar();
extract($_POST);
error_reporting(0);//para no mostrar el error por variables aun no definidas
if(isset($ins))
{
  echo "hola";
}
$ins = $link -> query("INSERT INTO libro VALUES ('', '$inputTitulo', '$inputAutor', '$inputEditorial','$inputGenLit', '$inputAnio', '$inputEdicion', '$inputIdioma')");
$query_autor = "select id_autor, nombre_autor from autor";
//echo "('', '$inputTitulo', '$inputAutor', '$inputEditorial','$inputGenLit', '$inputAnio', '$inputEdicion', '$inputIdioma')";
$query_buscarPersona = "SELECT id_persona, nombre, apellido FROM persona WHERE num_documento = '$inputBuscarPer'";
$result_buscarPersona = mysqli_query($link, $query_buscarPersona) or die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
echo "$inputBuscarPer";
$personaQuery = mysqli_fetch_array($result_buscarPersona);
extract($personaQuery);
echo "$nombre";
$query_libro = "SELECT id_libro, titulo FROM libro";
$result_libro = mysqli_query($link, $query_libro) or die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error()); //Query editorial
/*
while($fila_editorial = )
            {
              extract($fila_editorial);
              echo "<option value='$id_editorial'>$nombre_editorial</option>";
            }*/
//echo '<br>'.$inputTipoDoc. $inputNumeroDoc.$inputNombre.$inputApellido.$inputTelefono.$inputDireccion.$inputTipoUsu;
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
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="index.html"><i class="fa fa-book fa-2x" aria-hidden="true"></i>Bibliocom</a>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-md-0">
      <li class="nav-item"><!--el badge-deafult es para resaltar el texto inicio-->
        <a class="nav-link" href="index.html"><i class="fa fa-home" aria-hidden="true"></i>     Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="personas.php" ><i class="fa fa-address-book" aria-hidden="true"></i>      Personas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="libros.php"><i class="fa fa-book" aria-hidden="true"></i>      Libros</a>
      </li>
      <li class="nav-item active badge-default">
        <a class="nav-link" href="prestamos.php"><i class="fa fa-bookmark" aria-hidden="true"></i>      Prestamos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="devoluciones.php"><i class="fa fa-bookmark-o" aria-hidden="true"></i>      Devoluciones</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="informes.html"><i class="fa fa-newspaper-o" aria-hidden="true"></i>      Informes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/BibliotecaBD2/listado_libros.php"><i class="fa fa-file-text" aria-hidden="true"></i>     Listado de libros</a>
      </li>
    </ul>
  </div>
  </div>
</nav>
<?php
/*
  if ($ins) {
     echo '<div class="alert alert-success alert-dismissable container col-sm-6 espacioform" role="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Gracias</strong>   Tus datos han sido registrados con éxito
</div>';
  }
  else{
    echo '<div class="alert alert-danger alert-dismissable container col-sm-6 espacioform" role="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Error</strong>   Por favor verifica los datos
</div>';
  }
 */    ?>
        <div class="container col-sm-5 espacioform"><!-- col-sm-6 para centrar el container-->
          <form method="POST">
          <div class="resultado"></div>
   <label for="inputBuscar">Buscar persona</label>
   <div class="input-group">
     <input type="text" class="form-control" id="inputBuscar" name="inputBuscarPer" aria-describedby="documentoPersona" placeholder="Ingrese el número de documento de la persona">
    <button class="btn btn-primary" onclick="Validar(document.getElementById('inputBuscar').value;">Buscar</button>
   </div>

   <?php
   $resultadosSelect = mysqli_affected_rows($link);
   if ($resultadosSelect > 0) {
    echo "
    <div class='alert alert-success' role='alert'>
  <strong>Usuario encontrado!</strong> $nombre $apellido.
</div>";
    }
  ?>
  <br><label for="sl_libro">Libro</label>
  <div class="input-group">
    <select class="form-control" id="sl_libr" name="inputLibro">
      <option value='0'></option>;
            <?php
            while($fila_libro = mysqli_fetch_array($result_libro))
            {
              extract($fila_libro);
              echo "<option value='$id_libro'>$titulo</option>";
            }
            ?>
    </select>
        <button class="btn btn-primary" type="button">Añadir Género</button>
  </div>

  <label for="inputBuscar">Buscar libro</label>
   <div class="input-group">
     <input type="text" class="form-control" id="inputBuscar" name="inputBuscarLibro" placeholder="Ingrese el libro">
    <button class="btn btn-primary">Buscar</button>
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
        <button class="btn btn-primary" type="button">Añadir Género</button>
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
        <button class="btn btn-primary" type="button">Añadir Idioma</button>
  </div>
  </br><button type="submit" class="btn btn-primary" onclick="<?php $enviarForm = TRUE; ?>">Submit</button>
</form>
</div>
      </header>
    </section>
    <footer class="navbar-inverse">
      <p class="font-italic">Nicolas Ariza - Biblioteca ©</p>
    </footer>
  </body>
</html>