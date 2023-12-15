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
                <div class="table-responsive text-nowrap">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Submetido por</th>
                        <th>Ficheiro</th>
                        <th>Permissões</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $ficheiros = scandir("../assets/ficheiros");
                      for ($a = 2; $a < count($ficheiros); $a++) {
                        ?>
                        <tr>
                          <td>
                            
                              </li>
                              <!-- Add more li elements for each user -->
                            </ul>
                          </td>
                          <td>
                            <a href="../assets/ficheiros/<?php echo $ficheiros[$a] ?>">
                              <?php echo $ficheiros[$a] ?>
                            </a>
                          </td>
                          <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          <i class="menu-icon tf-icons bx bx-cloud-download"></i>
                          </button>
                          </td>
                          
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>



<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../php/downloadficheiro.php" method="post">

          <div class="mb-3 row">
            <label for="html5-password-input" class="col-md-3 col-form-label">Password</label>
            <div class="col-md-8">
              <input class="form-control" type="password" name="password" id="html5-password-input" />
            </div>
          </div>
          <input type="hidden" name="idficheiro" value="" />

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>
      <form action="../php/processupload.php" method="post" enctype="multipart/form-data">
          <label for="file">Choose a file:</label><br>
          <input type="file" name="ficheiro"><br><br>
          <input type="submit" value="Upload File">
      </form>
            </div>
          </div>
        </div>

        <!-- Other sections (ver, descarregar, carregar) go here -->

      </div>
    </div>
  </div>
</div>

<!-- Additional sections (ver, descarregar, carregar) go here -->

</body>
</html>
