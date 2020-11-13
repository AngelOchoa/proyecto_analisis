<?php
  include ("conexion/Conexion.php");
  $bd = new Conexion();
  session_start();
  if(!isset($_SESSION["id_usuario"])){
    header("Location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NUEVO TIPO DE VEHICULO</title>

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

    if(isset($_POST["agregar"])){

      $categoria = $_POST["categoria"];
      $descripcion = $_POST["descripcion"];

      $res = $bd->query("INSERT into categoria(categoria, descripcion) values('$categoria','$descripcion');");

      if($res==true){
        echo "<script>alert('Tipo de vehiculo agregado correctamente');</script>";
      }else{
        echo "<script>alert('No se pudo agregar tipo de vehiculo');</script>";
      }

    }

  ?>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                 <a class="navbar-brand" href="index.php"> 
                  <i class="fa fa-car"> </i> BIENVENIDO || Subastas Online <i class="fa fa-car"></i></a>
            </div>
            <!-- Top Menu Items -->
            <?php
              include ("header.php");
            ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php
              include ("sidebar.php");
            ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          <i class="fa fa-tag"></i>TIPO | <small> AGREGAR NUEVO TIPO DE VEHICULO <i class="fa fa-car"></i> </small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i> <a href="index.php"> Inicio </a>
                            </li>
                            <li class="active">
                                <i class="fa fa-tag"></i> NUEVO TIPO DE VEHICULO  
                            </li>
                        </ol>
                    </div>
                </div>

                      <div class="row">

                          <div class="col-lg-6">

                            <form role="form" action="" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label>TIPO</label>
                                    <input type="text" name="categoria" class="form-control" required>
                                </div>

                                  <div class="form-group">
                                      <label>DESCRIPCION</label>
                                      <textarea name="descripcion" class="form-control" required></textarea>
                                  </div>

                                  <button name="agregar" type="submit" class="btn btn-success">Agregar</button>
                                  <button type="reset" class="btn btn-danger">Cancelar</button>

                                  <br><br><br><br>

                                </form>
                          </div>

                      </div>
                      <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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