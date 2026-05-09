const form = document.querySelector('#producto-form');
const mensaje = document.querySelector('#mensaje');
const tbody = document.querySelector('#tbody');
const btnConsultar = document.querySelector('#btn-consultar');
const btnEliminar = document.querySelector('#btn-eliminar');

function mostrarMensaje(texto, tipo = 'info') {
    mensaje.textContent = texto;
    mensaje.className = `mensaje mensaje--${tipo}`;
}

function crearCelda(texto) {
    const celda = document.createElement('td');
    celda.textContent = texto;
    return celda;
}

function obtenerFormData() {
    return new FormData(form);
}

async function enviarFormulario(url, formData) {
    const respuesta = await fetch(url, {
        method: 'POST',
        body: formData,
    });
    const data = await respuesta.json();

    if (!respuesta.ok) {
        throw new Error(data.message || 'Ocurrio un error.');
    }

    return data;
}

async function cargarProductos() {
    tbody.innerHTML = '<tr><td colspan="4">Cargando productos...</td></tr>';

    try {
        const respuesta = await fetch('datos.php');
        const productos = await respuesta.json();

        if (!productos.length) {
            tbody.innerHTML = '<tr><td colspan="4">No hay productos registrados.</td></tr>';
            return;
        }

        tbody.innerHTML = '';
        productos.forEach((producto) => {
            const fila = document.createElement('tr');
            fila.append(
                crearCelda(producto.idpro),
                crearCelda(producto.nombre),
                crearCelda(`$${Number(producto.precio).toFixed(2)}`),
                crearCelda(producto.existencia),
            );
            tbody.append(fila);
        });
    } catch (error) {
        tbody.innerHTML = '<tr><td colspan="4">No se pudieron cargar los productos.</td></tr>';
        mostrarMensaje(error.message, 'error');
    }
}

form.addEventListener('submit', async (event) => {
    event.preventDefault();

    try {
        const data = await enviarFormulario('insertar.php', obtenerFormData());
        mostrarMensaje(data.message, 'success');
        form.reset();
        await cargarProductos();
    } catch (error) {
        mostrarMensaje(error.message, 'error');
    }
});

btnConsultar.addEventListener('click', async () => {
    const formData = obtenerFormData();

    try {
        const data = await enviarFormulario('consultar.php', formData);
        form.idpro.value = data.data.idpro;
        form.nombre.value = data.data.nombre;
        form.precio.value = data.data.precio;
        form.existencia.value = data.data.existencia;
        mostrarMensaje('Producto encontrado.', 'success');
    } catch (error) {
        mostrarMensaje(error.message, 'error');
    }
});

btnEliminar.addEventListener('click', async () => {
    const formData = obtenerFormData();

    try {
        const data = await enviarFormulario('eliminar.php', formData);
        mostrarMensaje(data.message, 'success');
        form.reset();
        await cargarProductos();
    } catch (error) {
        mostrarMensaje(error.message, 'error');
    }
});

cargarProductos();
