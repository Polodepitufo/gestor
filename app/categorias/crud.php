<?php
$errorMessage ='';
if (isset($_POST['crear_categoria'])) {
    try {
        $db->begin_transaction();
        $nombre_categoria = $_POST['nombre_categoria'];
        $padre_categoria = $_POST['padre_categoria'];
        $slug_categoria = $_POST['slug_categoria'];
        $estado_categoria = $_POST['estado_categoria'];
        $descripcion_categoria = $_POST['descripcion_categoria'];
        $descuento_categoria = $_POST['descuento_categoria'];

        $is_padre = ($padre_categoria == 0) ? 1 : 0;
        $descuento_categoria = ($descuento_categoria == 0) ? 'NULL' : $descuento_categoria;
        $padre_categoria = ($padre_categoria == 0) ? 'NULL' : $padre_categoria;

       $sql_insertar_categoria = "INSERT INTO CATEGORIAS (NOMBRE, DESCRIPCION, ISPADRE, IDCATPADRE, IDDESCUENTO, SLUG, ESTADO)  VALUES ('$nombre_categoria', '$descripcion_categoria', $is_padre, $padre_categoria, $descuento_categoria, '$slug_categoria', $estado_categoria)";

       if ($db->query($sql_insertar_categoria) === TRUE) {
       } else {
           throw new Exception('Se ha producido un error insertando la categoría.');
       }

        $db->commit();
    } catch (Exception $e) {
        $db->rollback();
        $errorMessage = $e->getMessage();
    }
}
if (isset($_POST['editar_categoria'])) {
    try {
        $db->begin_transaction();
        $id = $_POST['editar_categoria'];
        $nombre_categoria = $_POST['editar_nombre_categoria'];
        $padre_categoria = $_POST['editar_padre_categoria'];
        $slug_categoria = $_POST['editar_slug_categoria'];
        $estado_categoria = $_POST['editar_estado_categoria'];
        $descripcion_categoria = $_POST['editar_descripcion_categoria'];
        $descuento_categoria = $_POST['editar_descuento_categoria'];
        $is_padre = ($padre_categoria == 0) ? 1 : 0;
        $descuento_categoria = ($descuento_categoria == 0) ? 'NULL' : $descuento_categoria;
        $padre_categoria = ($padre_categoria == 0) ? 'NULL' : $padre_categoria;
       $sql_editar_categoria = "UPDATE CATEGORIAS SET ISPADRE=$is_padre, IDCATPADRE=$padre_categoria, SLUG ='$slug_categoria', ESTADO =$estado_categoria, DESCRIPCION = '$descripcion_categoria', NOMBRE ='$nombre_categoria', IDDESCUENTO = $descuento_categoria WHERE ID = $id";

       if ($db->query($sql_editar_categoria) === TRUE) {
       } else {
           throw new Exception('Se ha producido un error editando la categoría.');
       }

        $db->commit();
    } catch (Exception $e) {
        $db->rollback();
        $errorMessage = $e->getMessage();
    }
}
if (isset($_POST['eliminar_categoria'])) {
    $id = $_POST['eliminar_categoria'];
    try {
        $db->begin_transaction();
        $sql_delete = "DELETE FROM CATEGORIAS WHERE ID = $id";

        $sql_delete_comprobar = $db->query("SELECT * FROM CATEGORIAS WHERE IDCATPADRE = $id");
        if ($sql_delete_comprobar->num_rows != 0) {
            foreach ($sql_delete_comprobar as $row) {
                $id_categoria_editar = $row['ID'];

                $sql_editar_categoria_padre = "UPDATE CATEGORIAS SET ISPADRE=1 WHERE ID = $id_categoria_editar";
                if ($db->query($sql_editar_categoria_padre) === TRUE) {
                } else {
                    throw new Exception('Se ha producido un error eliminando la categoría.');
                }
            }
        }
        if ($db->query($sql_delete) === TRUE) {
        } else {
            throw new Exception('Se ha producido un error eliminando la categoría.');
        }
        $db->commit();
    } catch (Exception $e) {
        $db->rollback();
        $errorMessage = $e->getMessage();
    }
}
$sql_categorias = $db->query('SELECT * FROM CATEGORIAS');

$sql_descuentos = $db->query('SELECT * FROM DESCUENTOS');
