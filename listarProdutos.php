<?php
require_once 'header.php';
?>

<main role="main" class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-2">Listagem de Produtos</h1>
    <?php
      //Credenciais para conexão com o Banco
      $dbhost = 'localhost:3306';
      $dbuser = 'root';
      $dbpass = '';
      $dbname = 'crudproduto';
      
      //Abre conexão com o MySQL   
      $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
      if(!$conn ){
        die('Falha ao conectar com o MySQL: ' . mysqli_connect_error());
      }
      //echo '<br>Conexão ao Banco realizada com Sucesso.';

      $sql = 'SELECT * FROM Produto';
      $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela
 
      if (mysqli_num_rows($result) > 0) {
        echo '<div class="table-responsive">';
        echo '  <table class="table table-bordered table-hover table-sm">';
        echo '    <thead >';
        echo '      <tr style="background-color: #bee5eb;">';
        echo '        <th class="info">Id</th>';
        echo '        <th class="info">Nome</th>';
        echo '        <th class="info">Descrição</th>';
        echo '        <th class="info">Preço</th>';
        echo '        <th class="info">Qtde.</th>';
        echo '        <th class="info">Cadastro</th>';
        echo '	      <th class="info"></th>';
        echo '      </tr>';
        echo '    </thead>';
        echo '    <tbody>';
        while ($row = mysqli_fetch_assoc($result)){
          echo '<tr>'; 
          echo '  <td>'.$row['id'].'</td>';
          echo '  <td>'.$row['nome'].'</td>';
          echo '  <td>'.$row['descricao'].'</td>';
          echo '  <td>'.$row['preco'].'</td>';
          echo '  <td>'.$row['quantidade'].'</td>';
          echo '  <td>'.$row['dataCadastro'].'</td>';
          echo ' <td> <a href="editarProduto.php?id='.$row['id'].'" class="btn btn-info btn-sm">Editar</a>
           <a href="excluirProduto.php?id='.$row['id'].'&nome='.$row['nome'].'" class="btn btn-danger btn-sm mt-1">Excluir</a>'; 
          echo '</tr>';

        }
        echo '    </tbody>';
        echo '  </table>';
        echo '</div>';
      }else {
        echo "Nenhum Produto Encontrado.";
      }


      //Fecha  a conexão
      mysqli_close($conn);
    ?>      

  </div>
</main>

<?php
require_once 'footer.php';
