<?php
 
    session_start();
    if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
        exit;
        }
  require_once ("config/db.php");
  require_once ("config/conexion.php");


    $usuario=$_SESSION['user_id']; 
    $active_gastos="active";
     
    $title="Gastos | Sys-Galeras";
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
                      
                          <a href="gastos.php" class="btn btn-lg btn-new"><span class=""><img src="img/iconos/back.png"></span></a><br><br><br>
                           <h4 class="bd-title mt-0 titulo-1">Gastos agrupados por mes</h4>
                        <div class="row">
                        <div class="col-lg-6 py-2">
                      
                            <?php
                                  
                                  $select_tmp=mysqli_query($con,"SELECT * FROM gastos WHERE LEFT(fecha,10)=CURDATE()");
                              
                                  $ventas_totales_diarias=0;
                                  while ($row=mysqli_fetch_array($select_tmp)){ 

                                     $fecha_convertida=strtotime($row['fecha']);
                                     $ventas_totales_diarias=$ventas_totales_diarias+$row['valor_gasto'];
                                    }


                            ?>   
                          </div>
                         
                  </div>
                
            </div>
            </div>
            <div class="col-lg-12">
            	<form class="form-horizontal" role="form" id="datos_cotizacion">
            
                <div class="form-group row">
                  
                  <div class="col-lg-11 col-md-11 col-sm-11">
                    <input type="text" class="form-control" id="q" placeholder="Escribe el mes de gastos" onkeyup='load_especificas(1);'>
                  </div>
     
                  <div class="col-lg-1 col-md-1 col-sm-1 text-left">
                    <button type="button" class="btn btn-default" onclick='load_especificas(1);'>
                      <span class="" ><img src="img/iconos/search.png" style="width: 90%;height: 90%;"></span></button>
                    <span id="loader"></span>
                  </div>
                  
                </div>
            
            
            
          </form>
            	
            </div>

        </div>
        
    </section>
    <section class="container">
        <div class="">
            <div id="resultados"></div>
            <div class='outer_div'></div>
          </div>
    </section>
    <hr>
    <?php
    include("footer.php");
    ?>
    <script type="text/javascript" src="js/VentanaCentrada.js"></script>
    <script type="text/javascript" src="js/gastos_mensuales.js"></script>
  </body>
</html>