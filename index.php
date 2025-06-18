<?php
session_start();
include_once('conexao.php');

$mensagemErro = '';

if (isset($_POST['submit'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Proteção contra SQL Injection
    $usuario = mysqli_real_escape_string($conexao, $usuario);
    $senha = mysqli_real_escape_string($conexao, $senha);

    // Consulta no banco
    $query = "SELECT * FROM usuarios WHERE nome = '$usuario' LIMIT 1";
    $result = mysqli_query($conexao, $query);
    $usuario_encontrado = mysqli_fetch_assoc($result);

    if ($usuario_encontrado) {
        // Comparação direta (sem criptografia)
        if ($senha === $usuario_encontrado['senha']) {
            $_SESSION['usuario'] = $usuario;
            header("Location: home.html");
            exit;
        } else {
            $mensagemErro = "Senha incorreta.";
        }
    } else {
        $mensagemErro = "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login do Bibliotecário - EEEP</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #4CAF50, #FF9800);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-container {
      background-color: #fff;
      padding: 2rem;
      border-radius: 16px;
      box-shadow: 0 0 15px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 380px;
      border-top: 10px solid #4CAF50;
    }
    .login-container h2 {
      text-align: center;
      margin-bottom: 1rem;
      color: #4CAF50;
    }
    .role-label {
      text-align: center;
      font-size: 0.95rem;
      color: #555;
      margin-bottom: 1.5rem;
    }
    .input-group {
      margin-bottom: 1.2rem;
    }
    .input-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: bold;
      color: #333;
    }
    .input-group input {
      width: 100%;
      padding: 0.65rem;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    .login-button {
      width: 100%;
      padding: 0.75rem;
      background-color: #FF9800;
      border: none;
      border-radius: 8px;
      color: white;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .login-button:hover {
      background-color: #e68900;
    }
    .footer {
      text-align: center;
      margin-top: 1rem;
      font-size: 0.85rem;
      color: #666;
    }
    .error {
      color: red;
      font-size: 0.9rem;
      text-align: center;
      margin-top: 0.5rem;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Biblioteca EEEP</h2>
    <div class="role-label">Login do Bibliotecário</div>

    <form method="post" id="loginForm">
      <div class="input-group">
        <label for="usuario">Usuário</label>
        <input type="text" id="usuario" name="usuario" placeholder="Digite seu usuário" required />
      </div>
      <div class="input-group">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required />
      </div>
      <button type="submit" name="submit" class="login-button">Entrar</button>
    </form>

    <?php if (!empty($mensagemErro)): ?>
      <div class="error"><?= htmlspecialchars($mensagemErro) ?></div>
    <?php endif; ?>

    <div class="footer">© 2025 - Rede de Bibliotecas EEEP - Ceará</div>
  </div>
</body>
</html>
