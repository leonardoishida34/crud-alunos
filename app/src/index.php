<?php
require 'config.php';

$stmt = $pdo->query("SELECT * FROM alunos ORDER BY id DESC");
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Alunos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Alunos</h1>
        <a class="btn btn-add" href="create.php">+ Novo Aluno</a>

        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Curso</th>
                <th>Data de Matrícula</th>
                <th>Ações</th>
            </tr>

            <?php if (count($alunos) === 0): ?>
                <tr>
                    <td colspan="6">Nenhum aluno cadastrado ainda.</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <td><?= htmlspecialchars($aluno['id']) ?></td>
                    <td><?= htmlspecialchars($aluno['nome']) ?></td>
                    <td><?= htmlspecialchars($aluno['email']) ?></td>
                    <td><?= htmlspecialchars($aluno['curso']) ?></td>
                    <td><?= htmlspecialchars($aluno['data_matricula']) ?></td>
                    <td>
                        <a class="btn btn-edit" href="edit.php?id=<?= $aluno['id'] ?>">Editar</a>
                        <a class="btn btn-delete" href="delete.php?id=<?= $aluno['id'] ?>"
                           onclick="return confirm('Tem certeza que deseja excluir este aluno?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>