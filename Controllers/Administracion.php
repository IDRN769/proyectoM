<?php
class Administracion extends Controller
{

    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function home()
    {
        $data['usuarios'] = $this->model->getDatos('usuarios');
        $data['compras'] = $this->model->getCompras();
        $data['ganancias'] = $this->model->getGanancias();
        $this->views->getView($this, "home", $data);
    }

    public function reporteStock()
    {
        $data = $this->model->getStockMinimo();
        echo json_encode($data);
        die();
    }

    public function productosVendidos()
    {
        $data = $this->model->getproductosVendidos();
        echo json_encode($data);
        die();
    }

  

    
}
