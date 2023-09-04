<?php
session_start();
require_once 'header.php';

$isEditing = isset($_GET['id']);
if ($isEditing) {
    $productId = $_GET['id'];
    
    // Conecte-se ao banco de dados e busque os dados do produto com base no $productId
    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'crudproduto';
    
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    
    if ($conn->connect_error) {
        die('Falha ao conectar com o MySQL: ' . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM Produto WHERE id = $productId";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $produto = $result->fetch_assoc();
    } else {
        // Produto não encontrado, você pode lidar com isso de acordo com sua lógica
    }
    
    $conn->close();
}
?>

<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']); // Limpa a mensagem para que ela não seja exibida novamente
}
?>

<main role="main" class="flex-shrink-0">
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h2 class="mt-2">Editar Produto</h2>
        <form action="processar_produto.php" method="post">
        <?php if ($isEditing): ?>
            <!-- Se estiver editando, inclua um campo oculto para o ID do produto -->
            <input type="hidden" name="id" value="<?php echo $productId; ?>">
        <?php endif; ?>
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