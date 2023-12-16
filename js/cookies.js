document.addEventListener("DOMContentLoaded", function () {
    var lembrarUsuarioCookie = getCookie("lembrar_usuario");

    if (lembrarUsuarioCookie) {
        var userData = JSON.parse(lembrarUsuarioCookie);
        var emailInput = document.getElementById("email");

        if (emailInput) {
            emailInput.value = userData.email;
        }

        // Adicione esta parte para criar um dropdown
        var emailDropdown = document.getElementById("emailDropdown");

        if (emailDropdown) {
            // Adicione o e-mail ao dropdown
            var option = document.createElement("option");
            option.text = userData.email;
            emailDropdown.add(option);
        }
    }
});

function getCookie(name) {
    var cookies = document.cookie.split('; ');

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].split('=');
        if (cookie[0] === name) {
            return decodeURIComponent(cookie[1]);
        }
    }

    return null;
}
