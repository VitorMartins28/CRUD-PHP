<?php
session_start();
require_once 'header.php';
?>

<main role="main" class="flex-shrink-0">
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h2 class="mt-2">Cadastro de Produto</h2>
        <form action="processar_produto.php" method="post">
          <?php include_once 'formulario_produto.php'; ?>
        </form>
      </div>
      <div class=" col-md-3"></div>
    </div>
  </div>
</main>
<?php
require_once 'footer.php';
?>


<script>
    // Verifique se há uma mensagem de sucesso ou erro e exiba um alerta correspondente
    <?php
    if (isset($_SESSION['success_msg'])) {
        echo "alert('{$_SESSION['success_msg']}');";
        unset($_SESSION['success_msg']);
    }
    if (isset($_SESSION['error_msg'])) {
        echo "alert('{$_SESSION['error_msg']}');";
        unset($_SESSION['error_msg']);
    }
    ?>
</script>

