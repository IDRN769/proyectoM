<?php
class Usuarios extends Controller
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
        $data['cajas'] = $this->model->getCajas();
        $this->views->getView($this, "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getUsuarios();

        for ($i = 0; $i < count($data); $i++) {

            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
          
                <button class="btn btn-success" type="button" onclick="btnEditarUser(' . $data[$i]['id'] . ');"><i class = "fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarPerUser(' . $data[$i]['id'] . ');"><i class = "fas fa-trash"></i></button>
                <button class="btn btn-warning" type="button" onclick="btnEliminarUser(' . $data[$i]['id'] . ');">Deshabilitar</button>
                </div>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnReingresarUser(' . $data[$i]['id'] . ');">Habilitar</button>
                </div>';
            }
            
        }
        //trash-alt
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function validar()
    {
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg = "Los campos están vacios";
        } else {
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $data = $this->model->getUsuario($usuario, $clave);
            if ($data) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['activo'] = true;
                $msg = "ok";
            } else {
                $msg = "Usuario o contraseña incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $caja = $_POST['caja'];
        $id = $_POST['id'];

        if (empty($usuario) || empty($nombre) || empty($clave) || empty($caja)) {
            $msg = array('msg' => 'Campos obligatorios', 'icono' => 'warning');
        } else {
            if ($id == "") {

                $data = $this->model->registrarUsuario($usuario, $nombre, $clave, $caja);
                if ($data == "ok") {
                    //$msg = "si";
                    $msg = array('msg' => 'Usuario Registrado', 'icono' => 'success');
                } else if ($data == "existe") {
                    //$msg = "El usuario ya existe";
                    $msg = array('msg' => 'El usuario ya existe', 'icono' => 'warning');
                } else {
                    //$msg = "Error al registrar usuario";
                    $msg = array('msg' => 'Error al registrar usuario', 'icono' => 'error');
                }
            } else {
                $data = $this->model->modificarUsuario($usuario, $nombre, $clave, $caja, $id);
                if ($data == "modificado") {
                    //$msg = "modificado";
                    $msg = array('msg' => 'Usuario Modificado', 'icono' => 'success');
                } else {
                    $msg = "Error al modificar usuario";
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id)
    {
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id)
    {
        $data = $this->model->accionUser(0, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al deshabilitar usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionUser(1, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al habilitar usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminarPer(int $id)
    {
        $data = $this->model->eliminarPerUser($id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al eliminar permanentemente al usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function salir()
    {
        session_destroy();
        header("location: " . base_url);
    }
}
