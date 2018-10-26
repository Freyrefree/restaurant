<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png"> -->
    <title>Restaurant :: Inicio</title>

    <!-- ===== JQUERY ===== -->
    <script src="js/jquery-3.3.1.js"></script>
    <!-- =====  ===== -->
    
    <!-- ===== Bootstrap CSS ===== -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->
    <link href="plugins/components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href='plugins/components/fullcalendar/fullcalendar.css' rel='stylesheet'>
    <!-- ===== Animation CSS ===== -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="css/style.css" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
     <!-- =====Autocomplete CSS ===== -->
     <link href="css/autocomplete.css" id="theme" rel="stylesheet">
     <!-- ===== MOD DataGrid ===== -->
     <link href="css/modDataGrid.css" id="theme" rel="stylesheet">
      
   

</head>

<body  class="<?php if(isset($_SESSION['user_id'])):?>  mini-sidebar fix-header <?php else:?> mini-sidebar fix-header <?php endif; ?>" >
    <!-- ===== Main-Wrapper ===== -->

    
    
    <div id="wrapper">
        <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <!-- ===== Top-Navigation ===== -->
        <?php if(isset($_SESSION["user_id"]) || isset($_SESSION["client_id"])):?>
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <a class="navbar-toggle font-20 hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="top-left-part">
                    <a class="logo" href="index.php?view=monitor">
                        <b>
                            <img src="" alt="home" />
                            <!-- plugins/images/logo.png -->
                        </b>
                        <span>
                            <img src="" alt="" class="dark-logo" />
                            <!-- plugins/images/logo-text.png -->
                        </span>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li>
                        <form role="search" class="app-search hidden-xs" action="index.php?view=proveedor" method="get">
                            <i class="fa fa-search"></i>
                            <input type="hidden" name="view" value="proveedor">
                            <input type="text" class="form-control" name="buscar" placeholder="Buscar proveedor..."> 
                        </form>

                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle waves-effect waves-light font-20" data-toggle="dropdown" href="javascript:void(0);">
                            <i class="fa fa-cogs"></i>
                            <span class="badge badge-xs badge-danger">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-tasks animated slideInUp">
                            <li>
                                <a href="index.php?view=sells&t=0">

                                    <div>
                                        <p>
                                            <strong>Pendientes</strong>
                                            <span class="pull-right text-muted">40% Completado</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                <span class="sr-only">40% Completado</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="index.php?view=sells&t=1">
                                    <div>
                                        <p>
                                            <strong>Finalizados</strong>
                                            <span class="pull-right text-muted">90% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                                                <span class="sr-only">90% Completado</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                           
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="index.php?view=sells">
                                    <strong>Ver todos</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle waves-effect waves-light font-20" data-toggle="dropdown" href="javascript:void(0);">
                            <i class="fa fa-user"></i>
                            <span class="badge badge-xs badge-danger">6</span>
                        </a>
                        <ul class="dropdown-menu mailbox animated bounceInDown">
                            <li>
                                <div class="drop-title">Bienvenido!</div>
                            </li>
                            <li>
                                <div class="message-center">
                                    <a href="javascript:void(0);">
                                        <div class="user-img">
                                            <img src="" alt="user" class="img-circle">
                                            <!-- plugins/images/users/1.jpg -->
                                            <span class="profile-status online pull-right"></span>
                                        </div>
                                        <div class="mail-contnet">
                                            <h5>Usuario</h5>
                                            <span class="mail-desc"><?php if(isset($_SESSION["user_id"]) ){ echo UserData::getById($_SESSION["user_id"])->name; }?></span>
                                            
                                        </div>
                                    </a>
                                   
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="./logout.php">
                                    <strong>Salir</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    
                   
                </ul>
            </div>
        </nav>
        <!-- ===== Top-Navigation-End ===== -->
        <!-- ===== Left-Sidebar ===== -->
        <?php 

            if (isset($_SESSION["user_id"])):

                $datos      = UserData::getById($_SESSION["user_id"]);   

                $is_admin   = $datos->is_admin;
                $is_mesero  = $datos->is_mesero;
                $is_cajero  = $datos->is_cajero;
           
            endif;
             
        ?>
        <aside class="sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="side-menu">

                    <?php if($is_admin == 1 || $is_mesero == 1 || $is_cajero == 1):?>

                        <?php if($is_admin == 1 || $is_mesero == 1):?>
                        <li>
                            <a class="active waves-effect" href="index.php?view=monitor" aria-expanded="false"><i class="fa fa-home"></i> <span class="hide-menu"> Monitor </span></a>
                        </li>
                        <?php endif;?>

                        <!-- <?php if($is_admin == 1 || $is_mesero == 1):?>
                        <li>
                            <a class="waves-effect" href="index.php?view=carta" aria-expanded="false"><i class="fa fa-book"></i> <span class="hide-menu"> Carta </span></a>
                        </li>
                        <?php endif;?> -->

                        <?php if($is_admin == 1 || $is_cajero == 1):?>
                        <li>
                            <a class="waves-effect" href="index.php?view=sells" aria-expanded="false"><i class="fa fa-shopping-cart"></i> <span class="hide-menu"> Ventas </span></a>
                        </li>
                        <?php endif;?>

                        <?php if($is_admin == 1 || $is_mesero == 1):?>
                        <li>
                            <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-glass"></i> <span class="hide-menu"> Catálogo </span></a>
                            <ul aria-expanded="false" class="collapse">

                                <?php if($is_admin == 1 || $is_mesero == 1):?>
                                <li><a href="index.php?view=products">Productos</a></li>
                                <?php endif;?>

                                <?php if($is_admin == 1):?>
                                <li><a href="index.php?view=categories">Categorías</a></li>
                                <?php endif;?>
                               
                            </ul>
                        </li>
                        <?php endif;?>

                        <?php if($is_admin == 1):?>
                        <li>
                            <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-caret-square-o-down"></i> <span class="hide-menu"> Inventario </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.php?view=ingredients">Ingredientes</a></li>
                                <li><a href="index.php?view=re">Abastecer</a></li>
                                <li><a href="index.php?view=inventary">Inventario</a></li>
                                
                            </ul>
                        </li>
                        <?php endif;?>

                        <?php if($is_admin == 1):?>
                        <li>
                            <a class="waves-effect" href="index.php?view=item" aria-expanded="false"><i class="fa fa-table"></i> <span class="hide-menu"> Mesas </span></a> 
                        </li>
                        <?php endif;?>

                        <?php if($is_admin == 1):?>                      
                        <li>
                            <a class="waves-effect" href="index.php?view=reports" aria-expanded="false"><i class="fa fa-area-chart"></i> <span class="hide-menu"> Reporte </span></a> 
                        </li>
                        <?php endif;?>

                        <?php if($is_admin == 1):?>
                        <li>
                            <a class="waves-effect" href="index.php?view=proveedor" aria-expanded="false"><i class="fa fa-users"></i> <span class="hide-menu"> Proveedor </span></a> 
                        </li>
                        <?php endif;?>

                        <?php if($is_admin == 1):?>
                        <li>
                            <a class="waves-effect" href="index.php?view=users" aria-expanded="false"><i class="fa fa-user"></i> <span class="hide-menu"> Usuarios </span></a> 
                        </li>
                        <?php endif;?>


                    <?php endif;?>
                        
                    </ul>
                </nav>
            </div>
        </aside>

         <?php endif;?>
        <!-- ===== Left-Sidebar-End ===== -->
        <!-- ===== Page-Content ===== -->


        <?php if(isset($_SESSION["user_id"])):?>
        <div class="page-wrapper">
            <!-- ===== Page-Container ===== -->
            <div class="container-fluid">
                <?php View::load("index");?>
            </div>
            <!-- ===== Page-Container-End ===== -->
            <footer class="footer t-a-c">
                Aiko Soluciones Inteligentes
            </footer>
        </div>
        <?php else:?>
