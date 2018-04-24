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
     
    $title="gastos | Sys-Galeras";
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
                      
                          <a href="gastos.php" class="btn btn-lg btn-new"><span class=""><img src="img/iconos/back.png"></span></a>
                          
                        <div class="row">
                        <div class="col-lg-6 py-2">
                          <h4 class="bd-title mt-0 titulo-1">Gastos diarios</h4>
                            <?php
                                  
                                  $select_tmp=mysqli_query($con,"SELECT * FROM gastos WHERE LEFT(fecha,10)=CURDATE()");
                                  $gasto_total=0;
                            
                                  while ($row=mysqli_fetch_array($select_tmp)){ 
                                     $fecha_factura=$row['fecha'];
                                     $fecha_convertida=strtotime($row['fecha']);
                                     $gasto_total=$gasto_total+$row['valor_gasto'];

                                    }
                                  

                            ?>                    
                              <p class="bd-lead titulo-2"><h4>$ <?php echo $gasto_total; ?></h4></p>
                       
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
    <script type="text/javascript" src="js/gastos_diarios.js"></script>
  </body>
</html>