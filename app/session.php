<?php
session_start();
date_default_timezone_set('Europe/Madrid');


$dashboard = glob('../dashboard/*');
$clientes = glob('../clientes/*');
$pedidos = glob('../pedidos/*');
$productos = glob('../productos/*');
$categorias = glob('../categorias/*');
$marcas = glob('../marcas/*.php');
$colores = glob('../colores/*.php');
$tallas = glob('../tallas/*.php');
$tarifas = glob('../tarifas/*.php');
$descuentos = glob('../descuentos/*.php');
$cupones = glob('../cupones/*.php');
$url = str_replace('/gestor/app', '..', $_SERVER['REQUEST_URI']);
$extension = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_EXTENSION);

if(str_contains($url,'?')){
	$urlExplode= explode('?',$url);
	$url=$urlExplode[0];
}

if (empty($_SESSION['sesion_rol']) || $_SESSION['sesion_rol'] != 'ADMIN') {
    $errorMessage = 'denied';
    
    foreach ($dashboard as $row) {
        if ($url == $row) {
            header("Location: ../../index.php?mensaje=$errorMessage");
        }
    }

    foreach ($clientes as $row) {
        if ($url == $row) {
            header("Location: ../../index.php?mensaje=$errorMessage");
        }
    }

    foreach ($pedidos as $row) {
        if ($url == $row) {
            header("Location: ../../index.php?mensaje=$errorMessage");
        }
    }

    foreach ($productos as $row) {
        if ($url == $row) {
            header("Location: ../../index.php?mensaje=$errorMessage");
        }
    }

    foreach ($categorias as $row) {
        if ($url == $row) {
            header("Location: ../../index.php?mensaje=$errorMessage");
        }
    }

    foreach ($marcas as $row) {
        if ($url == $row) {
            header("Location: ../../index.php?mensaje=$errorMessage");
        }
    }

    foreach ($colores as $row) {
        if ($url == $row) {
            header("Location: ../../index.php?mensaje=$errorMessage");
        }
    }

    foreach ($tallas as $row) {
        if ($url == $row) {
            header("Location: ../../index.php?mensaje=$errorMessage");
        }
    }

    foreach ($descuentos as $row) {
        if ($url == $row) {
            header("Location: ../../index.php?mensaje=$errorMessage");
        }
    }

    foreach ($tarifas as $row) {
        if ($url == $row) {
            header("Location: ../../index.php?mensaje=$errorMessage");
        }
    }

    foreach ($cupones as $row) {
        if ($url == $row) {
            header("Location: ../../index.php?mensaje=$errorMessage");
        }
    }
}
