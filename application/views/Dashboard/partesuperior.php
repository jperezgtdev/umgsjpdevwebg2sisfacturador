<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/sb-admin-2.min.css'); ?>">
    <link rel="stylesheet" href="vistas/est.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

</head>



<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-trophy"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Dynamic Football </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="far fa-futbol" style="font-size: 24px;"></i>
                <span class="nav-link" style="font-size: 15px;">Menú Principal</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading" style="font-size: 15px;">
            Ventas
        </div>

        <!-- Apartado de Clientes -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#clientes" aria-expanded="true" aria-controls="clientes">
                <i class="far fa-user" style="font-size: 20px;"></i>
                <span class="nav-link" style="font-size: 15px;">Clientes</span>
            </a>
            <div id="clientes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gestion de Clientes</h6>

                    <a class="collapse-item" href="add_cliente.php">Añadir Cliente
                        <i class="fas fa-user-plus" style="font-size: 15px;"></i> </a>
                    <a class="collapse-item" href="lista_clientes.php">Clientes
                        <i class="fas fa-user-friends" style="font-size: 15px;"></i>
                    </a>
                </div>
            </div>
        </li>

        <!-- Apartado de Productos -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#producto" aria-expanded="true" aria-controls="producto">
                <i class="fas fa-store-alt" style="font-size: 15px;"></i>
                <span class="nav-link" style="font-size: 15px;">Inventario</span>
            </a>
            <div id="producto" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gestion de Ventas</h6>
                    <a class="collapse-item" href="insert_producto.php">Ingreso de Productos
                        <i class="fab fa-product-hunt" style="font-size: 15px;"></i>
                    </a>
                    <a class="collapse-item" href="most_producto.php">Productos en Inventario
                        <i class="fas fa-store-alt" style="font-size: 15px;"></i>
                    </a>
                </div>
            </div>
        </li>

        <!-- Apartado de Ventas -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ventas" aria-expanded="true" aria-controls="ventas">
                <i class="fas fa-cart-arrow-down " style="font-size: 15px;"></i>
                <span class="nav-link" style="font-size: 15px;">Ventas</span>
            </a>
            <div id="ventas" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gestion de Ventas</h6>
                    <a class="collapse-item" href="facturacion.php">Venta
                        <i class="fas fa-tag" style="font-size: 15px;"></i>
                    </a>
                    <a class="collapse-item" href="control_ventas.php">Control de Ventas
                        <i class="fas fa-file-contract" style="font-size: 15px;"></i>
                    </a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading" style="font-size: 15px;">
            CONTROL LIGA
        </div>

        <!-- Apartado de control de Liga -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Equipos y Jugadores</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gestion De Equipos</h6>
                    <a class="collapse-item" href="add_equipo.php">Registrar Equipo
                        <i class="fas fa-plus" style="font-size: 15px;"></i>
                    </a>
                    <a class="collapse-item" href="lista_equipos.php">Equipos Registrados
                        <i class="fas fa-users" style="font-size: 15px;"></i>
                    </a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Gestion de Jugadores</h6>
                    <a class="collapse-item" href="add_jugador.php">Registro de Jugador
                        <i class="fas fa-tshirt" style="font-size: 15px;"></i>
                    </a>
                    <a class="collapse-item" href="lista_jugadores.php">Jugadores Registrados
                        <i class="fas fa-user-check" style="font-size: 15px;"></i>
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="add_partido.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Registrar Partido</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="partidos.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Estadisticas de Partidos</span></a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="estadisticas_Jugadores.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Estadisticas de Jugadores</span></a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="estadisticas_equipos.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Estadisticas de Equipos</span></a>
        </li>

        
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>



                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">



                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrador</span>
                            <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->


            <!-- /.container-fluid -->