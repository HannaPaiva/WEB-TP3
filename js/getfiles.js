function getFiles() {
    return $.ajax({
      method: "GET",
      url: "../php/getFiles.php",
      dataType: "json",
    });
  }
  
  $(document).ready(function () {
    getFiles()
      .done(function (files) {
        renderFiles(files);
      })
      .fail(function (error) {
        console.error("Erro ao obter dados da file:", error);
      });
  });
  










  
  function renderFiles(files) {
    // Seletor para o elemento onde você deseja adicionar a tabela
    var tableDiv = document.getElementById("tabela-files");
  
  
    tableDiv.innerHTML = `
  
  <style>
  td{
  width: 600px;
  }
  
  </style>
      <table class="table">
          <thead>
              <tr>
                  <th scope="col">Imagem</th>
                  <th scope="col">Nome</th>
                  <th scope="col">..</th>
              </tr>
          </thead>
          <tbody>
              ${files
                .map(
                  (file) => `
                  
                  <tr>
                      <td >${file.nomeficheiro}</td>
                      <td>${file.tipo}</td>
                      <td>${file.dataficheiro}</td>
                      <td>${file.enviado_Em}€</td>
                     
                  </tr>
              `
                )
                .join("")}
          </tbody>
      </table>
  `;
  }
  
  