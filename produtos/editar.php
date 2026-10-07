<?php
    // Importação
    require_once "../src/produto_crud.php";
    require_once "../src/fornecedor_crud.php";

    $id = $_GET['id'];
    $fornecedores = buscarFornecedores($conexao);
    $produto = buscarProdutoPorId($conexao, $id);

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $quantidade = $_POST['quantidade'];
        $fornecedorId = $_POST['fornecedor'];
        
        atualizarProduto($conexao, $id, $nome, $descricao, $preco, $quantidade, $fornecedorId);
        header("location:listar.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar produto - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Editar produto</h2>
        <!-- Modelo visual: os campos não são enviados nem persistidos. -->
        <!-- Os campos serão preenchidos com os dados do registro selecionado. -->
        <form action="" method="post">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" maxlength="100" value="<?= $produto['nome']; ?>" required>
            </div>
            <div>
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="5"><?= $produto['descricao']; ?></textarea>
            </div>
            <div>
                <label for="preco">Preço:</label>
                <input type="number" name="preco" id="preco" min="0" step="0.01" value="<?= $produto['preco']; ?>" required>
            </div>
            <div>
                <label for="quantidade">Quantidade:</label>
                <input type="number" name="quantidade" id="quantidade" min="0" step="1" value="<?= $produto['quantidade']; ?>" required>
            </div>
            <div>
                <label for="fornecedor">Fornecedor:</label>
                <select name="fornecedor" id="fornecedor" required>
                    <?php foreach ($fornecedores as $fornecedor): ?>
                        <!-- Desafio -->
                        <!-- O fornecedor daquele produto que está sendo exibido, JÁ DEVE VIR SELECIONADO. programe os recursos para isso acontecer. -->
                        <?php $selecao = $produto['fornecedor_id'] === $fornecedor['id'] ? "selected" : "" ?>
                        <option value="<?= $fornecedor['id'] ?>" <?= $selecao ?>><?= $fornecedor['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Atualizar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>