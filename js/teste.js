// function getFiles() {
//     return $.ajax({
//       method: "GET",
//       url: "../php/getFiles.php",
//       dataType: "json",
//     });
//   }
  
//   $(document).ready(function () {
//     getFiles()
//       .done(function (files) {
//         console.log(files);
//       })
//       .fail(function (error) {
//         console.error("Erro ao obter dados da file:", error);
//       });
//   });
  

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
        var fileList = $('#fileList');

        // Iterar sobre os arquivos e criar links para download
        $.each(files, function(index, file) {
            var downloadLink = $('<a>').attr({
                'href': 'data:application/octet-stream;base64,' + file.dataficheiro,
                'download': file.nomeficheiro
            }).text(file.nomeficheiro);

            var paragraph = $('<p>').append(downloadLink);
            fileList.append(paragraph);

           
        });





        
    }
});