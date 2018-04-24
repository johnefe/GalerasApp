  <?php
  $usuario=$_SESSION['user_id']; 
    if (isset($title))
    {

  ?> 
    <header>
      <nav class="navbar navbar-expand-md navbar-purple fixed-top bg-purple">
        <a class="navbar-brand" href="facturas.php">SYS-GALERAS</a>
        <button class="navbar-toggler icon-menu" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="fa fa-bars fa-1x"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo $active_facturas;?>">
              <a class="nav-link" href="facturas.php">Ventas <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php echo $active_compras;?>">
              <a class="nav-link" href="compras.php">Compras</a>
            </li>
            <li class="nav-item <?php echo $active_productos;?>">
              <a class="nav-link" href="productos.php">productos</a>
            </li>
            <li class="nav-item <?php echo $active_proveedores;?>">
              <a class="nav-link" href="proveedores.php">Proveedores</a>
            </li>
            <li class="nav-item <?php echo $active_clientes;?>">
              <a class="nav-link" href="clientes.php">Clientes</a>
            </li>
              <?php if($usuario==1){ ?>
            <li class="nav-item <?php echo $active_estadisticas;?>">
              <a class="nav-link" href="estadisticas.php">Estadísticas</a>
            </li>
             <?php  } ?>
            <li class="nav-item <?php echo $active_gastos;?>">
              <a class="nav-link" href="gastos.php">Gastos</a>
            </li>
            <?php if($usuario==1){ ?>
            <li class="nav-item <?php echo $active_activos;?>">
              <a class="nav-link" href="activos.php">Activos</a>
            </li>
             <?php  } ?>
            <?php if($usuario==1){ ?>
            <li class="nav-item <?php echo $active_usuarios;?>">
              <a class="nav-link" href="usuarios.php">Usuario</a>
            </li>
            <?php  } ?>
             <?php if($usuario==1){ ?>
            <li class="nav-item <?php echo $active_perfil;?>">
              <a class="nav-link" href="perfil.php">Mi perfil</a>
            </li>
            <?php  } ?>
                     
           
          </ul>
           <form class="form-inline my-2 my-lg-0">
         
            <a class="btn btn-logout cerrar my-2 my-sm-0" href="login.php?logout">Cerrar sesión</a>
          
          </form>
        </div>
      </nav>

    </header>
<?php  
 }

?>
   