<?php include "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header bg-secondary text-white">
        <h4>Nueva Compra</h4>
    </div>
    <div class="card-body">
        <form id="frmCompra">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="codigo"><i class="fas fa-barcode"></i> Código de Barras</label>
                        <input type="hidden" id="id" name="id">
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Codigo de barras" onkeyup="buscarCodigo(event)">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="nombre"><i class="far fa-newspaper"></i> Descripción</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Descripción del producto" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cantidad"><i class="fas fa-question"></i> Cantidad</label>
                        <input id="cantidad" class="form-control" type="number" name="cantidad" onkeyup="calcularPrecio(event)">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="precio"><i class="fas fa-dollar-sign"></i> Precio</label>
                        <input id="precio" class="form-control" type="text" name="precio" placeholder="Precio compra" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="sub_total"><i class="fas fa-money-check-alt"></i> Sub total</label>
                        <input id="sub_total" class="form-control" type="text" name="sub_total" placeholder="Sub Total" disabled>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
<table class="table table-light table-bordered table-hover ">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Sub Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="tblDetalle">
    </tbody>
</table>
<div class="row">
    <div class="col-md-4 ml-auto">
        <div class="form-group">
            <label for="total" class="font-weight-bold"><i class="fas fa-donate"></i> Total</label>
            <input id="total" class="form-control" type="text" name="total" placeholder="Total" disabled>
            <button class="btn btn-primary mt-2 btn-block" type="button" onclick="generarCompra()">Generar Compra</button>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>