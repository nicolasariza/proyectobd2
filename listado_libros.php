<?php
include("php/conectar.php");
$link = conectar();
extract($_POST);
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

$query_filtro = "select l.titulo as Titulo, a.nombre_autor as Autor, e.nombre_editorial as Editorial, g.nombre_genero_lit as Genero_Literario, l.anio, l.edicion, i.nombre_idioma as Idioma
from libro l, autor a, editorial e, genero_lit g, idioma i 
where 
			l.id_autor_fk = a.id_autor and 
			l.id_editorial_fk = e.id_editorial and
			l.id_genero_lit_fk = g.id_genero_lit and
			l.id_idioma_fk =  i.id_idioma";
 $query_completa = $query_filtro.$condicion_autor.$condicion_editorial.$condicion_genero_literario.$condicion_idioma.$condicion_titulo;			
$result_lista = mysqli_query($link, $query_completa) or die('Error de Conexión, el error está acá (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());


$query_autor = "select id_autor, nombre_autor from autor";
$result_autor = mysqli_query($link, $query_autor) or die('Error de Conexión (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());

$query_editorial = "select id_editorial, nombre_editorial from editorial";
$result_editorial = mysqli_query($link, $query_editorial) or die('Error de Conexión (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());

$query_genero_lit = "select g.id_genero_lit, g.nombre_genero_lit from
	genero_lit g";
$result_genero_lit = mysqli_query($link, $query_genero_lit) or die('Error de Conexión (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());	

$query_idioma = "select i.id_idioma, i.nombre_idioma from idioma i";	
$result_idioma = mysqli_query($link, $query_idioma) or die('Error de Conexión (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());

$query_titulo = "select id_libro, titulo from libro";

$result_titulo = mysqli_query($link, $query_titulo) or die('Error de Conexión (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Biblioteca personas</title> 
	<style>
body {
    background-color: lightblue;
}
h1 {
    text-align: center;
    text-transform: uppercase;
    color: #003399;
}
th {
	color: #003399;
}

td {
	color: #1a1a1a;
}
input[type=text], select {
    width: 100%;
    padding: 2px 8px;
    margin: 8px 0px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}
input[type=submit] {
    width: 10%;
    background-color: #4CAF50;
    color: white;
    padding: 4px 10px;
    margin: 10px 0px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
input[type=button] {
    width: 25%;
    background-color: #4CAF50;
    color: white;
    padding: 4px 10px;
    margin: 10px 0px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
</style>
</head>
<body>
</form>
	<form action="" method="post">
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

	<table width="90%" align="center" border='1'>
		<tr>
			<th colspan="7">
				LISTADO DE PERSONAS
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
