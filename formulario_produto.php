<form action="processar_produto.php" method="post">
    <div class="form-group">
        <?php if (isset($produto['id'])): ?>
            <!-- Se estiver editando, inclua um campo oculto para o id do produto -->
            <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="nome">Nome do Produto:</label>
        <input type="text" name="nome" class="form-control"
            value="<?php echo isset($produto['nome']) ? $produto['nome'] : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea name="descricao"
            class="form-control"><?php echo isset($produto['descricao']) ? $produto['descricao'] : ''; ?></textarea>
    </div>
    <div class="form-group">
        <label for="preco">Preço:</label>
        <input type="text" name="preco" class="form-control"
            value="<?php echo isset($produto['preco']) ? $produto['preco'] : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="quantidade">Quantidade:</label>
        <input type="number" class="form-control" name="quantidade"
            value="<?php echo isset($produto['quantidade']) ? $produto['quantidade'] : ''; ?>" required>
    </div>
    <input type="submit" class="btn btn-success btn-sm btn-block"
        value="<?php echo isset($produto['id']) ? 'Salvar Edição' : 'Cadastrar'; ?>">
</form>