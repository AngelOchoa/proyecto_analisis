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

    <title>NUEVO VEHICULO A SUBASTAR</title>

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

      //Variables que se guardaran en la tabla producto
      $nombre = $_POST["nombre"];
      $descripcion = $_POST["descripcion"];
      $categoria = $_POST["categoria"];
      $foto = $_FILES["foto"]["name"];//nombre de la imagen del producto
      $ruta = $_FILES["foto"]["tmp_name"];//ruta de la imagen del producto

      //Variables que se guardaran en la tabla subasta
      $p_minimo = $_POST["minimo"];
      $p_maximo = $_POST["maximo"];
      $fecha_hora_actual = date("Y-m-d H:i:s");
      $fecha_fin = $_POST["fecha_fin"];//Esto no se insertara en la tabla
      $hora_fin = $_POST["hora_fin"];//Esto no se insertara en la tabla
      $fecha_hora_fin = "$fecha_fin $hora_fin:00";
      $estado = 0;//1 = vendida && 0 = disponible
      $subastador = $_SESSION["id_usuario"];
    if($foto == null){

        $res = $bd->query("INSERT into producto(nombre, descripcion, imagen, id_categoria)
                            values('$nombre','$descripcion','default.jpg',$categoria);");

        if($res==true){
          echo "<script>alert('Vehiculo agregado correctamente');</script>";
          $id_producto = $bd->insert_id();

          $res2 = $bd->query("INSERT into subasta(min, max, tiempo_ini, tiempo_fin, estado, subastador, id_producto)
                              values($p_minimo,$p_maximo,'$fecha_hora_actual','$fecha_hora_fin',$estado,$subastador,$id_producto);");

          if($res2==true){
            echo "<script>alert('Se ha agredo el Vehiculo a Subastar');</script>";
          }else{
            echo "<script>alert('No se pudo agregar subasta');</script>";
          }
        }else{
          echo "<script>alert('No se pudo agregar el vehiculo ni la subasta');</script>";
        }

      }else{

        $dest = "images/productos/";
        copy($ruta,$dest.''.$foto);

        $res = $bd->query("INSERT into producto(nombre, descripcion, imagen, id_categoria)
                            values('$nombre','$descripcion','$foto',$categoria);");

        if($res==true){
          echo "<script>alert('Vehiculo agregado correctamente');</script>";
          $id_producto = $bd->insert_id();

          $res2 = $bd->query("INSERT into subasta(min, max, tiempo_ini, tiempo_fin, estado, subastador, id_producto)
                              values($p_minimo,$p_maximo,'$fecha_hora_actual','$fecha_hora_fin',$estado,$subastador,$id_producto);");

          if($res2==true){
            echo "<script>alert('Se ha agredo el Vehiculo a Subastar');</script>";
          }else{
            echo "<script>alert('No se pudo agregar subasta');</script>";
          }
        }else{
          echo "<script>alert('No se pudo agregar el vehiculo ni la nueva subasta');</script>";
        }
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
                           <i class="fa fa-plus"></i> NUEVA SUBASTA || <small> AGREGAR NUEVO VEHICULO <i class="fa fa-car"></i></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i> <a href="index.php">Inicio</a> 
                            </li>
                            <li class="active">
                                <i class="fa fa-plus"></i> NUEVO VEHICULO A SUBASTAR
                            </li>
                        </ol>
                    </div>
                </div>

                      <div class="row">

                        <form role="form" action="" method="post" enctype="multipart/form-data">

                          <div class="col-lg-6">

                                <h3><i class="fa fa-car"></i> DETALLE VEHICULO </h3>

                                  <div class="form-group">
                                      <label>MARCA</label>
                                      <input type="text" name="nombre" class="form-control" required>
                                  </div>

                                  <div class="form-group">
                                      <label>DESCRIPCION</label>
                                      <textarea name="descripcion" class="form-control" required></textarea>
                                  </div>

                                  <div class="form-group">
                                      <label>TIPO</label>
                                      <select class="form-control" name="categoria">
                                          <?php
                                            $res = $bd->select("SELECT * from categoria");
                                            if($res->num_rows > 0){
                                              while($row = $res->fetch_assoc()){
                                                echo "<option value='".$row["id_categoria"]."'>".$row["categoria"]."</option>";
                                              }
                                            }else{
                                              echo "<option value='s/c'>Agrega uno desde tu panel lateral</option>";
                                            }
                                          ?>
                                      </select>
                                      <p class="text-info"> * Si no esta el tipo de vehiculo que busca puede agregar una desde el panel lateral.</p>
                                  </div>

                                  <div class="form-group">
                                      <label>FOTO</label>
                                      <input type="file" name="foto">
                                      
                                  </div>

                        </div>
                        <div class="col-lg-6">

                              <h3> <i class="fa fa-info-circle"></i> DETALLE SUBASTA</h3>

                                  <div class="form-group">
                                      <label>PRECIO MINIMO</label>
                                      <input type="number" name="minimo" class="form-control">
                                  </div>

                                  <div class="form-group">
                                      <label>PRECIO MAXIMO</label>
                                      <input type="number" name="maximo" class="form-control"  required>
                                  </div>

                                  <div class="form-group">
                                      <label>FECHA DE CIERRE</label>
                                      <input type="date" name="fecha_fin" class="form-control" required>
                                  </div>

                                  <div class="form-group">
                                      <label>HORA DE CIERRE DE SUBASTA</label>
                                      <input type="time" name="hora_fin" class="form-control" required>
                                  </div>

                                  <br>

                                  <button name="agregar" type="submit" class="btn btn-success">AGREGAR</button>
                                  <button type="reset" class="btn btn-danger">CANCELAR</button>

                          </div>

                        </form>

                      </div>
                      <!-- /.row -->
                  <br>

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
