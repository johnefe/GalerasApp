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
                    <div class="pt-md-6 pb-md-6">
                      
                          <a href="estadisticas.php" class="btn btn-lg btn-new"><span class="fa fa-arrow-left fa-1x"></span></a>
                          
                        <div class="row">
                        <div class="col-lg-6 py-2">
                          <!--<h4 class="bd-title mt-0 titulo-1">Ventas semanales</h4>-->
                          <!-- select fecha_factura from facturas where (SELECT DATE_FORMAT(fecha_factura, "%M")) = "march";-->
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
                                               <!-- <p class="bd-lead titulo-2"><h4>$ <?php echo $ventas_totales_diarias; ?></h4></p>-->
                       
                          </div>
                          <div class="col-lg-6">
                              <!--<h4 class="bd-title mt-0 titulo-1">Ganancias semanales</h4>-->
                              <!-- <p class="bd-lead titulo-2"><h4>$ <?php echo $ganancias_diarias; ?></h4></p>-->
                          </div>
                  </div>
                
            </div>
            </div>
            <div class="col-lg-12">
            	<form class="form-horizontal" role="form" id="datos_cotizacion">
            
                <div class="form-group row">
                  
                  <div class="col-lg-11 col-md-11 col-sm-11">
                    <input type="text" class="form-control" id="q" placeholder="Escribir mes de Facturación" onkeyup='load_especificas(1);'>
                  </div>
     
                  <div class="col-lg-1 col-md-1 col-sm-1 text-left">
                    <button type="button" class="btn btn-default" onclick='load_especificas(1);'>
                      <span class="fa fa-search fa-1x" ></span></button>
                    <span id="loader"></span>
                  </div>
                  
                </div>
            
            
            
          </form>
            	
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