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


                      </div>
                    </div>
                  </div>
                </div>





                <div id="tabela-files"></div>
                <div id="fileList"></div>
                <script src="../js/ficheiros.js"></script>



                <style>
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
                        <h5 class="modal-title" id="exampleModalLabel">Submeter ficheiro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">


                        <form method="post" id="postFiles" name="postFiles" enctype="multipart/form-data">
                          Selecione um ou mais arquivos *

                          <input class="form-control" type="file" name="fileToUpload[]" id="fileToUpload" multiple required>

                          <br><br>
                          <div class="row">

                            <label> Password</label>
                            <div class="col-md-12">
                              <input class="form-control" type="password" id="password" name="password" placeholder="Escreva a password que deseja agregar aos ficheiros" />
                            </div>

                            <div class="row">
                              <div id="blocopasta">

                                <br><br>
                                <label> Nome da pasta</label>
                                <input class="form-control" type="text" id="nomepasta" name="nomepasta" placeholder="Escreva o nome da pasta" />
                              </div>

                            </div>

                          </div>

                          <br><br>
                          <div class="row">
                            <!-- <button class="btn btn-primary" type= "submit " onclick="postFiles()"> Enviar ficheiros </button> -->
                            <button class="btn btn-primary" type="submit "> Enviar ficheiros </button>
                          </div>
                        </form>



                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>

</body>

</html>