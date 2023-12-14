<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>


<section name="ver" style="text-align: center";>
    <div>
        <h2>Ver Ficheiros</h2>
        <?php
        $ficheiros = scandir("../assets/ficheiros");
        for ($a = 2; $a < count($ficheiros); $a++) {
            ?>
            <p>
                <a href="assets/ficheiros<?php echo $ficheiros[$a] ?>">
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
                <a download="<?php echo $ficheiros[$a] ?>" href="../assets/ficheiros<?php echo $ficheiros[$a] ?>">
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
        <form method="POST" enctype="multipart/form-data" action="upload.php">
            <input type="file" name="ficheiro">
            <input type="submit" value="Carregar">
        </form>
    </section>
<hr>




</body>
</html>
