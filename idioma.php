<?php
include("php/conectar.php");
$link = conectar();
extract($_POST);
error_reporting(0);//para no mostrar el error por variables aun no definidas
if ('$inputIdioma' != "") {
$ins = $link -> query("INSERT INTO idioma (id_idioma, nombre_idioma) VALUES ('','$inputIdioma')");
}
$query_idioma = "SELECT id_idioma, nombre_idioma FROM idioma ORDER BY id_idioma DESC LIMIT 1";
$result_idioma = mysqli_query($link, $query_idioma) or die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error()); //Query editorial

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
    <label for="inputIdioma">Nombre del idioma</label>
    <input type="text" class="form-control" id="inputIdioma" name="inputIdioma" aria-describedby="nombre" placeholder="Ingrese el idioma">
  </div>
     <label for="sl_idioma">Idioma</label>
  <div class="input-group">
    <select class="form-control" id="sl_idioma" name="selectIdioma">
      <option
              <?php
            while($fila_idioma = mysqli_fetch_array($result_idioma))
            {
              extract($fila_idioma);
              echo "<option value='$id_idioma'>$nombre_idioma</option>";
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