<?php
 
    session_start();
    if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
        exit;
        }
  require_once ("config/db.php");
  require_once ("config/conexion.php");


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
                    <div class="pt-md-6 pb-md-6">
                      
                          <a href="estadisticas.php" class="btn btn-lg btn-new"><span class=""><img src="img/iconos/back.png"></span></a>
                          
                        <div class="row">
                        <div class="col-lg-6 py-2">
                          <h4 class="bd-title mt-0 titulo-1">Ventas diarias</h4>
                            <?php
                                  
                                  $select_tmp=mysqli_query($con,"SELECT * FROM facturas WHERE LEFT(fecha_factura,10)=CURDATE()");
                                 // $row= mysqli_fetch_array($select_tmp);
                                  $ventas_totales_diarias=0;
                                  $ventas_totales_diarias_reales=0;
                                  $ganancias_diarias=0;
                                  while ($row=mysqli_fetch_array($select_tmp)){ 
                                    $numero_factura=$row['numero_factura'];
                                     $fecha_factura=$row['fecha_factura'];
                                     $fecha_convertida=strtotime($row['fecha_factura']);
                                     $ventas_totales_diarias=$ventas_totales_diarias+$row['total_venta'];

                                     $ventas_totales_diarias_reales= $ventas_totales_diarias_reales+$row['total_compra'];
                                    }
                                    $ganancias_diarias= $ventas_totales_diarias -$ventas_totales_diarias_reales;

                            ?>                    
                                                <p class="bd-lead titulo-2"><h4>$ <?php echo $ventas_totales_diarias; ?></h4></p>
                       
                          </div>
                          <div class="col-lg-6">
                              <h4 class="bd-title mt-0 titulo-1">Ganancias diarias</h4>
                               <p class="bd-lead titulo-2"><h4>$ <?php echo $ganancias_diarias; ?></h4></p>
                          </div>
                  </div>
                
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
    <script type="text/javascript" src="js/facturas_diarias.js"></script>
  </body>
</html>