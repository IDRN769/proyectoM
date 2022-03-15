<?php include "Views/Templates/header.php"; ?>

<div class="jumbotron">
    <h1 class="display-4">Reportes Gráficos</h1>
    <p class="lead">Información sobre el Negocio</p>
    <hr class="my-4">
    <p>Ganancias y Ventas por día</p>
    <div class="row justify-content-center">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success">
                <div class="card-body d-flex text-white">
                    Ventas Por Día
                    <i class="fas fa-cash-register fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="<?php echo base_url; ?>Compras/historial" class="text-white">Ver Detalles</a>
                    <span class="text-white"><?php echo $data['compras']['total']; ?></span>
                </div>
            </div>
        </div>

        <!---->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger">
                <div class="card-body d-flex text-white">
                    Ganancias
                    <i class="far fa-money-bill-alt fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="<?php echo base_url; ?>Compras/historial" class="text-white">Ver Detalles</a>
                    <span class="text-white">$<?php echo $data['ganancias']['totalGa']; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="row mt-3 justify-content-center">
    <div class="col-xl-5">
        <div class="card">
            <div class="card-header bg-dark text-white">
                Productos más Vendidos
            </div>
            <div class="card-body">
                <canvas id="productosVendidos" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
    <!---->
    <div class="col-xl-5">
        <div class="card">
            <div class="card-header bg-dark text-white">
                Productos que se deben comprar más
            </div>
            <div class="card-body">
                <canvas id="stockMinimo" width="400" height="400"></canvas>
            </div>
        </div>
    </div>



    <?php include "Views/Templates/footer.php"; ?>