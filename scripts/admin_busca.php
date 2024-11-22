<?php
include 'conectar.php';

if (isset($_POST['buscar'])) {
    $email = $_POST['email'];

    // Usar prepared statements para evitar injeção de SQL
    $stmt = mysqli_prepare($conexao, "SELECT * FROM usuario WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);
?>
        <!DOCTYPE html>
        <html lang="pt-br">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>FactFlicks - cadastro</title>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
            <link
                href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
                rel="stylesheet" />
            <link rel="stylesheet" href="../css/index.css" />
        </head>

        <body>
            <!-- Sobreposição para escurecer o fundo -->
            <div class="background-overlay"></div>
            <div class="login-page">
                <form action="admin_editar.php" method="POST">
                    <div class="fieldset-body">
                        <div>
                            <div>
                                <h2>EDITOR DE PERFIL</h2>
                            </div>
                            <a href="../index.html"><i class="bi bi-x-circle"></i></a>
                        </div>
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
                        <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
                        <input type="text" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" readonly>
                        <input type="text" name="login" value="<?php echo htmlspecialchars($usuario['login']); ?>" required>
                        <input type="text" name="senha" placeholder="Nova senha:">
                        <input type="submit" value="Salvar Alterações">
                    </div>
                </form>
                <form action="admin_excluir.php" method="POST">
                    <div class="fieldset-body">
                        <h2>DELETAR PERFIL</h2>
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
                        <input type="submit" value="Excluir Usuário" style="background-color: red; color: white;">
                    </div>
                </form>
            </div>
            <!-- Elementos para a troca de imagens -->
            <div id="demo"></div>
            <div id="pagination"></div>
            <div id="details-even">
                <div class="place-box">
                    <div class="text"></div>
                </div>
                <div class="title-1"></div>
                <div class="title-2"></div>
                <div class="desc"></div>
                <div class="cta"></div>
            </div>
            <div id="details-odd">
                <div class="place-box">
                    <div class="text"></div>
                </div>
                <div class="title-1"></div>
                <div class="title-2"></div>
                <div class="desc"></div>
                <div class="cta"></div>
            </div>
            <div id="slide-numbers" style="display: none"></div>
            <script src="../js/index.js" defer></script>
        </body>

        </html>
<?php
    } else {
        echo "<script>alert('Usuário não encontrado.'); window.location.href='admin.php';</script>";
    }

    mysqli_close($conexao);
}
?>