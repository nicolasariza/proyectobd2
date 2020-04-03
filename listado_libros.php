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
$result_per = mysqli_query($link, $query_per) ;
$datosPersona = mysqli_fetch_array($result_per);
extract($datosPersona);
$condicion_autor ="";
$condicion_editorial ="";
$condicion_genero_literario ="";
$condicion_idioma = "";
$condicion_titulo = "";

if(isset($sl_autor))
{
		if($sl_autor!=0)
			$condicion_autor = " and a.id_autor = $sl_autor";		
}


if(isset($sl_editorial))
{
		if($sl_editorial!=0)
			$condicion_editorial = " and e.id_editorial = '$sl_editorial'";

}
if(isset($sl_genero_lit))
{
		if($sl_genero_lit!=0)
			$condicion_genero_literario = " and g.id_genero_lit = $sl_genero_lit";		
}

if(isset($sl_idioma))
{
		if($sl_idioma!=0)
			$condicion_idioma = " and i.id_idioma = $sl_idioma";		
}

if(isset($sl_titulo))
{
	echo $sl_titulo;
		if($sl_titulo!="")
			$condicion_titulo = " and titulo like '%$sl_titulo%'";

}

$query_filtro = "select l.titulo as Titulo, a.nombre_autor as Autor, e.nombre_editorial as Editorial, g.nombre_genero_lit as Genero_Literario, l.edicion, i.nombre_idioma as Idioma
from libro l, autor a, editorial e, genero_lit g, idioma i 
where 
			l.id_autor_fk = a.id_autor and 
			l.id_editorial_fk = e.id_editorial and
			l.id_genero_lit_fk = g.id_genero_lit and
			l.id_idioma_fk =  i.id_idioma";
 $query_completa = $query_filtro.$condicion_autor.$condicion_editorial.$condicion_genero_literario.$condicion_idioma.$condicion_titulo;			
$result_lista = mysqli_query($link, $query_completa);


$query_autor = "select id_autor, nombre_autor from autor";
$result_autor = mysqli_query($link, $query_autor);

$query_editorial = "select id_editorial, nombre_editorial from editorial";
$result_editorial = mysqli_query($link, $query_editorial);

$query_genero_lit = "select g.id_genero_lit, g.nombre_genero_lit from
	genero_lit g";
$result_genero_lit = mysqli_query($link, $query_genero_lit);	

$query_idioma = "select i.id_idioma, i.nombre_idioma from idioma i";	
$result_idioma = mysqli_query($link, $query_idioma);

$query_titulo = "select id_libro, titulo from libro";

$result_titulo = mysqli_query($link, $query_titulo);
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Biblioteca personas</title> 
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
      <li class="nav-item"><!--el badge-deafult es para resaltar el texto inicio-->
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
      <li class="nav-item active badge-default">
        <a class="nav-link" href="http://localhost/proyectobd2/listado_libros.php"><i class="fa fa-file-text" aria-hidden="true"></i>     Listado de libros</a>
      </li>
    </ul>
  </div>
  </div>
   <h1 class="navbar-brand mb-0">Bienvenido/a <?php echo "$nombre $apellido";  ?></h1>
</nav>
      </header>
</form>
	<form action="" method="post" class="form-group">
		<table width="70%" align="center" border='1'>
			<tr>
				<th colspan="2">
					Filtro
				</th>		
			</tr>
			<tr>
				<td align="right">
					Título:
				</td>
				<td>
					<input type="text" name="sl_titulo" id="sl_titulo">
				</td>
			</tr>
			<tr>
			<tr>
				<td align="right">
					Autor:
				</td>
				<td>
					<select id="sl_autor" name="sl_autor">
						<option value='0'>.:Seleccione:.</option>;
						<?php
						
						while($fila_autor = mysqli_fetch_array($result_autor))
						{
							extract($fila_autor);
							echo "<option value='$id_autor'>$nombre_autor</option>";
									
						}					
						?>
					<select/>
				</td>
			</tr>
			<tr>
				<td align="right">
					Editorial:
				</td>
				<td>
					<select id="sl_editorial" name="sl_editorial">
						<option value='0'>.:Seleccione:.</option>
						<?php						
						while($fila_editorial = mysqli_fetch_array($result_editorial))
						{
							extract($fila_editorial);
							echo "<option value='$id_editorial'>$nombre_editorial</option>";									
						}					
						?>
					<select/>
				</td>
			</tr>
			<tr>
				<td align="right">
					Género literario:
				</td>
				<td>
					<select id="sl_genero_lit" name="sl_genero_lit">
						<option value='0'>.:Seleccione:.</option>
						<?php						
						while($fila_genero_lit = mysqli_fetch_array($result_genero_lit))
						{
							extract($fila_genero_lit);
							echo "<option value='$id_genero_lit'>$nombre_genero_lit</option>";									
						}					
						?>
					<select/>
				</td>
			</tr>	
			<tr>
				<td align="right">
					Idioma:
				</td>
				<td>
					<select id="sl_idioma" name="sl_idioma">
						<option value='0'>.:Seleccione:.</option>
						<?php						
						while($fila_idioma = mysqli_fetch_array($result_idioma))
						{
							extract($fila_idioma);
							echo "<option value='$id_idioma'>$nombre_idioma</option>";									
						}					
						?>
					<select/>
				</td>
			</tr>				
			<tr>
				<td >			
				</td>
				<td>
					<input type="submit" id="btn_filtro" name="btn_filtro" value="Buscar"/>
					<input type="button" value="Listado de libros" onclick="window.open('http://localhost/BasesDeDatosUDEC/inicioBiblioteca.html')" />
				</td>
			</tr>
		</table>
	</form>

	<table width="90%" align="center" border='1' class="table table-striped table-inverse">
		<tr>
			<th colspan="7">
				LISTADO DE LIBROS
			</th>		
		</tr>
		<tr>
			<th>Titulo</th>
			<th>Autor</th>
			<th>Editorial</th>
			<th>Género literario</th>
			<th>Año</th>
			<th>Edicion</th>
			<th>Idioma</th>
		</tr>
		<?php
		while($fila_listado = mysqli_fetch_array($result_lista))
		{
			extract($fila_listado);
			echo "
				<tr>
					<td>$Titulo</td>
					<td>$Autor</td>
					<td>$Editorial</td>
					<td>$Genero_Literario</td>
					<td>$anio</td>
					<td>$edicion</td>
					<td>$Idioma</td>
				</tr>";	
		}
		
		?>
	</table>

</body>

</html>
