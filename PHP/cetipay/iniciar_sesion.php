<?php
include 'conexion.php';

$tiempo=time();
				if (isset($_POST['correo']) && isset($_POST['contrasena'])){

					$mail=$_POST["correo"];
					$pass=$_POST["contrasena"];
					$consulta = mysqli_query($conexion,'SELECT * FROM usuario where Correo="'.$mail.'" && Contrasena="'.$pass.'"')
          or die("Fallo la consulta");

          $nfilas=mysqli_num_rows($consulta);
          $Fila=mysqli_fetch_array($consulta);


						if ($nfilas==1){
						  if( ( (($tiempo-$Fila["Ultima_Conexion"]) / 60 % 60) <5) ||(($tiempo-$Fila["Ultima_Conexion"]) / 60 % 60)==0){
                   							echo'{"success":false,"mensaje":"ACTIVA"}';
                   }else{
							
							$_SESSION['CorreoPay']= $mail;
							$_SESSION['NombrePay']=$Fila['Nombre'];
							$_SESSION['ApellidoPay']=$Fila['Apellido'];
							$_SESSION['IDPay']=$Fila['PK_usuarios'];
							$consulta = mysqli_query($conexion,'UPDATE usuario set Ultima_Conexion='.$tiempo.' where Correo="'.$_SESSION['CorreoPay'].'"')
									  or die("Fallo la consulta3");
							echo'{"success":true}';
							}
						}else{
							echo'{"success":false}';
						}

				}else{
					echo "Por favor, llena todos los campos.";
				}


mysqli_close($conexion);

?>
