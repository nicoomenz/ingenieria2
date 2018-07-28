<?php

session_start();
include ("conexion.php");

if ($conexion)
{
    if (isset($_POST['origen']) and (isset($_POST['destino']))) 
    {
        $origen = $_POST['origen'];
        if ($origen != "")
        {
            $_SESSION['origenBusqueda'] = false;
            $_SESSION['oriValue'] = $origen;
        }
        $destino = $_POST['destino'];
        if ($destino != "")
        {
            $_SESSION['destinoBusqueda'] = false;
            $_SESSION['desValue'] = $destino;
        }
        header("Location:PagPrin.php");
    }
}
else
{
    echo "Surgio un error.";
    header("Location:PagPrin.php");
}
