<?php
  include ("conexion/Conexion.php");
  $bd = new Conexion();
  session_start();
  if(isset($_SESSION["id_usuario"])){
    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Nuevo Usuario || Venta de Autos, S.A</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="img/lodoa.png">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" 
    rel="stylesheet" type="text/css">
</head>

<body>

    <?php
      if(isset($_POST["registro"])){

        $correo = $_POST["correo"];
        $user = $_POST["user"];
        $pass = $_POST["pass"];

        $query = "INSERT into usuario(correo, user, pass) 
              values('$correo','$user','$pass');";

        $result = $bd->query($query);

        if($result == true){
          echo "<script>alert('Te has registrado con exito!');</script>";
          //header("Location: login.php");
        }else{
          echo "<script>alert('No hemos podido registrate, intenta nuevamente');</script>";
        }

      }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-12" style="text-align: center;"> 
                          <h3> <i class="fa fa-car"></i> VENTA DE AUTOS, S.A <i class="fa fa-car"></i></h3>
                        </div>
                        <div class="col-md-12">
                          <div style="text-align: center;">
                          <img src="img/logo.jpg" height="230">
                        </div>
                          <h3><div style="text-align: center; " ><font color="red"><i class="fa fa-plus"></i></font>  
                          INGRESA TUS DATOS PARA REGISTRARTE</h3>      
                        </div>
                      </div>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div  class="form-group"><i class="fa fa-user"></i>
                                      <input class="form-control" placeholder="Usuario" name="user" type="text" autofocus required="" >
                                </div>

                                <div class="form-group"> <i class="fa fa-lock"></i>
                                    <input class="form-control" placeholder="Contraseña" name="pass" type="password" required="">
                                </div>

                                <div class="form-group"> <i class="fa fa-inbox"></i>
                                    <input class="form-control" placeholder="Correo" name="correo" type="email"  required>
                                </div>
                                <input type="submit" name="registro" class="btn btn-success btn-block" value="Registrarse">

                           </fieldset>
                       
                        </form>

                    </div>
                         <br>
                             <div style="text-align: center;">
                     <img src="img/umglogo.jpg" height="130"></div> 
                    <div class="panel-footer">
                      <p><font color="maroon"><i class="fa fa-user"></i></font> ¿Ya estas registrado? <a href="login.php"> || Inicia Sesión aqui</a></p>
                    </div>
                </div>
            </div>
        </div> 
        <?php include("footer.php") ?>
    </div> 

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
