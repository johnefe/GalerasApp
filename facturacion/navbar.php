  <?php
    if (isset($title))
    {
  ?> 
    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-purple fixed-top bg-purple">
        <a class="navbar-brand" href="#">SYS-GALERAS</a>
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
            <li class="nav-item dropdown ">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Configuraciones</a>
              <div class="dropdown-menu bg-purple sub-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item <?php echo $active_proveedores;?>" href="proveedores.php">Proveedores</a>
                <a class="dropdown-item <?php echo $active_clientes;?>" href="clientes.php">Clientes</a>
                <a class="dropdown-item" href="perfil.php">Mi perfil</a>
                <a class="dropdown-item" href="usuarios.php">Usuarios</a>
                <a class="dropdown-item" href="#">Soporte</a>
              </div>
            </li>           
           
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
   