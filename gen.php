<?php
include_once('conexao.php');

if (isset($_POST['submit'])) {
  $titulo = $_POST['titulo'];
  $autor = $_POST['autor'];
  $ano = $_POST['ano'];
  $quantidade = $_POST['quantidade'];
  $status = $_POST['status'];

  // Inserção (ainda sem prepared statement, mas com escape básico se desejar)
  $resultado = mysqli_query($conexao, "INSERT INTO gerenciamentolivros(titulodolivro, autor, quantidade, datadelançamento, status) 
    VALUES('$titulo','$autor','$quantidade', '$ano', '$status')");

  // Redirecionamento para evitar reenvio ao atualizar
  header("Location: " . $_SERVER['PHP_SELF']);
  exit();
}

$livros = mysqli_query($conexao, "SELECT * FROM gerenciamentolivros ORDER BY idgen DESC");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gerenciar Livros - Biblioteca EEEP</title>
  <link rel="stylesheet" href="css/gen.css">
  <style>
    #pesquisa {
      margin: 20px 0;
      padding: 8px;
      width: 100%;
      max-width: 400px;
    }
  </style>
</head>
<body>
  <header>
    <h1>Biblioteca EEEP</h1>
    <nav>
      <a href="#">Início</a>
      <a href="livros.html">Livros</a>
      <a href="emp.html">Empréstimos</a>
      <a href="home.html">Sair</a>
    </nav>
  </header>

  <main>
    <h2>📚 Gerenciar Livros</h2>

    <form class="form-livro" method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
      <input type="text" name="titulo" placeholder="Título do Livro" required>
      <input type="text" name="autor" placeholder="Autor" required>
      <input type="date" name="ano" required>
      <input type="number" name="quantidade" placeholder="Quantidade" min="1" required>
      <select name="status">
        <option value="Disponível">Disponível</option>
        <option value="Emprestado">Emprestado</option>
      </select>
      <button type="submit" name="submit">Adicionar</button>
    </form>

    <input type="text" id="pesquisa" placeholder="🔍 Buscar livro por título...">

    <table>
      <thead>
        <tr>
          <th>Título</th>
          <th>Autor</th>
          <th>Ano</th>
          <th>Qtd.</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody id="tabela-livros">
        <?php while($row = mysqli_fetch_assoc($livros)) : ?>
          <tr>
            <td><?= htmlspecialchars($row['titulodolivro']) ?></td>
            <td><?= htmlspecialchars($row['autor']) ?></td>
            <td><?= htmlspecialchars($row['datadelançamento']) ?></td>
            <td><?= htmlspecialchars($row['quantidade']) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </main>

  <footer>
    © 2025 - Sistema de Biblioteca EEEP | Governo do Estado do Ceará
  </footer>

  <script>
    const campoPesquisa = document.getElementById("pesquisa");
    const linhasTabela = document.querySelectorAll("#tabela-livros tr");

    campoPesquisa.addEventListener("input", function () {
      const filtro = campoPesquisa.value.toLowerCase();
      linhasTabela.forEach(linha => {
        const titulo = linha.cells[0].textContent.toLowerCase();
        linha.style.display = titulo.includes(filtro) ? "" : "none";
      });
    });
  </script>
</body>
</html>
