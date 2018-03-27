<?php
 
    session_start();
    if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
        exit;
        }
 /* Connect To Database*/
  require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos


    $usuario=$_SESSION['user_id']; 
    $active_estadisticas="active";
     
    $title="estadisticas | Sys-Galeras";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>

  </head>
  <body>
    <?php
    include("navbar.php");
    ?>  
    <section class="container bg-gris section-1">
        <div class="row my-5   mx-0">
            <div class="col-lg-12 my-3 ">
                    <div class="pt-md-3 pb-md-4">
                        <a href="estadisticas.php" class="btn btn-lg btn-new"><span class="fa fa-arrow-left fa-1x"></span></a>
                        <h1 class="bd-title mt-0">Ventas diarias</h1>

    <?php
          
          $select_tmp=mysqli_query($con,"SELECT * FROM facturas WHERE LEFT(fecha_factura,10)=CURDATE()");
         // $row= mysqli_fetch_array($select_tmp);
          $ventas_totales_diarias=0;
          while ($row=mysqli_fetch_array($select_tmp)){ 
            $numero_factura=$row['numero_factura'];
             $fecha_factura=$row['fecha_factura'];

             $fecha_convertida=strtotime($row['fecha_factura']);
             $ventas_totales_diarias=$ventas_totales_diarias+$row['total_venta'];
            }

    ?>                    
                        <p class="bd-lead"><h3>$ <?php echo $ventas_totales_diarias; ?></h3></p>
                      
                      
            <?php
             
           
            ?> 
                      </div>
                
            </div>

        </div>
        
    </section>
    <section class="container">
        <div class="">
            
            <div id="resultados"></div><!-- Carga los datos ajax -->
            <div class='outer_div'></div><!-- Carga los datos ajax -->
          </div>
    </section>
    <hr>
    <?php
    include("footer.php");
    ?>
    <script type="text/javascript" src="js/VentanaCentrada.js"></script>
    <script type="text/javascript" src="js/facturas.js"></script>
  </body>
</html>