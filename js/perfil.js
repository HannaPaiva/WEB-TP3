// $(document).ready(function() {
//     var nome = document.getElementById("nome").textContent;
//     var tipo = document.getElementById("tipo").textContent;

   
//     function getdados() {
//         return $.ajax({
//           method: "GET",
//           url: "../php/indexLogic.php",
//           dataType: "json",
//         });
//       }
      

//       getdados()
//       .done(function (dados) {
//         document.getElementById("nome").textContent = dados.nome;
//         var nome = document.getElementById("nome").textContent = dados.tipo;
//        tipo = dados.tipo;
//       })
//       .fail(function (error) {
//         console.error("Erro ao obter dados dos produtos.. ", error);
//       });

// });





function fetchData() {
    $.ajax({
        url: '../php/indexa.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
       
            console.log(data);
        },
        error: function(error) {
            console.log('Erro na requisição AJAX:', error);
        }
    });
}

// Função para exibir os dados no elemento h5
function displayData(data) {
    // Atribui o valor do campo 'nome' ao elemento com o ID 'nome'
    $('#nome').text("Nome: " + data.nome);

    // Atribui o valor do campo 'tipo' ao elemento com o ID 'tipo'
    $('#tipo').text("Tipo: " + data.tipo);
}
// Chama a função para buscar os dados ao carregar a página
fetchData();
