<?php

session_start();

require "../html/components/head.html";

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
<section name="ver" style="text-align: center";>
    <div>
        <h2>Ver Ficheiros</h2>
        <?php
        $ficheiros = scandir("../assets/ficheiros");
        for ($a = 2; $a < count($ficheiros); $a++) {
            ?>
            <p>
                <a href="../assets/ficheiros/<?php echo $ficheiros[$a] ?>">
                    <?php echo $ficheiros[$a] ?>
                </a>
            </p>
            <?php
        }
        ?>
    </div>
    </section>
<hr>

    <section name="descarregar" style="text-align: center";>
    <div>
        <h2>Descarregar Ficheiros</h2>
        <?php
        for ($a = 2; $a < count($ficheiros); $a++) {
            ?>
            <p>
                <a download="<?php echo $ficheiros[$a] ?>" href="../assets/ficheiros/<?php echo $ficheiros[$a] ?>">
                    <?php echo $ficheiros[$a] ?>
                </a>
            </p>
            <?php
        }
        ?>
    </div>
    </section>
<hr>

    <section name="carregar" style="text-align: center";>
        <form method="POST" enctype="multipart/form-data" action="../php/processupload.php">
            <input type="file" name="ficheiro">
            <input type="submit" value="Carregar">
        </form>
    </section>
<hr>




</body>
</html>
