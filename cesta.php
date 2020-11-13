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

    <title>MIS COMPRAS || Ventas de Autos, S.A</title>

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
                  <i class="fa fa-car"></i> BIENVENIDO || Subastas Online <i class="fa fa-car"></i></a>
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
                        <h1 class="page-header"> <i class="fa fa-shopping-cart"></i>
                            MI CARRITO || <i class="fa fa-car"></i><small> Vehiculos Adquiridos</small>
                        </h1>
                        <ol class="breadcrumb">
                          <li>
                              <i class="fa fa-home"></i> <a href="index.php"></i> Inicio</a>
                          </li>
                          <li class="active">
                              <i class="fa fa-shopping-cart"></i> Mi Carrito
                          </li>
                        </ol>
                    </div>
                </div>
<br>
                <!-- Listado de subastas -->
                <div class="row">
                  <div class="col-lg-12">
                    <div class="col-lg-12">  <div style="text-align: center;">
                      <h3> <i class="fa fa-car"></i> SUBASTAS GANADAS <i class="fa fa-car"></i></h3></div>
                      <br><br><br>
                   

                    <div class="table-responsive">
                        <table class="table table-hover"> <br>

                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Marca</th>
                                    <th>Descripción</th>
                                    <th>Tipo</th>
                                    <th>Valor Minimo</th>
                                    <th>Valor Maximo</th>
                                    <th>Total Pagado Q.</th>
                                </tr>
                            </thead>
                            <tbody>


                  <?php
                      //Inicia consulta de cestas
                      $res0 = $bd->select("SELECT * from cesta where id_usuario=".$_SESSION["id_usuario"].";");
                      if($res0->num_rows > 0){
                        while($row0 = $res0->fetch_assoc()){
                          $cesta = $row0["id_cesta"];
                          $sub = $row0["id_subasta"];

                          //Inicia consulta de subastas
                          $res = $bd->select("SELECT * from subasta where id_subasta=$sub order by id_subasta desc");
                          if($res->num_rows > 0){
                            while($row = $res->fetch_assoc()){
                              $min = $row["min"];
                              $max = $row["max"];
                              $ini = $row["tiempo_ini"];
                              $fin = $row["tiempo_fin"];
                              $id_producto = $row["id_producto"];

                              //Inicia consulta de producto de las subastas
                              $res2 = $bd->select("SELECT * from producto where id_producto=$id_producto");
                              if($res2->num_rows > 0){
                                while($row2 = $res2->fetch_assoc()){
                                  $nombre_p = $row2["nombre"];
                                  $descri_p = $row2["descripcion"];
                                  $imagen_p = $row2["imagen"];
                                  $catego_p = $row2["id_categoria"];

                                  //Inicia consulta de categoria del producto
                                  $result = $bd->select("SELECT * from categoria where id_categoria=$catego_p");
                                  $categoria_arr = mysqli_fetch_array($result);
                                  $categoria = $categoria_arr["categoria"];

                                  //Inicia consulta de categoria del producto
                                  $result1 = $bd->select("SELECT * from oferta where id_subasta=$sub order by id_oferta desc limit 1");
                                  $oferta = mysqli_fetch_array($result1);
                                  $of_final = $oferta["oferta"];

                                  ?>


                                      <tr>
                                          <td width="180px"><center><img src="<?php echo "images/productos/$imagen_p";?>" style="height: 80px;"></center></td>
                                          <td><?php echo "<b class='text-success'>$nombre_p</b>";?></td>
                                          <td><?php echo "<p class='text-info'>$descri_p</p>";?></td>
                                          <td><?php echo "$categoria";?></td>
                                          <td><?php echo "Q$min.00";?></td>
                                          <td><?php echo "Q$max.00";?></td>
                                          <td><?php echo "<b class='text-danger'>Q$of_final.00</b>";?></td>
                                      </tr>


                                  <?php


                                }
                              }
                            }
                          }


                        }
                      }else{
                        echo "<h3> CARRITO VACIO, NO HAS GANADO NINGUNA SUBASTA, BUSCA UNA DISPONIBLE....</h3>"; 
                      }
                      //Termina consulta de subastas

                  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
              <!-- Fin de listado -->

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
