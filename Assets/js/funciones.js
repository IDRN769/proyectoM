
let tblUsuarios, tblProductos;

document.addEventListener("DOMContentLoaded", function () {
    //tabla Usuarios
    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data': 'id'
            },
            {
                'data': 'usuario'
            },
            {
                'data': 'nombre'
            },
            {
                'data': 'caja'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ]
    });

    //tabla usuarios Productos
    tblProductos = $('#tblProductos').DataTable({
        ajax: {
            url: base_url + "Productos/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data': 'id'
            },
            {
                'data': 'codigo'
            },
            {
                'data': 'descripcion'
            },
            {
                'data': 'precio_venta'
            },
            {
                'data': 'cantidad'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ]
    });
    //Fin de Productos
    $('#t_historial_c').DataTable({
        ajax: {
            url: base_url + "Compras/listar_historial",
            dataSrc: ''
        },
        columns: [
            {
                'data': 'id'
            },
            {
                'data': 'total'
            },
            {
                'data': 'fecha'
            }
            //{
            //     'data': 'acciones'
            // },
            //{
            //    'data': 'acciones'
            //}
        ]
    });
})


//-----------------Funciones de Usuarios---------------
function frmUsuario() {
    document.getElementById("title").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    //document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    $("#nuevo_usuario").modal("show");
    document.getElementById("id").value = "";
}

function registrarUsuarios(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const clave = document.getElementById("clave");
    const caja = document.getElementById("caja");
    if (usuario.value == "" || nombre.value == "" || clave.value == "" || caja.value == "") {
        alertas('Los Campos son obligatorios', 'warning');
    } else {
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevo_usuario").modal("hide");
                alertas(res.msg, res.icono);
                tblUsuarios.ajax.reload();
            }
        }
    }
}

function btnEditarUser(id) {

    document.getElementById("title").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Usuarios/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            //document.getElementById("id").value = res.id;
            //document.getElementById("usuario").value = res.usuario;
            //document.getElementById("nombre").value = res.nombre;
            //document.getElementById("caja").value = res.id_caja;
            usuario = document.getElementById("id").value = res.id;
            usuario = document.getElementById("usuario").value = res.usuario;
            nombre = document.getElementById("nombre").value = res.nombre;
            caja = document.getElementById("caja").value = res.id_caja;
            $("#nuevo_usuario").modal("show");
        }
    }


}

function btnEliminarUser(id) {
    Swal.fire({
        title: '¿Estas seguro?',
        text: "!El usuario se va a deshabilitar!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Deshabilitar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Usuarios/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {

                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'Usuario eliminado correctamente',
                            'success'
                        )
                        tblUsuarios.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        )
                    }
                }
            }

        }
    })
}

function btnReingresarUser(id) {
    Swal.fire({
        title: '¿Estas seguro?',
        text: "!El usuario se va a habilitar!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Habilitar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Usuarios/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {

                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'Usuario habilitado correctamente',
                            'success'
                        )
                        tblUsuarios.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        )
                    }
                }
            }

        }
    })
}

function btnEliminarPerUser(id) {
    Swal.fire({
        title: '¿Estas seguro?',
        text: "!El usuario se va a Eliminar permanentemente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Usuarios/eliminarPer/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {

                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'Usuario Eliminado correctamente',
                            'success'
                        )
                        tblUsuarios.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        )
                    }
                }
            }

        }
    })
}





//-------------------Funciones de producto-------------------
function frmProducto() {
    document.getElementById("title").innerHTML = "Nuevo Producto";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmProducto").reset();
    document.getElementById("id").value = "";
    $("#nuevo_producto").modal("show");
}
function registrarPro(e) {
    e.preventDefault();
    const codigo = document.getElementById("codigo");
    const nombre = document.getElementById("nombre");
    const precio_compra = document.getElementById("precio_compra");
    const precio_venta = document.getElementById("precio_venta");
    const stock = document.getElementById("stock")
    const id_medida = document.getElementById("medida");
    const id_cat = document.getElementById("categoria");
    if (codigo.value == "" || nombre.value == "" || precio_compra.value == "" || precio_venta.value == "" || stock.value == "") {
        Swal.fire({
            icon: 'error',
            title: 'Campos obligatorios',
            showConfirmButton: false,
            timer: 3000
        })
    } else {
        const url = base_url + "Productos/registrar";
        const frm = document.getElementById("frmProducto");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                         icon: 'success',
                        title: 'Producto registrado',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_producto").modal("hide");
                    tblProductos.ajax.reload();

                } else if (res == "modificado") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto modificado',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $("#nuevo_producto").modal("hide");
                    tblProductos.ajax.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            }
        }
    }
}
function btnEditarPro(id) {

    document.getElementById("title").innerHTML = "Actualizar Producto";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Productos/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("codigo").value = res.codigo;
            document.getElementById("nombre").value = res.descripcion;
            document.getElementById("precio_compra").value = res.precio_compra;
            document.getElementById("precio_venta").value = res.precio_venta;
            document.getElementById("stock").value = res.cantidad;
            document.getElementById("medida").value = res.id_medida;
            document.getElementById("categoria").value = res.id_categoria;
            $("#nuevo_producto").modal("show");
        }
    }


}

