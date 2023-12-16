$(document).ready(function() {
    var nome = document.getElementById("nome").textContent;
    var tipo = document.getElementById("tipo").textContent;

    $.ajax({
        url: '../php/indexLogic.php', 
        type: 'GET',
        dataType: 'json',
        data: { nome: nome, tipo: tipo },  // Include data in the request
        success: function(data) {
            console.log(data);

            if (data.error) {
                // Handle the error condition
                console.error('Error from server:', data.error);
            } else {
                // Process the data as needed
                console.log('Received data:', data);
                // Example: Update the DOM with received data
                $('#nome').text(data.nome);
                $('#tipo').text(data.tipo);
            }
        },
        error: function(xhr, status, error) {
            console.error('Erro ao obter dados:', status, error);
        }
    });
});
