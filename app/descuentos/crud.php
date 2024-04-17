<?php
$errorMessage = '';
if (isset($_POST['crear_descuento'])) {
    try {
        $db->begin_transaction();
        $nombre_descuento = $_POST['nombre_descuento'];
        $minimo_descuento = $_POST['minimo_descuento'];
        $maximo_descuento = $_POST['maximo_descuento'];
        $tipo_descuento = $_POST['tipo_descuento'];
        $cantidad_descuento = $_POST['cantidad_descuento'];
        if ($_POST['tipo_descuento'] == 'DESCUENTO FIJO') {
            $sql_insertar_descuento = "INSERT INTO DESCUENTOS (NOMBRE, MINIMA, MAXIMA, DESCUENTOFIJO)  VALUES ('$nombre_descuento', '$minimo_descuento', '$maximo_descuento', '$cantidad_descuento')";
        } else {
            $sql_insertar_descuento = "INSERT INTO DESCUENTOS (NOMBRE, MINIMA, MAXIMA, DESCUENTOPORC)  VALUES ('$nombre_descuento', '$minimo_descuento', '$maximo_descuento', '$cantidad_descuento')";
        }

        if ($db->query($sql_insertar_descuento) === TRUE) {
        } else {
            throw new Exception('Se ha producido un error insertando el descuento.');
        }

        $db->commit();
    } catch (Exception $e) {
        $db->rollback();
        $errorMessage = $e->getMessage();
    }
}
if (isset($_POST['editar_descuento'])) {
    try {
        $db->begin_transaction();
        $id = $_POST['editar_descuento'];
        $nombre_descuento = $_POST['editar_nombre_descuento'];
        $minimo_descuento = $_POST['editar_minimo_descuento'];
        $maximo_descuento = $_POST['editar_maximo_descuento'];
        $cantidad_descuento = $_POST['editar_cantidad_descuento'];

        if ($_POST['editar_tipo_descuento'] == 'DESCUENTO FIJO') {
            $sql_editar_descuento = "UPDATE DESCUENTOS SET NOMBRE ='$nombre_descuento', MINIMA=$minimo_descuento, MAXIMA=$maximo_descuento, DESCUENTOFIJO= $cantidad_descuento, DESCUENTOPORC =0 WHERE ID = $id";
        } else {
            $sql_editar_descuento = "UPDATE DESCUENTOS SET NOMBRE ='$nombre_descuento', MINIMA=$minimo_descuento, MAXIMA=$maximo_descuento, DESCUENTOPORC= $cantidad_descuento, DESCUENTOFIJO=0 WHERE ID = $id";
        }

        if ($db->query($sql_editar_descuento) === TRUE) {
        } else {
            throw new Exception('Se ha producido un error editando el descuento.');
        }

        $db->commit();
    } catch (Exception $e) {
        $db->rollback();
        $errorMessage = $e->getMessage();
    }
}
if (isset($_POST['eliminar_descuento'])) {
    $id = $_POST['eliminar_descuento'];
    try {
        $db->begin_transaction();
        $sql_delete = "DELETE FROM DESCUENTOS WHERE ID = $id";

        $sql_comprobar_categorias =$db->query("SELECT * FROM CATEGORIAS WHERE IDDESCUENTO = $id");
        if ($sql_comprobar_categorias->num_rows > 0) {
            $errorMessage='Aviso. Este descuento estaba vinculado a una o varias categorias.';
        }

        if ($db->query($sql_delete) === TRUE) {
        } else {
            throw new Exception();
        }
        $db->commit();
    } catch (Exception $e) {
        $db->rollback();
        $errorMessage = $e->getMessage();
    }
}
$sql_descuentos = $db->query('SELECT * FROM DESCUENTOS');