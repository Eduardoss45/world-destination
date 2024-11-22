<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastro_de_clientes";

$conexao = mysqli_connect($servername, $username, $password, $dbname);

if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}
