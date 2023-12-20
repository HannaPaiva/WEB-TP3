<?php

session_start();

require "../html/components/head.html";


if (!isset($_SESSION["user"])) {
  // if (!isset($_SESSION["user"])){

  header("Location: ../views/login.php");
}



//     header("Location: ../views/login.php");
//   }
require '../php/indexLogic.php';

?>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Menu -->

    <?php require "../html/components/sidebar.html"; ?>
    <!-- / Menu -->

    <!-- Layout container -->
    <div class="layout-page">
      <!-- Navbar -->

      <?php require "../html/components/navbar.html"; ?>


      <!-- / Navbar -->

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
        
          <div class="row">
            <!-- Order Statistics -->
            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
              <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                  <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Ficheiros submetidos por você</h5>
                    <br>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column align-items-center gap-1">
                      <h2 class="mb-2"><?php echo buscarFicheirosporEu(); ?></h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Order Statistics -->

            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
              <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                  <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Ficheiros protegidos</h5>
                    <br>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column align-items-center gap-1">
                      <h2 class="mb-2"><?php echo buscarFicheirosProtegidos(); ?></h2>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <!-- Transactions -->
            <div class="col-md-6 col-lg-4 order-2 mb-4">
              <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h5 class="card-title m-0 me-2">Ficheiros públicos</h5>
                </div>
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column align-items-center gap-1">
                      <h2 class="mb-2"><?php echo buscarFicheirosPublicos(); ?></h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Transactions -->
          </div>


          <div class="row">
            <div class="col-lg-12 mb-4 order-0">
              <div class="card">
                <div class="d-flex align-items-end row">
                  <div class="col-sm-7">
                    <div class="card-body">
                      <h5 class="card-title text-primary">
                        Olá, <?php echo buscarUsername(); ?>
                      </h5>


                      <h6>As suas últimas ações:</h6>

                
                      <table class="table  table-bordered ">
                        <thead>
                          <tr>
                            <th>Dados</th>
                            <th>Hora</th>
                          </tr>
                        </thead>
                        <tbody id="dadosTableBody">
                          <!-- Os dados serão exibidos aqui -->
                        </tbody>
                  

                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- / Content -->

        <!-- Footer -->
  
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
      </div>
      <footer class="content-footer footer bg-footer-theme">
          <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
              @ 2023,Trabalho realizado por Hanna Paiva e Paulo César


            </div>

          </div>
        </footer>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->


</body>

</html>

<script>
  function exibirDadosNaTabela(dadosArray) {
    var tabelaBody = $('#dadosTableBody');

    // Limpa o corpo da tabela antes de adicionar novos dados
    tabelaBody.empty();

    // Itera sobre os dados e adiciona linhas à tabela
    dadosArray.forEach(function(dados) {
      var newRow = $('<tr>');

      newRow.append('<td>' + dados.mensagem + '</td>');
      newRow.append('<td>' + dados.hora + '</td>');
      tabelaBody.append(newRow);
    });
  }

  // Faz uma requisição AJAX para obter os dados dos cookies
  $.ajax({
    type: 'GET',
    url: '../php/getCookies.php', // O nome do arquivo PHP que contém o código de obtenção dos cookies
    dataType: 'json',
    success: function(data) {
      // Chama a função para exibir os dados na tabela
      exibirDadosNaTabela(data);
    },
    error: function(error) {
      console.error('Erro ao obter os dados dos cookies:', error);
    }
  });
</script>