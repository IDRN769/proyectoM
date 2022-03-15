<?php

include "Views/Templates/header.php";
?>
<div class="jumbotron">
    <h1 class="display-4">Usuarios</h1>
    <p class="lead">Usuarios Registrados</p>
    <hr class="my-4">
    <p>Registrar</p>
    <button class="btn btn-primary mb-2" type="button" onclick="frmUsuario();">Agregar Usuario</button>

    <table class="table table-light" id="tblUsuarios">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>USUARIO</th>
                <th>NOMBRE</th>
                <th>CAJA</th>
                <th>ESTADO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="title">Nuevo Usuario</h5>
                    <button class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="frmUsuario">
                        <div class="form-group">
                            <label for="usuario"><i class="far fa-address-book"></i> Usuario</label>
                            <input type="hidden" id="id" name="id">
                            <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario">
                        </div>
                        <div class="form-group">
                            <label for="nombre"><i class="far fa-address-card"></i> Nombre</label>
                            <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre">
                        </div>
                        <div class="form-group" id="claves">
                            <label for="clave"><i class="fas fa-key"></i> Contraseña</label>
                            <input id="clave" class="form-control" type="password" name="clave" placeholder="Contraseña">
                        </div>

                        <div class="form-group">
                            <label for="caja"><i class="fas fa-business-time"></i> Caja</label>
                            <select id="caja" class="form-control" name="caja">
                                <?php foreach ($data['cajas'] as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['caja']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <button class="btn btn-success" type="button" id="btnAccion" onclick="registrarUsuarios(event);">Registrar</button>
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