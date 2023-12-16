

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
                            openModal(file.nomeficheiro, 'data:application/octet-stream;base64,' + file.dataficheiro);
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
    


});










function openModal(nomeficheiro, downloadLink) {
    // Limpe qualquer conteúdo existente no modal
    $('#myModalContent').empty();

    // Adicione o conteúdo ao modal
    $('#myModalContent').append(
        $('<p>').text('Nome do Ficheiro: ' + nomeficheiro),
        $('<a>').addClass('btn btn-success').attr({
            'href': downloadLink,
            'download': nomeficheiro
        }).text('Baixar Ficheiro')
    );

    // Abra o modal do Bootstrap
    $('#myModal').modal('show');
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
    var password = document.getElementById('password');
    var files = input.files;

    if (validateFileSize(files)) {
        var formData = new FormData();
        for (var i = 0; i < files.length; i++) {
            formData.append('fileToUpload[]', files[i]);
           
        }
        formData.append('password', password);

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