<section id="wrapper" class="login-register">
        <div class="login-box">
            <div class="white-box">
                <form class="form-horizontal form-material" id="loginform" action="./?action=processlogin" method="post">
                    <h3 class="box-title m-b-20">Iniciar Sesión</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" name="username" placeholder="Usuario">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" name="password" placeholder="Contraseña">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary pull-left p-t-0">
                                <input id="checkbox-signup" type="checkbox" checked="">
                                <label for="checkbox-signup"> Recuérdame </label>
                            </div>
                            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Olvidó contraseña?</a> </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Ingresar</button>
                        </div>
                    </div>
                    
                    
                </form>
               
            </div>
        </div>
    </section>
      <?php endif;?>


              
              
               


        <!-- ===== Page-Content-End ===== -->
    </div>
    <!-- ===== Main-Wrapper-End ===== -->
    <!-- ==============================
        Required JS Files
    =============================== -->
    <!-- ===== jQuery ===== -->
    <script src="plugins/components/jquery/dist/jquery.min.js"></script>
    <!-- ===== Bootstrap JavaScript ===== -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ===== Slimscroll JavaScript ===== -->
    <script src="js/jquery.slimscroll.js"></script>
    <!-- ===== Wave Effects JavaScript ===== -->
    <script src="js/waves.js"></script>
    <!-- ===== Menu Plugin JavaScript ===== -->
    <script src="js/sidebarmenu.js"></script>
    <!-- ===== Custom JavaScript ===== -->
    <script src="js/custom.js"></script>
    <!-- ===== Plugin JS ===== -->
    <script src="plugins/components/chartist-js/dist/chartist.min.js"></script>
    <script src="plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <script src='plugins/components/moment/moment.js'></script>
    <script src='plugins/components/fullcalendar/fullcalendar.js'></script>
    <script src="js/db2.js"></script>
    <!-- ===== Style Switcher JS ===== -->
    <script src="plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
</body>



</html>