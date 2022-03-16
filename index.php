<?php

include "Views/Templates/header.php";
?>
<div class="jumbotron">
    <h1 class="display-4">Productos de la Tienda</h1>
    <p class="lead">Productos</p>
    <hr class="my-4">
    <p>Productos disponibles de la Tienda</p>
    <button class="btn btn-primary mb-2" type="button" onclick="frmProducto();">Agregar Producto</button>

    <table class="table table-light" id="tblProductos">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <div id="nuevo_producto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="title">Nuevo Producto</h5>
                    <button class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="frmProducto">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigo"><i class="fas fa-barcode"></i> Código de barras</label>
                                    <input type="hidden" id="id" name="id">
                                    <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Codigo de barras">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre"><i class="far fa-newspaper"></i> Descripción</label>
                                    <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="precio_compra"> <i class="fas fa-truck"></i> Precio Compra</label>
                                    <input id="precio_compra" class="form-control" type="text" name="precio_compra" placeholder="Precio compra">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="precio_venta"><i class="far fa-money-bill-alt"></i> Precio Venta</label>
                                    <input id="precio_venta" class="form-control" type="text" name="precio_venta" placeholder="Precio venta">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock"><i class="fas fa-archive"></i> Stock</label>
                                    <input id="stock" class="form-control" type="text" name="stock" placeholder="Stock">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="medida"><i class="fas fa-balance-scale"></i> Unidad</label>
                                    <select id="medida" class="form-control" name="medida">
                                        <?php foreach ($data['medidas'] as $row) { ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categoria"><i class="fas fa-sitemap"></i> Categorias</label>
                                    <select id="categoria" class="form-control" name="categoria">
                                        <?php foreach ($data['categorias'] as $row) { ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <div class="card border-primary">
                                        <div class="card-body">
                                            <label for="imagen" class="btn btn-primary" id="icon-image"><i class="fas fa-image"></i></label>
                                            <span id="icon-cerrar"></span>
                                            <input id="imagen" class="d-none" type="file" name="imagen" onchange="preview(event)">
                                            <input type="hidden" id="foto_actual" name="foto_actual">
                                            <input type="hidden" id="foto_delete" name="foto_delete">
                                            <img class="img-thumbnail" id="img-preview">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <button class="btn btn-success" type="button" onclick="registrarPro(event);" id="btnAccion">Registrar</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<?php

include "Views/Templates/footer.php";
?>