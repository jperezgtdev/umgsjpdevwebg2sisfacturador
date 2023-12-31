<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/sb-admin-2.min.css'); ?>">
</head>
<body>
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                    <img class="img-profile rounded-circle" style="width: 40px; height: auto;" src="<?php echo base_url('assets/logo1.png'); ?>">
                </div>
                <div class="sidebar-brand-text mx-3">Book Shop</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="<?= site_url('Dashboard') ?>">
                <i class="fa-solid fa-bars" style="font-size: 24px;"></i>
                <span class="nav-link" style="font-size: 15px;">Menú Principal</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading" style="font-size: 15px;">
                Ventas
            </div>
            <!-- Apartado de Clientes -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#clientes" aria-expanded="true" aria-controls="clientes">
                    <i class="far fa-user" style="font-size: 20px;"></i>
                    <span class="nav-link" style="font-size: 15px;">Clientes</span>
                </a>
                <div id="clientes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestion de clientes</h6>
                        <a class="collapse-item" href="<?= site_url('AltaCliente') ?>">Añadir Cliente
                        </a>
                        <a class="collapse-item" href="<?= site_url('Clientes') ?>">Clientes
                        </a>
                    </div>
                </div>
            </li>
            <!-- Apartado de Productos -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#producto" aria-expanded="true" aria-controls="producto">
                    <i class="fas fa-store-alt" style="font-size: 15px;"></i>
                    <span class="nav-link" style="font-size: 15px;">Inventario</span>
                </a>
                <div id="producto" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestion de productos</h6>
                        <a class="collapse-item" href="<?= site_url('AltaProducto') ?>">Añadir producto
                        </a>
                        <a class="collapse-item" href="<?= site_url('ConsultaProducto') ?>">Productos
                        </a>
                    </div>
                </div>
            </li>

            <!-- apartado de facturas-->

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#facturas" aria-expanded="true" aria-controls="facturas">
                    <i class="fas fa-fw fa-folder" style="font-size: 15px;"></i>
                    <span class="nav-link" style="font-size: 15px;">Facturas</span>
                </a>
                <div id="facturas" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">gestion de facturas</h6>
                        <a class="collapse-item" href="<?= site_url('Facturar') ?>">Facturar
                        </a>
                        <a class="collapse-item" href="<?= site_url('ConsultaFactura') ?>">Consultar Facturas
                        </a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading" style="font-size: 15px;">
                Compras
            </div>

            <!-- Apartado de Compra -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#compra" aria-expanded="true" aria-controls="compra">
                    <i class="fa-solid fa-cart-arrow-down" style="font-size: 15px;"></i>
                    <span class="nav-link" style="font-size: 15px;">Compras</span>
                </a>
                <div id="compra" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestion de compras</h6>
                        <a class="collapse-item" href="<?= site_url('AltaCompra') ?>">Ingreso de Compras
                        </a>
                        <a class="collapse-item" href="<?= site_url('ConsultaCompra') ?>">Compras
                        </a>
                    </div>
                </div>
            </li>

            <!-- Apartado de Proveedor -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#proveedor" aria-expanded="true" aria-controls="proveedor">
                    <i class="fa-solid fa-parachute-box" style="font-size: 15px;"></i>
                    <span class="nav-link" style="font-size: 15px;">Proveedores</span>
                </a>
                <div id="proveedor" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestion de proveedores</h6>
                        <a class="collapse-item" href="<?= site_url('AltaProveedor') ?>">Ingreso de proveedor
                        </a>
                        <a class="collapse-item" href="<?= site_url('ConsultaProveedor') ?>">Proveedores
                        </a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading" style="font-size: 15px;">
                USUARIOS 
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#usuario" aria-expanded="true" aria-controls="usuario">
                    <i class="fas fa-fw fa-folder" style="font-size: 15px;"></i>
                    <span class="nav-link" style="font-size: 15px;">Usuarios</span>
                </a>
                <div id="usuario" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Administración de Usuarios</h6>
                        <a class="collapse-item" href="<?= site_url('RegistroUsuario') ?>">Registrar Usuario
                        </a>
                        <a class="collapse-item" href="<?= site_url('Usuarios') ?>">Usuarios existentes
                        </a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
            <div class="sidebar-heading" style="font-size: 15px;">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Sesion
                <li><a href="<?= site_url('LogoutController/logout')?>">Cerrar Sesion</a></li>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

        
            <div>
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrador</span>
                                <img class="img-profile rounded-circle" src="<?php echo base_url('assets/logo.png'); ?>">
                            </a>
                        </li>
                    </ul>
                </nav>
            <div>
        </div>
    </div>
</body>
</html>