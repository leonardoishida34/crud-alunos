<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];
    $data_matricula = $_POST['data_matricula'];

    $stmt = $pdo->prepare("UPDATE alunos SET nome = ?, email = ?, curso = ?, data_matricula = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $curso, $data_matricula, $id]);

    header('Location: index.php');
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = ?");
$stmt->execute([$id]);
$aluno = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$aluno) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Aluno</h1>

        <form method="POST" action="edit.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($aluno['id']) ?>">

            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($aluno['nome']) ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($aluno['email']) ?>" required>

            <label for="curso">Curso</label>
            <input type="text" id="curso" name="curso" value="<?= htmlspecialchars($aluno['curso']) ?>" required>

            <label for="data_matricula">Data de Matrícula</label>
            <input type="date" id="data_matricula" name="data_matricula" value="<?= htmlspecialchars($aluno['data_matricula']) ?>" required>

            <button type="submit" class="btn btn-save">Atualizar</button>
        </form>

        <p><a href="index.php">&larr; Voltar para a listagem</a></p>
    </div>
</body>
</html>