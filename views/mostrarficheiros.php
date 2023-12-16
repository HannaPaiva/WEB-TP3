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



                <style>
                  body {
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    background-color: #f0f0f0;
                  }

                  .add-button {
                    position: fixed;
                    bottom: 20px;
                    right: 20px;
                    width: 50px;
                    height: 50px;
                    background-color: #007bff;
                    color: #fff;
                    border: none;
                    border-radius: 50%;
                    font-size: 24px;
                    cursor: pointer;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    text-decoration: none;
                  }

                  .add-button:hover {
                    background-color: #0056b3;
                  }
                </style>
                <a href="#" class="add-button" data-bs-toggle="modal" data-bs-target="#exampleModal">+</a>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Seu Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="../php/postFiles.php" method="post" enctype="multipart/form-data">
                            Selecione um arquivo:
                            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" multiple><br>
                            <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="isPrivate">
                            <label class="form-check-label" for="defaultCheck1"> Privado </label><br>
                            Senha do arquivo (se privado):
                            <input class="form-control" type="password" name="passwordFicheiro"><br>
                            <input type="submit" value="Upload" name="submit">
                        </form>
                    </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <!-- Outros botões do rodapé, se necessário -->
                      </div>
                    </div>
                  </div>
                </div>

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