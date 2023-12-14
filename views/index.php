<?php
session_start();

// Verifica se a sessão está definida e se o tipo de sessão é "admin"
if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == "admin") {
    require_once "../html/components/head.html";
    require_once "../html/components/navbar.html";
    require_once "../html/components/sidebarAdmin.html";
    require_once "../html/index.html";
    require_once "../html/sessao.html";
    require_once "../html/components/footer.html"; 
}

// Verifica se a sessão está definida e se o tipo de sessão é "cliente"
elseif (isset($_SESSION['tipo']) && $_SESSION['tipo'] == "cliente") {
    require_once "../html/components/head.html";
    require_once "../html/components/navbar.html";
    require_once "../html/components/sidebar.html";  
    require_once "../html/index.html";
    require_once "../html/sessao.html";
    require_once "../html/components/footer.html"; 
   
}

else {
    // Se nada estiver definido
    require_once "../html/components/head.html";
    require_once "../html/components/navbar.html";
    require_once "../html/components/sidebar.html"; 
    require_once "../html/index.html"; 
    require_once "../html/sessao.html";
    require_once "../html/components/footer.html"; 
   
}
?>
