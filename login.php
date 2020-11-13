<?php
  include ("conexion/Conexion.php");
  $bd = new Conexion();
  session_start();
  if(isset($_SESSION["id_usuario"])){
      echo "<script>window.location.href = 'index.php'; </script>"; 
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

    <title>Bienvenido || Venta de Autos, S.A</title>

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
      if(isset($_POST["entrar"])){

        $user = $_POST["user"];
        $pass = $_POST["pass"];

        $query = "SELECT * from usuario where user='$user' and pass='$pass';";

        $result = $bd->select($query);

        if($result->num_rows > 0){

          while($row = $result->fetch_assoc()){
            $id_us = $row["id_usuario"];
            $nombre = $row["nombre"];
            $paterno = $row["paterno"];

          }

          $_SESSION["id_usuario"] = $id_us;
          $_SESSION["nomb_comp"] = $nombre." ".$paterno;
           echo "<script>window.location.href = 'index.php'; </script>"; 
        }else{
          echo "<script>alert('DATOS INCORRECTOS.!');</script>";
          echo "<script>window.location.href = 'login.php'; </script>"; 
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
                          <br>
                        <img src="img/logo.jpg" height="230">
                        </div>
                          <h3><div style="text-align: center;"> <i class="fa fa-user"></i>
                          INGRESA TUS DATOS PARA INICIAR SESIÓN</h3>
                        </div>
                      </div>

                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>

                                <div class="form-group"> <i class="fa fa-user"></i>
                                    <input class="form-control" placeholder="Usuario" name="user" type="text" autofocus required>
                                </div>

                                <div class="form-group"> <i class="fa fa-lock"></i>
                                    <input class="form-control" placeholder="Contraseña" name="pass" type="password" required>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me"> Recordarme
                                    </label>
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="entrar" class="btn btn-primary btn-block" value="Entrar">

                            </fieldset>
                        </form>
                    </div>
                    <div class="panel-footer" style="text-align: center;">
                      <p><font color="black"><i class="fa fa-check"></i></font>  Eres ¡NUEVO! <a href="registro.php"> || <font color="maroon"><i class="fa fa-plus"></i></font> Registrate Aquí ||</a></p>
                    </div>
                </div>
            </div>
        </div>
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