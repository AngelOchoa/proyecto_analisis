<?php
  include ("conexion/Conexion.php");
  //Se crea el objeto conexion
  $bd = new Conexion();
  //Se inicia la sesion o se propaga
  session_start();
  //Condicion que no deja entrar al index a menos que exista una variable de session
  if(!isset($_SESSION["id_usuario"])){
    //Redirecciona al login
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

    <title> Inicio || Venta de Autos, S.A || </title>

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
                <a class="navbar-brand" href="#"> 
                  <i class="fa fa-car"></i> 
                  -- SUBASTAS DE AUTOS ONLINE --
                   <i class="fa fa-car"></i></a>
            </div>
            <!-- Top Menu Items -->
            <?php
              //Se incluye el archivo que contiene el header
              include ("header.php");
            ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php
              //Se incluye el archivo que contiene el sidebar
              include ("sidebar.php");
            ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12" class="col-md-12" style="text-align: center;">
                        <h1 class="page-header">
                            <i class="fa fa-car"></i> 
                            <font color="blue">|| Bienvenido: </font>
                                <font face="Comic Sans MS"><font color="red"><?php echo $_SESSION["nomb_comp"]; ?></font><font color="blue"> || </font></font> 
                            <i class="fa fa-car"></i> 
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                 
                        <font face="Comic Sans MS">
                        <h3> <font color="black"><i class="fa fa-home"></i></font>--||-- INICIO --||--</h3>
                        </font>         
                            </li>
                        </ol>
                    </div>
                </div>

                <?php
                  //Se hacen los count que se mostraran en la pantalla principal
                  //Count para las subastas disponibles
                  $res_count=$bd->select("SELECT count(*) as total from subasta where estado=0");
                  $data=mysqli_fetch_array($res_count);
                  $count_sub = $data['total'];//En esta variable se guardan el total

                  //Count para productos en mi cesta
                  $res_count=$bd->select("SELECT count(*) as total from cesta where id_usuario=".$_SESSION["id_usuario"]);
                  $data=mysqli_fetch_array($res_count);
                  $count_cesta = $data['total'];//En esta variable se guardan el total

                  //Count para las subastas propias activas
                  $res_count=$bd->select("SELECT count(*) as total from subasta where estado=0 and subastador=".$_SESSION["id_usuario"]);
                  $data=mysqli_fetch_array($res_count);
                  $count_sub_act = $data['total'];//En esta variable se guardan el total

                  //Count para las subastas propias cerradas
                  $res_count=$bd->select("SELECT count(*) as total from subasta where estado=1 and subastador=".$_SESSION["id_usuario"]);
                  $data=mysqli_fetch_array($res_count);
                  $count_sub_cerr = $data['total'];//En esta variable se guardan el total
                ?>


                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-th-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $count_sub;//Aqui se imprime el total?></div>
                                        <div>TODAS LAS SUBASTAS</div>
                                    </div>
                                </div>
                            </div>
                            <a href="subastas.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver detalles</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                      <div class="huge"><?php echo $count_cesta;//Aqui se imprime el total?></div>
                                      <div>SUBASTAS GANADAS</div>
                                    </div>
                                </div>
                            </div>
                            <a href="cesta.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver detalles</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-unlock fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                      <div class="huge"><?php echo $count_sub_act;//Aqui se imprime el total?></div>
                                      <div>SUBASTAS ACTIVAS</div>
                                    </div>
                                </div>
                            </div>
                            <a href="cuenta.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver detalles</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-lock fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                      <div class="huge"><?php echo $count_sub_cerr;//Aqui se imprime el total?></div>
                                      <div>SUBASTAS TERMINADAS</div>
                                    </div>
                                </div>
                            </div>
                            <a href="cuenta.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver detalles</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <ol class="breadcrumb" style="text-align: center;">
                            <li class="active" style="text-align: center;"> 
                                <i class="fa fa-car" style="text-align: center;"></i> 
                                <i class="fa fa-car"style="text-align: center;"></i>   
                                <i class="fa fa-car"style="text-align: center;"></i>
                                <i class="fa fa-car"style="text-align: center;"></i>
                                <i class="fa fa-car"style="text-align: center;"></i>
                                <i class="fa fa-car"style="text-align: center;"></i>
                                <i class="fa fa-car" style="text-align: center;"></i> 
                                <i class="fa fa-car"style="text-align: center;"></i>   
                                <i class="fa fa-car"style="text-align: center;"></i>
                                <i class="fa fa-car"style="text-align: center;"></i>
                                <i class="fa fa-car"style="text-align: center;"></i>
                                <i class="fa fa-car"style="text-align: center;"></i>
                                <i class="fa fa-car" style="text-align: center;"></i> 
                                <i class="fa fa-car"style="text-align: center;"></i>   
                                <i class="fa fa-car"style="text-align: center;"></i>
                                <i class="fa fa-car"style="text-align: center;"></i>
                                <i class="fa fa-car"style="text-align: center;"></i>
                                <i class="fa fa-car"style="text-align: center;"></i>
                            </li>
                        </ol>
             <br><br>
                    <div style="text-align: center;">
                     <img src="img/logo.jpg" height="310">
                     <br><br>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
            <?php include("footer.php"); ?>
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
