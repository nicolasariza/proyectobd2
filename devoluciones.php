<?php
include("php/conectar.php");
$link = conectar();
extract($_POST);
error_reporting(0);//para no mostrar el error por variables aun no definidas
//echo "('', '$inputTitulo', '$inputAutor', '$inputEditorial','$inputGenLit', '$inputAnio', '$inputEdicion', '$inputIdioma')";
$query_buscarPersona = "SELECT id_persona, nombre, apellido FROM persona WHERE num_documento = '$inputBuscarPer'";
$result_buscarPersona = mysqli_query($link, $query_buscarPersona) or die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

$personaQuery = mysqli_fetch_array($result_buscarPersona);
extract($personaQuery);
$ins = $link -> query("UPDATE `libro_persona` SET `id_estado_libro_fk`='$inputEstadoLibro',`id_accion_fk`=2,`fecha_devolucion`='$inputFecha',`observaciones`='$inputDescripcion',`bibliotecario_devolucion`='$inputBibliotecarioPrestamo' WHERE id_libro_persona = '$inputIdDev'");
$query_EstLibro = "SELECT id_estado_libro, nom_estado_libro FROM estado_libro";
$result_EstLibro = mysqli_query($link, $query_EstLibro) or die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
$query_accion = "SELECT id_accion, nom_accion FROM accion WHERE nom_accion = 'Prestamo'";
$result_accion = mysqli_query($link, $query_accion) or die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
$query_bibliotecario = "SELECT id_persona, nombre, apellido FROM persona WHERE id_tipo_usuario_fk = 2";
$result_bibliotecario = mysqli_query($link, $query_bibliotecario) or die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
$query_Libro_Persona = "SELECT * FROM libro_persona WHERE id_persona_fk = '$id_persona' AND id_accion_fk = 1";
$result_libro_persona = mysqli_query($link, $query_Libro_Persona) or die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
$libroPersonaQuery = mysqli_fetch_array($result_libro_persona);
extract($libroPersonaQuery);
echo "$inputIdDev". " - " . "$inputEstadoLibro". " - " . "$inputFecha"." - ". "$inputDescripcion" ." - " . "$inputBibliotecarioPrestamo";
$query_libro = "SELECT id_libro, titulo FROM libro WHERE id_libro = '$id_libro_fk'";
$result_libro = mysqli_query($link, $query_libro) or die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

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
      <li class="nav-item ">
        <a class="nav-link" href="prestamos.php"><i class="fa fa-bookmark" aria-hidden="true"></i>      Prestamos</a>
      </li>
      <li class="nav-item active badge-default">
        <a class="nav-link" href="devoluciones.php"><i class="fa fa-bookmark-o" aria-hidden="true"></i>      Devoluciones</a>
      </li>
      <!--
      <li class="nav-item">
        <a class="nav-link" href="informes.html"><i class="fa fa-newspaper-o" aria-hidden="true"></i>      Informes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/BibliotecaBD2/listado_libros.php"><i class="fa fa-file-text" aria-hidden="true"></i>     Listado de libros</a>
      </li>
-->
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

 */


     ?>
    <div class="container col-sm-5 espacioform"><!-- col-sm-6 para centrar el container-->
          <form method="POST">
          <div class="resultado"></div>
    <input hidden="false" type="text" class="form-control" id="inputPer" name="inputPer" aria-describedby="documentoPersona" value="<?php echo "$id_persona"; ?>">
    
   <label for="inputBuscar">Buscar persona</label>
   <div class="input-group">
     <input type="text" class="form-control" id="inputBuscar" name="inputBuscarPer" aria-describedby="documentoPersona" placeholder="Ingrese el número de documento de la persona">
    <button type="submit" class="btn btn-primary" onclick="Validar(document.getElementById('inputBuscar').value;">Buscar</button>
   </div>
   <?php
   //$resultadosSelect = mysqli_affected_rows($link);
   $resultadosSelect = mysqli_num_rows($result_buscarPersona);
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
      <option
            <?php
            while($fila_libro = mysqli_fetch_array($result_libro))
            {
              extract($fila_libro);
              echo "<option value='$id_libro'>$titulo</option>";
            }
            ?>
      ></option>;
    </select>
  </div>
<!--
  <label for="inputBuscar">Buscar libro</label>
   <div class="input-group">
     <input type="text" class="form-control" id="inputBuscar" name="inputBuscarLibro" placeholder="Ingrese el libro">
    <button class="btn btn-primary">Buscar</button>
    </div>
  -->
  <br><label for="sl_estadoLibro">Estado del libro</label>
  <div class="input-group">
    <select class="form-control" id="sl_estadoLibro" name="inputEstadoLibro">
      <option value='0'></option>;
            <?php
            while($fila_EstLibro = mysqli_fetch_array($result_EstLibro))
            {
              extract($fila_EstLibro);
              echo "<option value='$id_estado_libro'>$nom_estado_libro</option>";
            }
            ?>
    </select>
  </div>
  <div class="form-group">
  <br><label for="example-date-input">Date</label>
  <input class="form-control" type="date" name="inputFecha" value="2011-08-19" id="example-date-input">
  </div>
  <div class="form-group">
    <br><label for="inputTiempoLimit">Tiempo de prestamo</label>
    <input value="<?php echo "$tiempo_limite"; ?>" type="number" class="form-control" id="inputTiempoLimit" name="inputTiempoLimit" placeholder="Ingrese el tiempo límite de prestamo" readonly="">
  </div>
   <div class="form-group">
    <label for="exampleTextarea">Descripcion</label>
    <textarea class="form-control" id="exampleTextarea" rows="3" name="inputDescripcion" placeholder="Ingrese una descripcion"></textarea>
  </div>
    <label for="sl_bibliotecarioPres">Bibliotecario</label>
  <div class="input-group"> 
    <select class="form-control" id="sl_bibliotecarioPres" name="inputBibliotecarioPrestamo">
      <option value='0'></option>;
            <?php
            while($fila_biblioPres = mysqli_fetch_array($result_bibliotecario))
            {
              extract($fila_biblioPres);
              echo "<option value='$id_persona'>$nombre $apellido</option>";
            }
            ?>
    </select>
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
