<?php
include_once('conexao.php');

// Buscar livros no banco de dados
$livros = mysqli_query($conexao, "SELECT * FROM gerenciamentolivros ORDER BY idgen DESC");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Livros na Biblioteca - EEEP</title>
  <link rel="stylesheet" href="css/livros.css">
</head>
<body>
  <header>
    <h1>📚 Biblioteca EEEP</h1>
    <nav>
      <a href="livros.php">Início</a>
      <a href="gen.php">Gerenciar Livros</a>
      <a href="emp.html">Empréstimos</a>
      <a href="home.html">Sair</a>
    </nav>
  </header>

  <main>
    <h2>Livros na Biblioteca</h2>
    <table>
      <thead>
        <tr>
          <th>Título</th>
          <th>Autor</th>
          <th>Ano</th>
          <th>Quantidade</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($livros)) : ?>
          <tr>
            <td><?= htmlspecialchars($row['titulodolivro']) ?></td>
            <td><?= htmlspecialchars($row['autor']) ?></td>
            <td><?= htmlspecialchars($row['datadelançamento']) ?></td>
            <td><?= htmlspecialchars($row['quantidade']) ?></td>
            <td class="<?= $row['status'] === 'Disponível' ? 'status-disponivel' : 'status-emprestado' ?>">
              <?= htmlspecialchars($row['status']) ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </main>

  <footer>
    © 2025 - Sistema de Biblioteca EEEP | Governo do Estado do Ceará
  </footer>
</body>
</html>
