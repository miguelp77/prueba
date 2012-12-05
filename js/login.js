$(document).ready(function() {
	$('button[name=validar]').click(function(){
		var alias=$('input[name=alias]').val();
		var pass=$('input[name=pass]').val();
		var checkuser = false;
		if(alias.length < 4){
			alert("Nombre de usuario no valido");
		}else checkuser = true;
		if(pass.length < 4){
			alert("Contraseña no valida");
		}else checkuser = true;
		if(checkuser){
			$.ajax({
				type: "POST",
				cache: false,
		//	url: "checkuser.php",
				url: "ruta/bak_checkuser.php",
				data: "alias=" + alias + "&pass="+pass,
				success: function(data){
					if(data) location.href ="ruta/"+data+".php";				
//				if(data) location.href =data;				
	//			$('#contenedor').append(data);//location.href ="index.php";
	//			if(data.length<1)location.href ="index.php";
				}
			});
		}//Fin del if checkuser
	
	}); //Fin de button validar
	
//Fin del document
});
