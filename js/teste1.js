
$(document).ready(function() {
   
    $.ajax({
        url: '../php/getFiles.php', 
        type: 'GET',
        dataType: 'json',
        success: function(files) {
            displayFiles(files);
        },
        error: function(xhr, status, error) {
            console.error('Erro ao obter dados:', status, error);
        }
    });

    function displayFiles(files) {
        var table = $('<table>').addClass('table table-bordered'); // Adicione uma classe à tabela, se desejar
    
        // Cabeçalho da tabela
        var thead = $('<thead>').append(
            $('<tr>').append(
                $('<th>').text('Submetido por'),
                $('<th>').text('Nome do Ficheiro'),
                $('<th>').text('Data e hora de submissão'),
                $('<th>').text('Ações')
            )
        );
    
        table.append(thead);
    
        // Corpo da tabela
        var tbody = $('<tbody>');
    
 
        $.each(files, function (index, file) {
            var actionsColumn = $('<td>').append(
                $('<div>').addClass('dropdown').append(
                    $('<button>').addClass('btn p-0 dropdown-toggle hide-arrow').attr({
                        'type': 'button',
                        'data-bs-toggle': 'dropdown'
                    }).html('<i class="bx bx-dots-vertical-rounded"></i>'),
                    $('<div>').addClass('dropdown-menu').append(
                        // $('<a>').addClass('dropdown-item').attr('href', 'javascript:void(0);').html('<i class="bx bx-edit-alt me-1"></i> Edit'),
                        // $('<a>').addClass('dropdown-item').attr('href', 'javascript:void(0);').html('<i class="bx bx-trash me-1"></i> Delete'),
                        // $('<div>').addClass('dropdown-divider'),
                        $('<a>').addClass('dropdown-item').attr('href', 'javascript:void(0);').html('<i class="bx bx-download me-1"></i> Baixar').click(function () {
                            openModal(file.nomeficheiro, 'data:application/octet-stream;base64,' + file.dataficheiro, file.fileid);
                        })
                    )
                )
            );
    
            var row = $('<tr>').append(
                $('<td>').text(file.username), 
                $('<td>').text(file.nomeficheiro),
                $('<td>').text(file.enviado_em),
                actionsColumn
            );
            tbody.append(row);
        });
    
        table.append(tbody);
    
        // Adicione a tabela ao elemento com o id 'fileList' ou substitua pelo id desejado
        $('#fileList').append(table);
    }
    

  
    
    // Evento de envio do formulário
    $("#postFiles").submit(function (event) {
        // event.preventDefault();
        var input = document.getElementById('fileToUpload');
        var files = input.files;
   
        if (validateFileSize(files)) {
            var formData = new FormData();
            formData.append('password', $('#password').val()); // Certifique-se de ter um elemento de input com o id 'password'
    
            for (var i = 0; i < files.length; i++) {
                formData.append('fileToUpload[]', files[i]);
            }
    
            // Faz a solicitação AJAX
            $.ajax({
                type: 'POST',
                url: '../php/postFiles.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response); // Exibe a resposta no console
                
                    // Tente analisar o JSON apenas se a resposta parecer ser um JSON válido
                    try {
                        var jsonResponse = JSON.parse(response);
                
                        if (jsonResponse.status === "ok") {
                            // A solicitação foi bem-sucedida
                        
                            console.log("Sucesso: " + jsonResponse.message);
                        } else {
                            // A solicitação falhou
                            console.log("Erro: " + jsonResponse.message);
                        }
                    } catch (error) {
                        // Se não puder ser analisado como JSON, pode ser uma resposta de erro do servidor
                        console.log("Erro na resposta do servidor:", response);
                    }
                },
                error: function () {
                    // Trate erros aqui
                    console.log("Erro na solicitação AJAX");
                }
            });
        }
    });
    








    
});


function openModal(nomeficheiro, downloadLink, fileid) {
 
    $('#myModalContent').empty();

    $('#myModalContent').append(
        $('<p>').text('Nome do Ficheiro: ' + nomeficheiro),
        $('<input>').attr({
            'type': 'hidden',
            'id': 'fileid',
            'value': fileid
        }),

       $('<input>', {
            'class': 'form-control',
            'type': 'password',
            'id': 'filepassword',
            'name': 'filepassword',
            'placeholder': 'Escreva a password'
        }),
        $('<br>'),

        // Criar dinamicamente o botão
         $('<button>', {
            'class': 'btn btn-primary',
            'text': 'Verificar Password',
            'click': function() {
                validar_password_ficheiro();
            }
        }),
        $('<br>'),
        $('<br>'),
        $('<a>').addClass('btn disabled').attr({
            'id': 'downloadButton',
            'href': downloadLink,
            'download': nomeficheiro,
        }).text('Baixar Ficheiro')
    );

    // Abra o modal do Bootstrap
    $('#myModal').modal('show');
}




function validar_password_ficheiro(){

   
    var filepassword = $('#filepassword').val();
  
    var fileid = $('#fileid').val();

  
    $.ajax({
        type: 'POST',
        url: '../php/validacao.php',
        data: { filepassword: filepassword, fileid:fileid },
        
        success: function(response) {
      
            try {
                var jsonResponse = JSON.parse(response);
        
                if (jsonResponse.status === "ok") {
                    // A solicitação foi bem-sucedida
                
                    console.log("Sucesso: " + jsonResponse.message);
                    $('#downloadButton').removeClass('disabled');
                } else {
                    // A solicitação falhou
                    console.log("Erro: " + jsonResponse.message);
                    alert('Senha inválida. Tente novamente.' + response);
                }
            } catch (error) {
                // Se não puder ser analisado como JSON, pode ser uma resposta de erro do servidor
                console.log("Erro na resposta do servidor:", response);
            }



        },
        error: function(error) {
            console.log('Erro na validação da senha:', error);
        }
    });

}



function validateFileSize(files) {
    var maxFileSize = 10 * 1024 * 1024; // 10 MB (ajuste conforme necessário)

    for (var i = 0; i < files.length; i++) {
        if (files[i].size > maxFileSize) {
            alert('Erro: O tamanho do arquivo ' + (i + 1) + ' excede o limite permitido.');
            return false;
        }
    }

    return true;

}
function postFiles() {
    var input = document.getElementById('fileToUpload');
   
    var files = input.files;
 var password = document.getElementById('password').value;
    if (validateFileSize(files)) {
        var formData = new FormData();
        formData.append('password', password);
        for (var i = 0; i < files.length; i++) {
            formData.append('fileToUpload[]', files[i]);
        }

        $.ajax({
            type: 'POST',
            url: '../php/postFiles.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // mensagem de sucesso
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.log('Erro na chamada AJAX:');
                console.log('Status:', status);
                console.log('Erro:', error);
                console.log('Resposta do servidor:', xhr.responseText);
            }
        });
    }
}


