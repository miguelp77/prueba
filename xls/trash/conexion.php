<?php
/*
 *      conexion.php
 *      
 *      Copyright 2010 Miguel Paniagua <miguel@miguel-laptop>
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="es">

<head>
	<title>Seleccionar BBDD.</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18" />
</head>

<body>

<!--
<form name="form1" method="post" action="Portada.php">
<div align="center">
<table width="500" border="0">
  <tr>
    <td width="250"><div align="right">De que dia desea ver las noticias </div></td>
    <td width="200"><input type="text" name="dia_"></td>
	<tr>
	<td width="250"><div align="right"></div></td>
    <td width="200"><input name="Fecha" type="submit" value="Enviar"></td>
  </tr>
  </tr>
</table>
</form>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
-->


<?php
define( 'NL', "\n" );
define( 'TB', '  ' );


	$conectar=@mysql_connect("localhost", "root", "p89er");
		if(!$conectar){
			echo "nOK";
	//		exit();
		}
	if($conectar)
		{
			echo"Base de datos ";
		}
	$result = mysql_list_dbs( $conectar );
//$seleccionar_bdatos=@mysql_select_db("administracion");


/*		if (!$seleccionar_bdatos){
						echo("ERROR, No se ha podido acceder a la base de datos en este momento. Inténtelo más tarde");
						return FALSE;
		}*/
		
echo "<form>";	
while( $row = mysql_fetch_object( $result ) ):
   echo TB.'<li>'.$row->Database.'</li>'.NL;
//echo "<select>";
//  echo .'<option value="$row->Database">'.$row->Database.'</option>'.;
//echo </select>	;
//echo <input type="radio" name="selected_db"/>Database</br>;
endwhile;
echo "</form>"; 
/*
//	echo "<form action='".$_SERVER['PHP_SELF']."'>"; 
	$menu="<select NAME='selected_db' SIZE=1 >\n<option selected>Selecciona:</option>";

while( $row = mysql_fetch_object( $result ) )

{
$menu.="\n<option name='eq' value='".$row->Database[0]."'>".$row->Database."</option>";
}

$menu.="\n</select>";

echo $menu;
//echo "<input type="submit" value="Crear imagen" />"; 
echo "</form>"; */
mysql_free_result( $result );
mysql_close( $conectar );    

?>

<input type="submit" value="Crear imagen" />

<?php 
	$resp = $_POST['eq'];
	echo $resp;?>
</body>
</html>
