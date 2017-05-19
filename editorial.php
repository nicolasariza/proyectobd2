<?php
include("php/conectar.php");
$link = conectar();
extract($_POST);
error_reporting(0);//para no mostrar el error por variables aun no definidas
$ins = $link -> query("INSERT INTO editorial (nombre_editorial) VALUES ('$inputEditorial')");
$query_editorial = "SELECT id_editorial, nombre_editorial FROM editorial ORDER BY id_editorial DESC LIMIT 1";
$result_editorial = mysqli_query($link, $query_editorial) or die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error()); //Query editorial

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
    <label for="inputEdi">Nombre de la editorial</label>
    <input type="text" class="form-control" id="inputEdi" name="inputEditorial" aria-describedby="nombre" placeholder="Ingrese el nombre de la editorial">
  </div>
    <label for="sl_editorial">Editorial</label>
  <div class="input-group">
    <select class="form-control" id="sl_editorial" name="inputEdit">
      <option
        <?php
            while($fila_editorial = mysqli_fetch_array($result_editorial))
            {
              extract($fila_editorial);
              echo "<option value='$id_editorial'>$nombre_editorial</option>";
            }
            ?>
      ></option>;
    </select>
</div> 
  <div class="container col-sm-4">
  <br>
    <button type="submit" class="btn btn-primary" onclick="<?php $enviarForm = TRUE; ?>">Guardar</button>
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