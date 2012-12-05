<?php
  require_once('includes/misfunciones.php');
?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
      <script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
      	<script src="jquery/jquery.hoveraccordion.min.js" type="text/javascript"></script>
	<script src="jquery/jquery.timers.js" type="text/javascript"></script>
	<!--<script src="jquery/jquery.url.js" type="text/javascript"></script> -->
	<script src="jquery/jquery.url_toolbox.js" type="text/javascript"></script>

      	<script src="includes/scripts.js" type="text/javascript"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php

echo Conectar();

?>
      <form style="width: 400px" class="loginForm">
        <legend> Acceso </legend>
        <div class="campos" >
          <input type="text" id="loginUser" name="loginUser" autocomplete="off" ><label> Nombre </label> <br />
          <input type="password" id="loginPsw" name="loginPsw"><label> Contraseña</label><br />
          <span class="little" style="font-size: xx-small">Contacte con el profesor</span><br />
          <span class="css_button"><a href="#" name="loginBtt">Ir</a></span>
         </div>
      </form>
    </body>
</html>
