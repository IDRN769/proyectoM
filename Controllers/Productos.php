<?php
class Productos extends Controller
{

    public function __construct()
    {
        session_start();

        parent::__construct();
    }

    public function index()
    {
        if (empty($_SESSION['activo'])) {
            header('location: ' . base_url);
        }
        $data['medidas'] = $this->model->getMedidas();
        $data['categorias'] = $this->model->getCategorias();
        $this->views->getView($this, "index", $data);
    }

    public function listar()
    {

        $data = $this->model->getProductos();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['imagen'] = '<img class="img-thumbnail" src="' . base_url . "Assets/img/" . $data[$i]['foto'] . '" width= "100">';
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnEditarPro(' . $data[$i]['id'] . ');"><i class = "fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarPerPro(' . $data[$i]['id'] . ');"><i class = "fas fa-trash"></i></button>
                <button class="btn btn-warning" type="button" onclick="btnEliminarPro(' . $data[$i]['id'] . ');">Deshabilitar</button>
                </div>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnReingresarPro(' . $data[$i]['id'] . ');">Habilitar</button>
                </div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {

        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $precio_compra = $_POST['precio_compra'];
        $precio_venta = $_POST['precio_venta'];
        $stock = $_POST['stock'];
        $medida = $_POST['medida'];
        $categoria = $_POST['categoria'];
        $id = $_POST['id'];
        $img = $_FILES['imagen'];
        $name = $img['name'];
        $tmpname = $img['tmp_name'];
        $destino = "Assets/img/" . $name;

        if (empty($name)) {
            $name = "default.jpg";
        }

        if (empty($codigo) || empty($nombre)  || empty($precio_compra) || empty($precio_venta) || empty($stock)) {
            $msg = "Campos obligatorios";
        } else {

            if ($id == "") {
                $data = $this->model->registrarProducto($codigo, $nombre, $precio_compra, $precio_venta, $stock, $medida, $categoria, $name);
                if ($data == "ok") {
                    $msg = "si";
                    move_uploaded_file($tmpname, $destino);
                } else if ($data == "existe") {
                    $msg = "El Producto ya existe";
                } else {
                    $msg = "Error al registrar Producto";
                }
            } else {
                if ($_POST['foto_actual'] != $_POST['foto_delete']) {
                    $imgDelete = $this->model->editarPro($id);
                    if ($imgDelete['foto'] != 'default.jpg' || $imgDelete['foto'] != "") {
                        if (file_exists($destino . $imgDelete['foto'])) {
                            unlink($destino . $imgDelete['foto']);
                        }
                    }
                    $data = $this->model->modificarProducto($codigo, $nombre, $precio_compra, $precio_venta, $stock, $medida, $categoria, $name, $id);
                    if ($data == "modificado") {
                        move_uploaded_file($tmpname, $destino);
                        $msg = "modificado";
                    } else {
                        $msg = "Error al modificar Producto";
                    }
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    //Lo copiado
    public function editar(int $id)
    {
        $data = $this->model->editarPro($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id)
    {
        $data = $this->model->accionPro(0, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al deshabilitar Producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionPro(1, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al habilitar Producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminarPer(int $id)
    {
        $data = $this->model->eliminarPerPro($id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al eliminar permanentemente al producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
