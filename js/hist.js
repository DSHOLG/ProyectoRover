// Variables globales
var busqueda = '';
var resultados = [];

// Capturar el evento de cambio del input de búsqueda
document.getElementById('input-busqueda').addEventListener('input', function() {

    // Obtener la consulta de búsqueda
    busqueda = this.value;

    // Ejecutar la consulta a la base de datos
    $.ajax({
        url: '../historia.php',
        method: 'POST',
        data: {
            busqueda: busqueda
        },
        success: function(respuesta) {

            // Limpiar la lista de resultados
            resultados = [];

            // Añadir los resultados de la búsqueda a la lista
            for (var i = 0; i < respuesta.length; i++) {
                resultados.push(respuesta[i]);
            }

            // Actualizar la lista de resultados
            renderizarResultados();
        }
    });
});

// Función para renderizar los resultados
function renderizarResultados() {

    // Vaciar la lista de resultados
    var resultados = document.getElementById('resultados');
    resultados.innerHTML = '';

    // Añadir los resultados de la búsqueda a la lista
    for (var i = 0; i < resultados.length; i++) {
        resultados.innerHTML += '<li>' + resultados[i] + '</li>';
    }
}
