<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="login.css">
  <title>Document</title>
</head>
<body>

  <?php
          if(isset($_POST["enviar"])){

      try{

        $base= new PDO("mysql:host=localhost; dbname=tema-1", "root", "chinat");
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql= "SELECT * FROM usuario WHERE usuario= :login and contra= :password";
        $resultado=$base->prepare($sql);
        $login=htmlentities( addslashes($_POST["login"]));
        $password=htmlentities( addslashes($_POST["password"]));
        $resultado->bindValue(":login", $login);
        $resultado->bindValue(":password", $password);
        $resultado->execute();
        $numero_registro=$resultado->rowCount();
        if($numero_registro!=0){
          session_start();
          $_SESSION["usuario"]=$_POST["login"];
        //  header("location:usuarios_registrados1.php");

        }else{
          //header("location:login.php");
          echo "Error, Usuario o contraseña incorrectos";
        }

      }catch(Exception $e){
        die("Error:" . $e->getMessage());


      }

    }
   ?>

<!-------------------Formulario---------------------->
<?php
if(!isset($_SESSION["usuario"])){
    include("formulario.php");
}else{
  echo "Usuario: " . $_SESSION["usuario"];
}



 ?>


<!-----------------------------Imagenes---------------------->
<h2>CONTENIDO WEB</h2>

<table width="800" border="0">
  <tr>
      <td><img src="imagenes/alericio2.jpg" alt="" width="300" height="166"></td>
      <td><img src="imagenes/AlericioXD.jpg" alt="" width="300" height="171"></td>
  </tr>
  <tr>
    <td><img src="imagenes/Comentarios.jpg" alt="" width="300" height="166"></td>
    <td><img src="imagenes/Conocenos.jpg" alt="" width="300" height="171"></td>
  </tr>
</table>



</body>
</html>
