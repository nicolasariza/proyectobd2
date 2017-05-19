<?php
include("php/conectar.php");
$link = conectar();
extract($_POST);
error_reporting(0);//para no mostrar el error por variables aun no definidas
$ins = $link -> query("INSERT INTO genero_lit (nombre_genero_lit) VALUES ('$inputGenLit')");
$query_editorial = "SELECT id_editorial, nombre_editorial FROM editorial ORDER BY id_editorial DESC LIMIT 1";
$result_editorial = mysqli_query($link, $query_editorial) or die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error()); //Query editorial
$query_genLit = "SELECT id_genero_lit, nombre_genero_lit FROM genero_lit ORDER BY id_genero_lit DESC LIMIT 1";
$result_genLit = mysqli_query($link, $query_genLit) or die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error()); //Query genero literario

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
    <label for="inputGeneroLit">Nombre del genero literario</label>
    <input type="text" class="form-control" id="inputGeneroLit" name="inputGenLit" aria-describedby="nombre" placeholder="Ingrese el nombre del genero literario">
  </div>
    <label for="sl_genLit">Genero literario</label>
  <div class="input-group">
    <select class="form-control" id="sl_genLit" name="inputGeneroLite">
      <option
    <?php
            while($fila_genLit = mysqli_fetch_array($result_genLit))
            {
              extract($fila_genLit);
              echo "<option value='$id_genero_lit'>$nombre_genero_lit</option>";
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