function btnEliminarPro(id) {
    Swal.fire({
        title: '¿Estas seguro?',
        text: "!El producto se va a deshabilitar!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Deshabilitar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Productos/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {

                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'Producto deshabilitado correctamente',
                            'success'
                        )
                        tblProductos.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        )
                    }
                }
            }

        }
    })
}

function btnReingresarPro(id) {
    Swal.fire({
        title: '¿Estas seguro?',
        text: "!El producto se va a habilitar!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Habilitar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Productos/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {

                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'Producto habilitado correctamente',
                            'success'
                        )
                        tblProductos.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        )
                    }
                }
            }

        }
    })
}

function btnEliminarPerPro(id) {
    Swal.fire({
        title: '¿Estas seguro?',
        text: "!El producto se va a Eliminar permanentemente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Productos/eliminarPer/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {

                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'Producto eliminado correctamente',
                            'success'
                        )
                        tblProductos.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        )
                    }
                }
            }

        }
    })
}



//------------Funciones de Compras-------------------------

function buscarCodigo(e) {
    e.preventDefault();
    if (e.which == 13) {
        const cod = document.getElementById("codigo").value;
        const url = base_url + "Compras/buscarCodigo/" + cod;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res) {
                    document.getElementById("nombre").value = res.descripcion;
                    document.getElementById("precio").value = res.precio_compra;
                    document.getElementById("id").value = res.id;
                    document.getElementById("cantidad").focus();
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'El producto no existe',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    document.getElementById("codigo").value = '';
                    document.getElementById("codigo").focus();
                }


            }
        }
    }
}

function calcularPrecio(e) {
    e.preventDefault();
    const cant = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio").value;
    document.getElementById("sub_total").value = precio * cant;
    if (e.which == 13) {
        if (cant > 0) {
            const url = base_url + "Compras/ingresar";
            const frm = document.getElementById("frmCompra");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == 'ok') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Ingresado',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        frm.reset();
                        cargarDetalle();
                    } else if (res == 'modificado') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Actualizado',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        frm.reset();
                        cargarDetalle();
                    }

                }
            }
        }
    }

}
cargarDetalle();

function cargarDetalle() {
    const url = base_url + "Compras/listar";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let html = '';
            res.detalle.forEach(row => {
                html += `<tr>
               <td>${row['id']}</td>
               <td>${row['descripcion']}</td>
               <td>${row['cantidad']}</td>
               <td>${row['precio']}</td>
               <td>${row['sub_total']}</td>
               <td>
               <button class="btn btn-danger" type="button" onclick="deleteDetalle(${row['id']});"><i class="fas fa-trash-alt"></i></button>
               </td>
               </tr>`;
            });
            document.getElementById("tblDetalle").innerHTML = html;
            document.getElementById("total").value = res.total_pagar.total;
        }
    }
}

function deleteDetalle(id) {
    const url = base_url + "Compras/delete/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == 'ok') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Producto eliminado',
                    showConfirmButton: false,
                    timer: 3000
                })
                cargarDetalle();
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error al Eliminar',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
        }
    }
}

function generarCompra() {
    Swal.fire({
        title: '¿Estas seguro de realizar compra?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Compras/registrarCompra";
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.msg == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'Compra Realizada',
                            'success'
                        )
                        setTimeout(() => {
                            window.location.reload();
                        }, 300);
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res.msg,
                            'error'
                        )
                    }
                }
            }
        }

    })
}

function alertas(mensaje, icono) {
    Swal.fire({
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    })
}

reporteStock();
productosVendidos();
function reporteStock() {
    const url = base_url + "Administracion/reporteStock";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let nombre = [];
            let cantidad = [];
            for (let i = 0; i < res.length; i++) {
                nombre.push(res[i]['descripcion']);
                cantidad.push(res[i]['cantidad']);

            }
            var ctx = document.getElementById("stockMinimo");
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: nombre,
                    datasets: [{
                        data: cantidad,
                        backgroundColor: ['#ff6961', '#77dd77', '#fdfd96', '#84b6f4', '#fdcae1'],
                    }],
                },
            });
        }
    }
}

function productosVendidos() {
    const url = base_url + "Administracion/productosVendidos";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let nombre = [];
            let cantidad = [];
            for (let i = 0; i < res.length; i++) {
                nombre.push(res[i]['descripcion']);
                cantidad.push(res[i]['total']);

            }
            var ctx = document.getElementById("productosVendidos");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                //doughnut
                data: {
                    labels: nombre,
                    datasets: [{
                        data: cantidad,
                        backgroundColor: ['#ff6961', '#77dd77', '#fdfd96', '#84b6f4', '#fdcae1'],
                    }],
                },
            });
        }
    }
}









