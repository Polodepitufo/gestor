<?php
$errorMessage = '';
if (isset($_POST['crear_talla'])) {
    try {
        $db->begin_transaction();
        $nombre_talla = $_POST['nombre_talla'];
        $estado_talla = $_POST['estado_talla'];
        $marca_talla = $_POST['marca_talla'];
            $sql_insertar_talla = "INSERT INTO LISTADOTALLAS (NOMBRE, ESTADO, MARCA)  VALUES ('$nombre_talla', $estado_talla, $marca_talla)";
      

        if ($db->query($sql_insertar_talla) === TRUE) {
        } else {
            throw new Exception('Se ha producido un error insertando la talla.');
        }

        $db->commit();
    } catch (Exception $e) {
        $db->rollback();
        $errorMessage = $e->getMessage();
    }
}
if (isset($_POST['editar_talla'])) {
    try {
        $db->begin_transaction();
        $id = $_POST['editar_talla'];
        $editar_nombre_talla = $_POST['editar_nombre_talla'];
        $editar_estado_talla = $_POST['editar_estado_talla'];
        $editar_marca_talla = $_POST['editar_marca_talla'];
        $sql_editar_talla = "UPDATE LISTADOTALLAS SET NOMBRE='$editar_nombre_talla',ESTADO=$editar_estado_talla, MARCA=$editar_marca_talla WHERE ID=$id";
        if ($db->query($sql_editar_talla) === TRUE) {
        } else {
            throw new Exception('Se ha producido un error editando la talla.');
        }

        $db->commit();
    } catch (Exception $e) {
        $db->rollback();
        $errorMessage = $e->getMessage();
    }
}

if (isset($_POST['eliminar_talla'])) {
    $id = $_POST['eliminar_talla'];
    try {
        $db->begin_transaction();
        $sql_delete = "DELETE FROM LISTADOTALLAS WHERE ID = $id";
        if ($db->query($sql_delete) === TRUE) {
        } else {
            throw new Exception('Se ha producido un error eliminando la talla.');
        }
        $db->commit();
    } catch (Exception $e) {
        $db->rollback();
        $errorMessage = $e->getMessage();
    }
}
$sql_tallas = $db->query('SELECT * FROM LISTADOTALLAS');
$sql_marcas = $db->query('SELECT * FROM LISTADOMARCAS');