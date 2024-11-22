<?php
include 'conectar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE login='$login'";
    $result = mysqli_query($conexao, $sql);
    $usuario = mysqli_fetch_assoc($result);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        echo "<script>alert('Login realizado com sucesso!'); window.location.href='../index.html';</script>";
    } else {
        echo "<script>alert('Login ou senha incorretos!'); window.location.href='../pages/login.html';</script>";
    }

    mysqli_close($conexao);
}
