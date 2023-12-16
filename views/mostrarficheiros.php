<?php
session_start();
require "../html/components/head.html";
require "../php/conn.php";
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
            <div class="card">
              <h5 class="card-header">Ficheiros disponíveis para download</h5>
              <div class="card-body">
               

          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Detalhes do Ficheiro</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                       
                      </div>
                      <div class="modal-body" id="myModalContent">
                        <!-- O conteúdo do modal será adicionado dinamicamente aqui -->
                      </div>
                    </div>
                  </div>
                </div>







                <div id="tabela-files"></div>
                <div id="fileList"></div>
                <script src="../js/teste1.js"></script>

                <form action="../php/postFiles.php" method="post" enctype="multipart/form-data">
                  Selecione um arquivo:
                  <input type="file" name="fileToUpload" id="fileToUpload">
                  <input type="submit" value="Upload" name="submit">
                </form>


      


              </div>
            </div>
          </div>
        </div>
        <!-- Other sections (ver, descarregar, carregar) go here -->
      </div>
    </div>
  </div>
</div>
</div>
<!-- Additional sections (ver, descarregar, carregar) go here -->
</body>

</html>