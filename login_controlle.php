<?php
include ("conexion/Conexion.php");
  $bd = new Conexion();
  session_start();

 if(isset($_POST["entrar"])){

        $user = $_POST["user"];
        $pass = $_POST["pass"];

       // var_dump($user,$pass);
        //exit(0);

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
          header("Location: index.php");
        }else{
          echo "<script>alert('DATOS INCORRECTOS.!');</script>";
          echo "<script>window.location.href = 'login.php'; </script>"; 
        }

      }
 ?>