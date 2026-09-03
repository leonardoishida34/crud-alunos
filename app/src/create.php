<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];
    $data_matricula = $_POST['data_matricula'];

    $stmt = $pdo->prepare("INSERT INTO alunos (nome, email, curso, data_matricula) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $curso, $data_matricula]);

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Aluno</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Aluno</h1>

        <form method="POST" action="create.php">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="curso">Curso</label>
            <input type="text" id="curso" name="curso" required>

            <label for="data_matricula">Data de Matrícula</label>
            <input type="date" id="data_matricula" name="data_matricula" required>

            <button type="submit" class="btn btn-save">Salvar</button>
        </form>

        <p><a href="index.php">&larr; Voltar para a listagem</a></p>
    </div>
</body>
</html>