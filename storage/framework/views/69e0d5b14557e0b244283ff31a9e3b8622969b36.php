<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion SA || Pasante</title>
    <link rel="icon" href="<?php echo e(asset('AdminLTE/dist/img/IconoAcuaponico.png')); ?>" type="image/x-icon">

    <!-- Bootstrap local -->
    <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/plugins/bootstrap/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome local -->
    <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- AdminLTE local -->
    <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/dist/css/adminlte.min.css')); ?>">
    <!-- OverlayScrollbars local -->
    <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
    <!-- DataTables local -->
    <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
    <!-- Select2 local -->
    <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/plugins/select2/css/select2.min.css')); ?>">
    <!-- SweetAlert2 local -->
    <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')); ?>">

    <style>
        /* Fondo azul solo para las secciones de contenido */
        .content-header,
        .content {
            background-color: #E1F5FE !important;
        }

        /* Navbar fijo en la parte superior */
        .main-header {
            border-bottom: none !important;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1030;
            background-color: #89d1e9 !important;
        }

        /* Estilos del sidebar con scroll independiente */
        .main-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            z-index: 1031;
            background-color: #66bee1 !important;
            overflow-y: auto;
            /* Scroll solo para el sidebar si es necesario */
            max-height: 100vh;
            /* Limitar altura al viewport */
            scrollbar-width: thin;
            scrollbar-color: #89d1e9 #E1F5FE;
        }

        /* Estilo para el scrollbar en navegadores Webkit (Chrome, Safari) */
        .main-sidebar::-webkit-scrollbar {
            width: 8px;
        }

        .main-sidebar::-webkit-scrollbar-track {
            background: #E1F5FE;
        }

        .main-sidebar::-webkit-scrollbar-thumb {
            background: #89d1e9;
            border-radius: 4px;
        }

        /* Contenido sin espacio blanco con scroll independiente */
        .content-wrapper {
            margin-left: 250px;
            min-height: 100vh;
            padding-top: 56px;
            overflow: hidden;
            /* Evitar scroll en el wrapper */
        }

        .content {
            height: calc(100vh - 56px - 60px);
            /* Altura fija restando navbar y padding del header */
            padding: 15px;
            overflow-y: auto;
            /* Scroll solo en el contenido */
        }

        /* Estilos del navbar */
        .navbar {
            padding: 0.5rem 1rem;
            background-color: #89d1e9 !important;
        }

        .navbar-light .navbar-nav .nav-link {
            color: white;
            transition: all 0.2s ease;
            padding: 0.6rem 1.2rem;
            margin: 0 0.1rem;
            border-radius: 4px;
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .navbar-light .navbar-nav .active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.3);
        }

        .navbar-light .navbar-nav .active:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 20%;
            width: 60%;
            height: 2px;
            background-color: white;
        }

        .nav-divider {
            width: 1px;
            height: 30px;
            background-color: rgba(255, 255, 255, 0.3);
            margin: 0 0.5rem;
            align-self: center;
        }

        /* Ajuste para mover botones hacia la derecha */
        .navbar-nav.ml-auto {
            margin-left: 70px !important;
            /* Desplazar hacia la derecha */
        }

        /* Estilos del sidebar */
        .nav-link.active.bg-info,
        .nav-sidebar .nav-item .nav-link.active {
            background-color: rgba(255, 255, 255, 0.3) !important;
            color: white !important;
        }

        .nav-sidebar .nav-link p,
        .nav-sidebar .nav-link i {
            color: white;
        }

        .brand-link {
            border-bottom: none;
            background-color: #66bee1 !important;
        }

        /* Estilos del dropdown */
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 0.5rem 0;
            margin-top: 5px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            background-color: #66bee1;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            color: white;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 1.75rem;
        }

        .dropdown-header {
            font-size: 0.75rem;
            padding: 0.25rem 1.5rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .dropdown-divider {
            border-color: rgba(255, 255, 255, 0.1);
            margin: 0.25rem 0;
        }

        /* Loader */
        #global-loader {
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #B3E5FC;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-weight: bold;
            font-size: 18px;
            transition: opacity 0.3s ease;
        }

        .dots-loader {
            display: flex;
            gap: 12px;
            margin-bottom: 10px;
        }

        .dots-loader span {
            width: 15px;
            height: 15px;
            background-color: #7cbcec;
            border-radius: 50%;
            animation: bounce 1.2s infinite ease-in-out;
        }

        .dots-loader span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .dots-loader span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes  bounce {

            0%,
            80%,
            100% {
                transform: scale(0);
                opacity: 0.3;
            }

            40% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .text-loader {
            color: #01579B;
        }

        /* Animación del dropdown */
        @keyframes  slideIn {
            0% {
                opacity: 0;
                transform: translateY(5px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate.slideIn {
            animation: slideIn 0.2s ease-out;
        }

        /* Responsividad */
        @media (max-width: 768px) {
            .main-sidebar {
                transform: translateX(-250px);
                transition: transform 0.3s ease;
            }

            .main-sidebar.active {
                transform: translateX(0);
            }

            .main-header {
                left: 0;
                width: 100%;
            }

            .content-wrapper {
                margin-left: 0;
                padding-top: 56px;
            }

            .sidebar-toggle {
                display: block;
                position: fixed;
                top: 10px;
                left: 10px;
                z-index: 1032;
                color: white;
                font-size: 1.5rem;
                cursor: pointer;
            }
        }

        /* Ajuste para el modal */
        .modal-backdrop {
            z-index: 1040 !important;
        }

        .modal {
            z-index: 1050 !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Loader -->
    <div id="global-loader">
        <div class="dots-loader">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="text-loader">Cargando...</div>
    </div>

    <!-- Botón para toggle del sidebar en móviles -->
    <div class="sidebar-toggle d-md-none">
        <i class="fas fa-bars"></i>
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light shadow-sm">
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo e(route('cefa.acuaponico.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('cefa.acuaponico.index') ? 'active' : ''); ?>">
                    <i class="fas fa-home mr-2"></i> Inicio
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block ml-2">
                <div class="nav-divider"></div>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo e(route('acuaponico.pasante.welcomepas')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.welcomepas') ? 'active' : ''); ?>">
                    <i class="fas fa-user-tie mr-2"></i> Pasante
                </a>
            </li>
            <li class="nav-item dropdown d-none d-sm-inline-block">
                <a href="#" class="nav-link dropdown-toggle <?php echo e(request()->routeIs('acuaponico.pasante.pasante.') && !request()->routeIs('acuaponico.pasante.pasante.indextracking') ? 'active' : ''); ?>"
                    id="gestionDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-tasks mr-2"></i> Gestión
                </a>
                <div class="dropdown-menu dropdown-menu-left animate slideIn" aria-labelledby="gestionDropdown">
                    <h6 class="dropdown-header text-uppercase small">Registros</h6>
                    <a class="dropdown-item" href="<?php echo e(route('acuaponico.pasante.pasante.acuaponicoindex')); ?>">
                        <i class="fas fa-water mr-2"></i> Sistemas Acuaponicos
                    </a>
                    <a class="dropdown-item" href="<?php echo e(route('acuaponico.pasante.pasante.index')); ?>">
                        <i class="fas fa-boxes mr-2"></i> Lotes
                    </a>
                    <a class="dropdown-item" href="<?php echo e(route('acuaponico.pasante.pasante.categoria')); ?>">
                        <i class="fas fa-tags mr-2"></i> Categorías
                    </a>
                    <a class="dropdown-item" href="<?php echo e(route('acuaponico.pasante.pasante.indexspecies')); ?>">
                        <i class="fas fa-dna mr-2"></i> Especies
                    </a>
                    <a class="dropdown-item" href="<?php echo e(route('acuaponico.pasante.pasante.crops')); ?>">
                        <i class="fas fa-seedling mr-2"></i> Cultivos
                    </a>
                    <a class="dropdown-item" href="<?php echo e(route('acuaponico.pasante.pasante.indexresowing')); ?>">
                        <i class="fas fa-recycle mr-2"></i> Resiembras
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown d-none d-sm-inline-block">
                <a href="#" class="nav-link dropdown-toggle <?php echo e(request()->routeIs('acuaponico.pasante.pasante.indextracking*') ? 'active' : ''); ?>"
                    id="seguimientoDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-chart-line mr-2"></i> Seguimientos
                </a>
                <div class="dropdown-menu dropdown-menu-left animate slideIn" aria-labelledby="seguimientoDropdown">
                    <a class="dropdown-item" href="<?php echo e(route('acuaponico.pasante.pasante.indextracking')); ?>">
                        <i class="fas fa-chart-line mr-2"></i> Generales
                    </a>
                    <a class="dropdown-item" href="<?php echo e(route('acuaponico.pasante.pasante.indextrakingfish')); ?>">
                        <i class="fas fa-fish mr-2"></i> Peces
                    </a>
                    <a class="dropdown-item" href="<?php echo e(route('acuaponico.pasante.pasante.indextrackingplant')); ?>">
                        <i class="fas fa-leaf mr-2"></i> Plantas
                    </a>
                </div>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo e(route('acuaponico.pasante.pasante.indexharvest')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.pasante.indexharvest') ? 'active' : ''); ?>">
                    <i class="fas fa-tractor mr-2"></i> Cosechas
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo e(route('acuaponico.pasante.pasante.indexactivity')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.pasante.indexactivity') ? 'active' : ''); ?>">
                    <i class="fas fa-clipboard-list mr-2"></i> Actividades
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(asset('modules/acuaponico/Manual/Manual_Usuario_GSA.pdf')); ?>" title="ver manual de Usuario" style="color: white;">
                    <i class="fas fa-question"></i>
                    <span class="d-none d-sm-inline ml-2">Ayuda</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(asset('modules/acuaponico/Manual/Manual_Usuario_GSA.pdf')); ?>" download title="Manual de Usuario" style="color: white;">
                    <i class="fas fa-book-open"></i>
                    <span class="d-none d-sm-inline ml-2">Manual</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-link nav-link" title="Cerrar sesión">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="d-none d-sm-inline ml-2"></span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4">
        <a href="" class="brand-link d-flex flex-column align-items-center py-3">
            <img src="<?php echo e(asset('modules/acuaponico/images/iconos/icolog.png')); ?>"
                alt="Logo Acuapónico"
                class="img-circle elevation-3"
                style="width: 90px; height: 90px; object-fit: cover;">
            <span class="brand-text mt-2" style="font-size: 18px; color: white; font-weight: bold;">
                GSA - Pasante
            </span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="<?php echo e(route('acuaponico.pasante.welcomepas')); ?>"
                            class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.welcomepas') ? 'active bg-info text-white' : ''); ?>">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Inicio</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('acuaponico.pasante.pasante.acuaponicoindex')); ?>"
                            class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.pasante.acuaponicoindex') ? 'active bg-info text-white' : ''); ?>">
                            <i class="nav-icon fas fa-water"></i>
                            <p>Sistemas Acuaponicos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('acuaponico.pasante.pasante.index')); ?>"
                            class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.pasante.index') ? 'active bg-info text-white' : ''); ?>">
                            <i class="nav-icon fas fa-th-large"></i>
                            <p>Gestión de Lotes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('acuaponico.pasante.pasante.categoria')); ?>"
                            class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.pasante.categoria') ? 'active bg-info text-white' : ''); ?>">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Gestión de Categorias</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('acuaponico.pasante.pasante.indexspecies')); ?>"
                            class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.pasante.indexspecies') ? 'active bg-info text-white' : ''); ?>">
                            <i class="nav-icon fas fa-dna"></i>
                            <p>Gestión de Especies</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('acuaponico.pasante.pasante.crops')); ?>"
                            class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.pasante.crops') ? 'active bg-info text-white' : ''); ?>">
                            <i class="nav-icon fas fa-seedling"></i>
                            <p>Gestión de Cultivos</p>
                        </a>
                    </li>

                    <?php
                    $seguimientoRoutes = [
                    'acuaponico.pasante.pasante.indextracking',
                    'acuaponico.pasante.pasante.indextrakingfish',
                    'acuaponico.pasante.pasante.indextrackingplant'
                    ];
                    $isSeguimientoActive = collect($seguimientoRoutes)->contains(fn($route) => request()->routeIs($route));
                    ?>
                    <li class="nav-item">
                        <a href="#submenuSeguimiento"
                            class="nav-link <?php echo e($isSeguimientoActive ? 'active bg-info text-white' : ''); ?>"
                            data-toggle="collapse"
                            aria-expanded="<?php echo e($isSeguimientoActive ? 'true' : 'false'); ?>">
                            <i class="nav-icon fas fa-eye"></i>
                            <p>
                                Control Seguimientos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="collapse nav flex-column ms-3 <?php echo e($isSeguimientoActive ? 'show' : ''); ?>" id="submenuSeguimiento">
                            <li class="nav-item">
                                <a href="<?php echo e(route('acuaponico.pasante.pasante.indextracking')); ?>"
                                    class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.pasante.indextracking') ? 'active bg-info text-white' : ''); ?>">
                                    <i class="<?php echo e(request()->routeIs('acuaponico.pasante.pasante.indextracking') ? 'fas' : 'far'); ?> fa-circle nav-icon"></i>
                                    <p>Seguimientos Generales</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('acuaponico.pasante.pasante.indextrakingfish')); ?>"
                                    class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.pasante.indextrakingfish') ? 'active bg-info text-white' : ''); ?>">
                                    <i class="<?php echo e(request()->routeIs('acuaponico.pasante.pasante.indextrakingfish') ? 'fas' : 'far'); ?> fa-circle nav-icon"></i>
                                    <p>Seguimientos Peces</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('acuaponico.pasante.pasante.indextrackingplant')); ?>"
                                    class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.pasante.indextrackingplant') ? 'active bg-info text-white' : ''); ?>">
                                    <i class="<?php echo e(request()->routeIs('acuaponico.pasante.pasante.indextrackingplant') ? 'fas' : 'far'); ?> fa-circle nav-icon"></i>
                                    <p>Seguimientos Plantas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#submenuResiembra"
                            class="nav-link <?php echo e(request()->routeIs(['acuaponico.pasante.pasante.indexresowing', 'acuaponico.pasante.pasante.indexresowingtracking']) ? 'active bg-info text-white' : ''); ?>"
                            data-toggle="collapse"
                            aria-expanded="<?php echo e(request()->routeIs(['acuaponico.pasante.pasante.indexresowing', 'acuaponico.pasante.pasante.indexresowingtracking']) ? 'true' : 'false'); ?>">
                            <i class="nav-icon fas fa-seedling"></i>
                            <p>
                                Resiembras
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="collapse nav flex-column ms-3 <?php echo e(request()->routeIs(['acuaponico.pasante.pasante.indexresowing', 'acuaponico.pasante.pasante.indexresowingtracking']) ? 'show' : ''); ?>"
                            id="submenuResiembra">
                            <li class="nav-item">
                                <a href="<?php echo e(route('acuaponico.pasante.pasante.indexresowing')); ?>"
                                    class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.pasante.indexresowing') ? 'active bg-info text-white' : ''); ?>">
                                    <i class="<?php echo e(request()->routeIs('acuaponico.pasante.pasante.indexresowing') ? 'fas' : 'far'); ?> fa-circle nav-icon"></i>
                                    <p>Gestión resiembras</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('acuaponico.pasante.pasante.indexresowingtracking')); ?>"
                                    class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.pasante.indexresowingtracking') ? 'active bg-info text-white' : ''); ?>">
                                    <i class="<?php echo e(request()->routeIs('acuaponico.pasante.pasante.indexresowingtracking') ? 'fas' : 'far'); ?> fa-circle nav-icon"></i>
                                    <p>Seguimiento resiembra</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('acuaponico.pasante.pasante.indexharvest')); ?>"
                            class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.pasante.indexharvest') ? 'active bg-info text-white' : ''); ?>">
                            <i class="nav-icon fas fa-tractor"></i>
                            <p>Gestión de Cosechas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('acuaponico.pasante.pasante.indexactivity')); ?>"
                            class="nav-link <?php echo e(request()->routeIs('acuaponico.pasante.pasante.indexactivity') ? 'active bg-info text-white' : ''); ?>">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Control de Actividades</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Main content -->
    <div class="content-wrapper pt-0 mt-0">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right m-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('cefa.acuaponico.index')); ?>">Inicio</a>
                            </li>
                            <?php echo $__env->yieldPushContent('breadcrumbs'); ?>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <?php echo $__env->yieldContent('content'); ?>
            <?php echo $__env->yieldContent('content2'); ?>
        </section>
    </div>

    <!-- Scripts -->
    <script src="<?php echo e(asset('AdminLTE/plugins/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('AdminLTE/dist/js/adminlte.min.js')); ?>"></script>
    <script src="<?php echo e(asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
    <script src="<?php echo e(asset('AdminLTE/plugins/select2/js/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('AdminLTE/plugins/sweetalert2/sweetalert2.all.min.js')); ?>"></script>
    <script src="<?php echo e(asset('AdminLTE/plugins/chartjs/Chart.min.js')); ?>"></script>

    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('global-loader');
            if (loader) {
                loader.style.opacity = '0';
                setTimeout(() => loader.style.display = 'none', 300);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const currentUrl = window.location.href;
            const sidebar = document.querySelector('.main-sidebar');
            const toggleBtn = document.querySelector('.sidebar-toggle');

            // Toggle del sidebar en móviles
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }

            // Cerrar sidebar al hacer clic en un enlace en móviles
            document.querySelectorAll('.nav-link').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        sidebar.classList.remove('active');
                    }
                });
            });

            // Abrir submenú de seguimiento si está activo
            if (currentUrl.includes('indextracking') || currentUrl.includes('indextrakingfish') || currentUrl.includes('indextrackingplant')) {
                const submenu = document.getElementById('submenuSeguimiento');
                const toggleBtn = document.querySelector('[data-toggle="collapse"][href="#submenuSeguimiento"]');
                if (submenu) submenu.classList.add('show');
                if (toggleBtn) {
                    toggleBtn.classList.remove('collapsed');
                    toggleBtn.setAttribute('aria-expanded', 'true');
                }
            }

            // Marcar enlaces activos
            document.querySelectorAll('.nav-link').forEach(function(link) {
                const linkHref = link.href;
                if (linkHref !== "#" && currentUrl.includes(linkHref)) {
                    link.classList.add('active');
                }
            });

            // Inicializar dropdowns del navbar
            $('.dropdown-toggle').dropdown();

            // Inicialización de modales
            $('.modal').on('show.bs.modal', function() {
                $('body').addClass('modal-open');
            }).on('hidden.bs.modal', function() {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            });
        });
    </script>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html><?php /**PATH C:\laragon\www\sicefa\Modules/ACUAPONICO\Resources/views/layouts/masterpa.blade.php ENDPATH**/ ?>