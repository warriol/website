// Enviar una solicitud al script PHP para registrar la visita
fetch('stats/register_visit.php', {
    method: 'GET'
})
    .then(response => response.json())
    .then(data => {
        console.log(data.message); // Mensaje de éxito
    })
    .catch(error => {
        console.error('Error al registrar la visita:', error);
    });
