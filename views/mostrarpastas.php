<?php
session_start();
require "../html/components/head.html";
require "../php/conn.php";




require '../php/conn.php';
$query = "
SELECT
p.idpasta,
p.nomepasta,
u.nome as utilizador, -- Adicionando o campo userid
GROUP_CONCAT(f.nomeficheiro) AS lista_de_ficheiros,
GROUP_CONCAT(f.id) AS lista_de_ids,
GROUP_CONCAT(f.tipo) AS lista_de_tipos,
GROUP_CONCAT(f.dataficheiro) AS lista_de_datas,
MAX(f.enviado_em) AS enviado_em_ultima_atualizacao
FROM
pasta p
LEFT JOIN acessos a ON p.idpasta = a.idpasta
LEFT JOIN ficheiros f ON a.fileid = f.id
LEFT JOIN utilizadores u ON a.userid = u.userid -- Adicionando o JOIN com utilizadores
GROUP BY
p.idpasta, p.nomepasta, u.userid -- Adicionando userid ao GROUP BY
ORDER BY
p.idpasta, enviado_em_ultima_atualizacao;

";

$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);











?>


<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    <?php require "../html/components/sidebar.html"; ?>

    <div class="layout-page">

      <?php require "../html/components/navbar.html"; ?>


      <script src="../js/pastas.js"></script>
      <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="row">
            <div class="card">
              <h5 class="card-header">Organização em pastas para download</h5>
              <div class="card-body">


                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Ficheiros na pasta</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                      </div>

                      <div class="modal-body" id="myModalContent">


                      </div>
                    </div>
                  </div>
                </div>





                <div id="tabela-pastas"></div>




                <div class="row">
                  <div class="col-md mb-4 mb-md-0">

                    <!-- <div class="accordion mt-3" id="accordionExample">
                      <div class="card accordion-item active">
                        <h2 class="accordion-header" id="headingOne">
                          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                            Accordion Item 1
                          </button>
                        </h2>

                        <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            Lemon drops chocolate cake gummies 
                          </div>
                        </div>
                      </div>

                    </div> -->





                    <div class="accordion mt-3" id="accordionExample">
                      <?php foreach ($result as $index => $item) : ?>
                        <div class="card accordion-item">
                          <h2 class="accordion-header" id="heading<?= $index ?>">
                            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="true" aria-controls="collapse<?= $index ?>">
                              <?= $item['utilizador'] . ' - ' . $item['nomepasta'] ?>
                            </button>
                          </h2>
                          <div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              <p>Nome dos ficheiros: <?= implode(', ', explode(',', $item['lista_de_ficheiros'])) ?></p>
                              <p>Enviado em: <?= $item['enviado_em_ultima_atualizacao'] ?></p>

                              <button class="btn btn-primary" onclick="window.location.href='../php/zipar.php?idpasta=<?= $item['idpasta'] ?>'">Baixar todos os arquivos</button>
                              <br>
                            </div>
                          </div>

                        
                </div>
                        </div>
                        <br>
         
                      <?php endforeach; ?>
                      
                    </div>
           <div id="accordionExample" class="accordion">


                      <!DOCTYPE html>
                      <html lang="pt-br">

                      <head>
                        <meta charset="UTF-8">
                        <title>Exibição de Dados</title>
                        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                      </head>

                      <body>


                      </body>

                      </html>





                    </div>

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


  <script>
    // $(document).ready(function () {
    //     $.ajax({
    //         url: '../php/getFolders.php', // Substitua com o caminho correto do seu arquivo PHP
    //         type: 'GET',
    //         dataType: 'json',
    //         success: function (data) {
    //             var accordion = $('#accordionExample');
    //             $.each(data, function (index, item) {
    //                 var accordionItem = '<div class="card accordion-item">' +
    //                     '<h2 class="accordion-header" id="heading' + index + '">' +
    //                     '<button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse' + index + '" aria-expanded="true" aria-controls="collapse' + index + '">' +
    //                     item.utilizador + ' - ' + item.nomepasta +
    //                     '</button>' +
    //                     '</h2>' +
    //                     '<div id="collapse' + index + '" class="accordion-collapse collapse" aria-labelledby="heading' + index + '" data-bs-parent="#accordionExample">' +
    //                     '<div class="accordion-body">' +

    //                     'Data Ficheiro: ' + item.dataficheiro + '<br>' +

    //                     'Enviado em: ' + item.enviado_em +
    //                     '</div>' +
    //                     '</div>' +
    //                     '</div>';
    //                 accordion.append(accordionItem);
    //             });
    //         },
    //         error: function (xhr, status, error) {
    //             console.log(xhr);
    //             console.log(status);
    //             console.log(error);
    //         }
    //     });
    // });
    // });


    $.ajax({
      url: '../php/getFolders.php',
      type: 'GET',

      success: function(data) {
        console.log(data)
        // var accordion = $('#accordionExample');
        // $.each(data, function (index, item) {
        //     var accordionItem = '<div class="card accordion-item">' +
        //         '<h2 class="accordion-header" id="heading' + index + '">' +
        //         '<button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse' + index + '" aria-expanded="true" aria-controls="collapse' + index + '">' +
        //         item.utilizador + ' - ' + item.nomepasta +
        //         '</button>' +
        //         '</h2>' +
        //         '<div id="collapse' + index + '" class="accordion-collapse collapse" aria-labelledby="heading' + index + '" data-bs-parent="#accordionExample">' +
        //         '<div class="accordion-body">' +

        //         // Modificando como você acessa os campos específicos
        //         'Lista de Ficheiros: ' + item.lista_de_ficheiros.join(', ') + '<br>' +
        //         'Lista de IDs: ' + item.lista_de_ids.join(', ') + '<br>' +
        //         'Lista de Tipos: ' + item.lista_de_tipos.join(', ') + '<br>' +
        //         'Lista de Datas: ' + item.lista_de_datas.join(', ') + '<br>' +

        //         'Enviado em: ' + item.enviado_em_ultima_atualizacao +
        //         '</div>' +
        //         '</div>' +
        //         '</div>';
        //     accordion.append(accordionItem);
        // });
      },
      error: function(xhr, status, error) {
        console.error('Erro na requisição AJAX:', status, error);
      }
    });
  </script>

  <script src="../js/pastas.js"></script>