 <!-- BEGIN SIDEBAR -->
 <div class="page-sidebar" id="main-menu">
   <!-- BEGIN MINI-PROFILE -->
   <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
     <div class="user-info-wrapper">
       <div class="profile-wrapper" style="border:solid #fff 1px;">
         <img src="./img/admin.png" alt="" data-src="./img/admin.png" data-src-retina="./img/admin.png" class="side-user-img" />
       </div>
       <div class="user-info">
         <div class="greeting">Bienvenid@</div>
         <div class="username" style="font-size:20px;"><?php echo $_SESSION['alogin']; ?></div>

       </div>
     </div>
     <!-- END MINI-PROFILE -->
     <!-- BEGIN SIDEBAR MENU -->
     <p class="menu-title">Opciones <span class="pull-right"><a href="#" onclick="location.reload()"><i class="fa fa-refresh"></i></a></span></p>

     <ul>
        <?php if ($_SESSION['area'] === 'TI' || $_SESSION['area'] === 'DIRECCION') : ?>
          <li class="start"> <a href="home.php"> <i class="icon-custom-home"></i> <span class="title">Dashboard</span> </a>
       </li>
       <li><a href="manage-tickets.php"><span class="fa fa-ticket"></span> Gestionar Ticket</a></li>
       <li><a href="manage-tickets-COMPRAS.php"><span class="fa fa-ticket"></span> Compras</a></li>
       <li><a href="manage-tickets-CRM.php"><span class="fa fa-ticket"></span> ERP SILVA</a></li>
       <li><a href="manage-tickets-MANTENIMIENTO.php"><span class="fa fa-ticket"></span> Mantenimiento</a></li>
       <li><a href="user-access-log.php"><span class="fa fa-users"></span>&nbsp;&nbsp;Registro de Acceso de Usuarios</a></li>
       <li><a href="manage-users.php"><span class="fa fa-users"></span> Usuarios</a></li>
       <li><a href="change-password.php"><span class="fa fa-file-text-o"></span> Cambiar Contraseña</a></li>
       <li><a href="logout.php" style="color: while;"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Cerrar Sesión</a></li>
        <?php endif; ?>
        <?php if ($_SESSION['area'] === 'ERP SILVA' || $_SESSION['area'] === 'COMPRAS' || $_SESSION['area'] === 'MANTENIMIENTO') : ?>
       <li><a href="logout.php" style="color: while;"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Cerrar Sesión</a></li>
        <?php endif; ?>
       </li>
      </ul>