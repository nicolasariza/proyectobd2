<?php
include("php/conectar.php");
$link = conectar();
extract($_POST);
error_reporting(0);//para no mostrar el error por variables aun no definidas
$ins = $link -> query("INSERT INTO autor (nombre_autor) VALUES ('$inputNombre')");
$query_autor = "select id_autor, nombre_autor from autor order by id_autor desc limit 1";
//echo "('', '$inputTitulo', '$inputAutor', '$inputEditorial','$inputGenLit', '$inputAnio', '$inputEdicion', '$inputIdioma')";
$result_autor = mysqli_query($link, $query_autor) or die('Error de Conexión (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error()); //Query de autor
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
        <div class="container col-sm-5 espacioform"><!-- col-sm-6 para centrar el container-->
          <form method="POST">
  <div class="form-group">
    <label for="inputNombre">Nombre del autor</label>
    <input type="text" class="form-control" id="inputNombre" name="inputNombre" aria-describedby="nombre" placeholder="Ingrese el nombre del autor">
  </div>
    <label for="sl_autor">Autor</label>
   <div class="input-group"><!--el input group hace que el botón quede al lado-->
    <select class="form-control" id="sl_autor" name="inputAutor" >
      <option
      <?php
            while($fila_autor = mysqli_fetch_array($result_autor))
            {
              extract($fila_autor);
              echo "<option value='$id_autor'>$nombre_autor</option>";
            }
            ?>
    
      ></option>;
      </select>
    </div>
  <div class="container col-sm-4">
  <br>
    <button type="submit" class="btn btn-primary">Guardar</button>
  </div>
 </form>
</div>
      </header>
    </section>
    <footer class="container col-sm-4 espacioform">
      <p class="font-italic">Nicolas Ariza - Biblioteca ©</p>
    </footer>
  </body>
</html>