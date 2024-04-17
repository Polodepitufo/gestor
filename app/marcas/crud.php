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
if (isset($_POST['editar_marca'])) {
    try {
        $db->begin_transaction();
        $id = $_POST['editar_marca'];
        $nombre_marca = $_POST['editar_nombre_marca'];
        $estado_marca = $_POST['editar_estado_marca'];


        if (!empty($_FILES['editar_logotipo_marca_imagen']['name'])) {
            $logotipo_nombre = $_FILES['editar_logotipo_marca_imagen']['name'];
            $logotipo_tipo = $_FILES['editar_logotipo_marca_imagen']['type'];
            $logotipo_tamano = $_FILES['editar_logotipo_marca_imagen']['size'];
            $logotipo_temp = $_FILES['editar_logotipo_marca_imagen']['tmp_name'];
            $codigo_aleatorio = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
            $nombre_imagen = $codigo_aleatorio . '-' . $logotipo_nombre;
            $sql_select = $db->query("SELECT * FROM LISTADOMARCAS WHERE ID = $id");
            foreach ($sql_select as $row) {
                $nombre = $row['IMAGENPRINCIPAL'];
            }
            $ruta = '../../assets/media/marcas/' . $nombre;
            if (file_exists($ruta)) {
                unlink($ruta);
            }
            if (((strpos($logotipo_tipo, "jpeg") || strpos($logotipo_tipo, "jpg") || strpos($logotipo_tipo, "png")) && ($logotipo_tamano < 2000000))) {
                if (move_uploaded_file($logotipo_temp, '../../assets/media/marcas/' . $nombre_imagen)) {
                    chmod('../../assets/media/marcas/' . $nombre_imagen, 0777);
                    $sql_editar_marca = "UPDATE LISTADOMARCAS SET  NOMBRE ='$nombre_marca',ESTADO=$estado_marca, IMAGENPRINCIPAL= '$nombre_imagen' WHERE ID=$id";
                } else {
                    throw new Exception();
                }
            } else {
                throw new Exception();
            }
        } else {
            $sql_editar_marca = "UPDATE LISTADOMARCAS SET  NOMBRE ='$nombre_marca',ESTADO=$estado_marca WHERE ID=$id";
        }

        if ($db->query($sql_editar_marca) === TRUE) {
        } else {
            throw new Exception();
        }

        $db->commit();
    } catch (Exception $e) {
        $db->rollback();
        $errorMessage = 'Error.';
    }
}
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
