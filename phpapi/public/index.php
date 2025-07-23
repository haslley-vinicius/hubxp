<?php
require_once './imports.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();

    if (isset($_SESSION['user'])) {
      header('Location: /dashboard.php');
      exit;
    }
}

?>

<?php if (!isset($_SESSION['user'])) { ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Login - Sistema de Produtos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php __DIR__ . '/../assets/css/style.css' ?>">
</head>

<body class="bg-light">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header text-center">Login</div>
          <div class="card-body">
            <form id="loginForm">
              <div class="mb-3">
                <label>Usuário</label>
                <input type="text" name="username" class="form-control" required>
              </div>
              <div class="mb-3">
                <label>Senha</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary w-100" name="btn-login" id="btn-login">Entrar</button>
              <div id="loginError" class="text-danger mt-2" style="display: none;"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="login.js" type="text/javascript"></script>
</body>

</html>

<?php } ?>