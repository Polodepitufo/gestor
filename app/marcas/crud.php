<?php
$errorMessage = '';
if (isset($_POST['crear_marca'])) {
    try {
        $db->begin_transaction();
        $nombre_marca = $_POST['nombre_marca'];
        $estado_marca = $_POST['estado_marca'];
        $logotipo_nombre = $_FILES['logotipo_marca_imagen']['name'];
        $logotipo_tipo = $_FILES['logotipo_marca_imagen']['type'];
        $logotipo_tamano = $_FILES['logotipo_marca_imagen']['size'];
        $logotipo_temp = $_FILES['logotipo_marca_imagen']['tmp_name'];
        $codigo_aleatorio = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
        $nombre_imagen = $codigo_aleatorio . '-' . $logotipo_nombre;
        if (((strpos($logotipo_tipo, "jpeg") || strpos($logotipo_tipo, "jpg") || strpos($logotipo_tipo, "png")) && ($logotipo_tamano < 2000000))) {
            if (move_uploaded_file($logotipo_temp, '../../assets/media/marcas/' . $nombre_imagen)) {
                chmod('../../assets/media/marcas/' . $nombre_imagen, 0777);
                $sql_insertar_marca = "INSERT INTO LISTADOMARCAS (NOMBRE, ESTADO, IMAGENPRINCIPAL)  VALUES ('$nombre_marca', $estado_marca, '$nombre_imagen')";

                if ($db->query($sql_insertar_marca) === TRUE) {
                } else {
                    throw new Exception();
                }
            } else {
                throw new Exception();
            }
        } else {
            throw new Exception();
        }
        $db->commit();
    } catch (Exception $e) {
        $db->rollback();
        $errorMessage = 'Error.';
    }
}
// if (isset($_POST['editar_categoria'])) {
//     try {
//         $db->begin_transaction();
//         $id = $_POST['editar_categoria'];
//         $nombre_categoria = $_POST['editar_nombre_categoria'];
//         $padre_categoria = $_POST['editar_padre_categoria'];
//         $slug_categoria = $_POST['editar_slug_categoria'];
//         $estado_categoria = $_POST['editar_estado_categoria'];
//         $descripcion_categoria = $_POST['editar_descripcion_categoria'];
//         $descuento_categoria = $_POST['editar_descuento_categoria'];
//         $is_padre = ($padre_categoria == 0) ? 1 : 0;
//         $descuento_categoria = ($descuento_categoria == 0) ? 'NULL' : $descuento_categoria;
//         $padre_categoria = ($padre_categoria == 0) ? 'NULL' : $padre_categoria;
//        $sql_editar_categoria = "UPDATE CATEGORIAS SET ISPADRE=$is_padre, IDCATPADRE=$padre_categoria, SLUG ='$slug_categoria', ESTADO =$estado_categoria, DESCRIPCION = '$descripcion_categoria', NOMBRE ='$nombre_categoria', IDDESCUENTO = $descuento_categoria WHERE ID = $id";

//        if ($db->query($sql_editar_categoria) === TRUE) {
//        } else {
//            throw new Exception();
//        }

//         $db->commit();
//     } catch (Exception $e) {
//         $db->rollback();
//         $errorMessage = 'Error.';
//     }
// }
if (isset($_POST['eliminar_marca'])) {
    $id = $_POST['eliminar_marca'];
    try {
        $db->begin_transaction();
        $sql_delete = "DELETE FROM LISTADOMARCAS WHERE ID = $id";
        $sql_select = $db->query("SELECT * FROM LISTADOMARCAS WHERE ID = $id");
        foreach ($sql_select as $row) {
            $nombre = $row['IMAGENPRINCIPAL'];
        }

        $sql_delete_comprobar_tallas = $db->query("SELECT * FROM LISTADOTALLAS WHERE MARCA = $id");
        if ($sql_delete_comprobar_tallas->num_rows == 0) {
            $sql_delete_comprobar_colores = $db->query("SELECT * FROM LISTADOCOLORES WHERE MARCA = $id");
            if ($sql_delete_comprobar_colores->num_rows == 0) {
                if ($db->query($sql_delete) === TRUE) {
                    $ruta = '../../assets/media/marcas/' . $nombre;
                    if (file_exists($ruta)) {
                        unlink($ruta);
                    } else
                        throw new Exception();
                } else {
                    throw new Exception();
                }
            }
        }
        $db->commit();
    } catch (Exception $e) {
        $db->rollback();
        $errorMessage = 'Error.';
    }
}
$sql_marcas = $db->query('SELECT * FROM LISTADOMARCAS');
