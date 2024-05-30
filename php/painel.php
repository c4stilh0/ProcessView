<?php
session_start();

if (isset($_SESSION['id'])) {
    die("Você não pode acessar essa página porque não está logado. <p><a href='../login-cliente.html'>Entrar</a></p>");
} else {
    header("Location: ../tela-processos.html");
}
?>