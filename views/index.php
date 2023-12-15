<?php

session_start();

require "../html/components/head.html";

if (!isset($_SESSION["user"])){

    header("Location: ../views/login.php");
  }


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
            <div class="col-lg-12 mb-4 order-0">
              <div class="card">
                <div class="d-flex align-items-end row">
                  <div class="col-sm-7">
                    <div class="card-body">
                      <h5 class="card-title text-primary">Olá, <?php echo ("Utilizador") ?> 🎉</h5>


                    </div>
                  </div>
                  <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">

                    </div>
                  </div>
                </div>
              </div>
            </div>



          </div>
          <div class="row">
            <!-- Order Statistics -->
            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
              <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                  <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Ficheiros submetidos por você</h5>
                    <small class="text-muted">um total de <?php echo ("NUMERO TOTAL"); ?></small>
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                      <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                      <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                      <a class="dropdown-item" href="javascript:void(0);">Share</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column align-items-center gap-1">
                      <h2 class="mb-2">8,258</h2>
                      <span>Total Orders</span>
                    </div>

                  </div>
                  <ul class="p-0 m-0">
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <h6 class="mb-0">Electronic</h6>
                          <small class="text-muted">Mobile, Earbuds, TV</small>
                        </div>
                        <div class="user-progress">
                          <small class="fw-semibold">82.5k</small>
                        </div>
                      </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <h6 class="mb-0">Fashion</h6>
                          <small class="text-muted">T-shirt, Jeans, Shoes</small>
                        </div>
                        <div class="user-progress">
                          <small class="fw-semibold">23.8k</small>
                        </div>
                      </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <h6 class="mb-0">Decor</h6>
                          <small class="text-muted">Fine Art, Dining</small>
                        </div>
                        <div class="user-progress">
                          <small class="fw-semibold">849k</small>
                        </div>
                      </div>
                    </li>
                    <li class="d-flex">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-secondary"><i class="bx bx-football"></i></span>
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <h6 class="mb-0">Sports</h6>
                          <small class="text-muted">Football, Cricket Kit</small>
                        </div>
                        <div class="user-progress">
                          <small class="fw-semibold">99</small>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!--/ Order Statistics -->

            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
              <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                  <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Ficheiros protegidos</h5>
                    <small class="text-muted">um total de <?php echo ("NUMERO TOTAL"); ?></small>
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                      <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                      <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                      <a class="dropdown-item" href="javascript:void(0);">Share</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column align-items-center gap-1">
                      <h2 class="mb-2">8,258</h2>
                      <span>Total Orders</span>
                    </div>

                  </div>
                  <ul class="p-0 m-0">
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <h6 class="mb-0">Electronic</h6>
                          <small class="text-muted">Mobile, Earbuds, TV</small>
                        </div>
                        <div class="user-progress">
                          <small class="fw-semibold">82.5k</small>
                        </div>
                      </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <h6 class="mb-0">Fashion</h6>
                          <small class="text-muted">T-shirt, Jeans, Shoes</small>
                        </div>
                        <div class="user-progress">
                          <small class="fw-semibold">23.8k</small>
                        </div>
                      </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <h6 class="mb-0">Decor</h6>
                          <small class="text-muted">Fine Art, Dining</small>
                        </div>
                        <div class="user-progress">
                          <small class="fw-semibold">849k</small>
                        </div>
                      </div>
                    </li>
                    <li class="d-flex">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-secondary"><i class="bx bx-football"></i></span>
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <h6 class="mb-0">Sports</h6>
                          <small class="text-muted">Football, Cricket Kit</small>
                        </div>
                        <div class="user-progress">
                          <small class="fw-semibold">99</small>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- Transactions -->
            <div class="col-md-6 col-lg-4 order-2 mb-4">
              <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h5 class="card-title m-0 me-2">Ficheiros públicos</h5>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                      <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                      <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                      <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <ul class="p-0 m-0">
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <small class="text-muted d-block mb-1">Paypal</small>
                          <h6 class="mb-0">Send money</h6>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-1">
                          <h6 class="mb-0">+82.6</h6>
                          <span class="text-muted">USD</span>
                        </div>
                      </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <img src="../assets/img/icons/unicons/wallet.png" alt="User" class="rounded" />
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <small class="text-muted d-block mb-1">Wallet</small>
                          <h6 class="mb-0">Mac'D</h6>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-1">
                          <h6 class="mb-0">+270.69</h6>
                          <span class="text-muted">USD</span>
                        </div>
                      </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <img src="../assets/img/icons/unicons/chart.png" alt="User" class="rounded" />
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <small class="text-muted d-block mb-1">Transfer</small>
                          <h6 class="mb-0">Refund</h6>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-1">
                          <h6 class="mb-0">+637.91</h6>
                          <span class="text-muted">USD</span>
                        </div>
                      </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <img src="../assets/img/icons/unicons/cc-success.png" alt="User" class="rounded" />
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <small class="text-muted d-block mb-1">Credit Card</small>
                          <h6 class="mb-0">Ordered Food</h6>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-1">
                          <h6 class="mb-0">-838.71</h6>
                          <span class="text-muted">USD</span>
                        </div>
                      </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <img src="../assets/img/icons/unicons/wallet.png" alt="User" class="rounded" />
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <small class="text-muted d-block mb-1">Wallet</small>
                          <h6 class="mb-0">Starbucks</h6>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-1">
                          <h6 class="mb-0">+203.33</h6>
                          <span class="text-muted">USD</span>
                        </div>
                      </div>
                    </li>
                    <li class="d-flex">
                      <div class="avatar flex-shrink-0 me-3">
                        <img src="../assets/img/icons/unicons/cc-warning.png" alt="User" class="rounded" />
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <small class="text-muted d-block mb-1">Mastercard</small>
                          <h6 class="mb-0">Ordered Food</h6>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-1">
                          <h6 class="mb-0">-92.45</h6>
                          <span class="text-muted">USD</span>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!--/ Transactions -->
          </div>
        </div>
        <!-- / Content -->

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
          <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
              @ 2023,Trabalho realizado por Hanna Paiva e Paulo César


            </div>

          </div>
        </footer>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
      </div>
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