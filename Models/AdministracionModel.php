<?php
class AdministracionModel extends Query{

    public function __construct()
    {
        parent::__construct();
    }

    public function getDatos(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table";
        $data = $this->select($sql);
        return $data;
    }

    public function getCompras()
    {
        $sql = "SELECT COUNT(*) AS total FROM compras WHERE fecha > CURDATE()";
        $data = $this->select($sql);
        return $data;
    }

    public function getGanancias()
    {
        $sql = "SELECT SUM(total) AS totalGa FROM compras WHERE total";  
        $data = $this->select($sql);
        return $data;
    }

    public function getStockMinimo()
    {
        $sql = "SELECT * FROM productos WHERE cantidad < 11 ORDER BY cantidad DESC LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getproductosVendidos()
    {
        $sql = "SELECT d.id_producto, d.cantidad, p.id, p.descripcion, SUM(d.cantidad) AS total FROM detalle_compras d INNER JOIN productos p ON p.id = d.id_producto GROUP BY d.id_producto ORDER BY d.cantidad DESC LIMIT 4";
        $data = $this->selectAll($sql);
        return $data;
    }

   

}
?>