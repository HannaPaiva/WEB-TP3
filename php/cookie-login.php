<?php

// Função para definir o cookie "Lembre-se de mim"
function setRememberMeCookie($email) {
    // Defina os detalhes do cookie, como nome, valor, tempo de expiração, etc.
    $cookie_name = "lembrar_usuario";
    $cookie_value = $email; // Armazene user_id e email em um array
    $cookie_expiry = time() + (30 * 24 * 60 * 60); // 30 dias em segundos
    $cookie_path = "/";
    $cookie_domain = "localhost";
    echo $cookie_path;
    // Configura o cookie
    setcookie($cookie_name, $cookie_value, $cookie_expiry, $cookie_path, $cookie_domain);
}

// Função para remover o cookie "Lembre-se de mim"
function unsetRememberMeCookie() {
    $cookie_name = "lembrar_usuario";

    // Verifica se o cookie existe e o remove
    if (isset($_COOKIE[$cookie_name])) {
        unset($_COOKIE[$cookie_name]);
        setcookie($cookie_name, '', time() - 3600, '/'); // Expira o cookie (tempo negativo)
    }
}

?>
