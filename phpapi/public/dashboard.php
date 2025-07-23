<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();

    if (!isset($_SESSION['user'])) {
      header('Location: /');
      exit;
    }
}

?>

<?php if (isset($_SESSION['user'])) { ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>CRUD de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php __DIR__ . '/../assets/css/style.css' ?>">
</head>

<body>
    <div class="container py-4">
        <h2 class="mb-4">Produtos</h2>

        <div class="d-flex justify-content-between mb-3">
            <input type="text" id="search" class="form-control w-50" placeholder="Buscar produtos...">
            <button class="btn btn-secondary" name="btn-logout" id="btn-logout">Logout</button>
            
            <div>
                <button class="btn btn-danger" name="btn-del-all" id="btn-del-all">Deletar Todos</button>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">+ Novo Produto</button>
            </div>
        </div>

        <div id="feedback" class="mb-2"></div>
        <div id="loading" class="text-center text-primary" style="display:none;">Carregando...</div>

        <div id="productTable">
            <?php /*
                echo '<table class="table table-bordered table-hover">';
                echo '<thead><tr><th>ID</th><th>Nome</th><th>Preço</th><th>Ações</th></tr></thead>';
                echo '<tbody>';
                // foreach ($produtos as $p) {
                echo $_SESSION['produtos'];
                // foreach ($_SESSION['produtos'] as $p) {
                //     echo "<tr>
                //     <td>{$p['id']}</td>
                //     <td>{$p['name']}</td>
                //     <td>R$ ".number_format($p['price'], 2, ',', '.')."</td>
                //     <td>
                //         <button class='btn btn-sm btn-primary edit-btn' data-id='{$p['id']}'>Editar</button>
                //         <button class='btn btn-sm btn-danger delete-btn' data-id='{$p['id']}'>Excluir</button>
                //     </td>
                //     </tr>";
                // }
                echo '</tbody>';
                echo '</table>';

                */
            ?>
            <!-- <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Próxima</a></li>
                </ul>
            </nav> -->
        </div>
    </div>
    <div id="listError" class="text-danger mt-2" style="display: none;"></div>

    <!-- Modais -->
    <?php include '../modals/modal_create.php'; ?>
    <?php include '../modals/modal_edit.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="main.js" type="text/javascript"></script>
</body>

</html>

<?php } ?>