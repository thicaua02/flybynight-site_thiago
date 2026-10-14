<?php
    require_once "../src/loja_crud.php";
    require_once "../src/produto_crud.php";
    require_once "../src/loja_produto_crud.php";

    $id_loja = $_GET['loja_id'];
    $id_produto = $_GET['produto_id'];
    $loja_produto = buscarLojaProdutoPorIds($conexao, $id_loja, $id_produto);
    $produtos = buscarProdutos($conexao);
    $lojas = buscarLojas($conexao);

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $loja = $_POST['loja'];
        $produto = $_POST['produto'];
        $estoque = $_POST['estoque'];

        atualizarLojaProduto($conexao, $loja, $produto, $id_loja, $id_produto, $estoque);
        header("location:listar.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar produto em uma loja - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'lojas_produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Editar produto em uma loja</h2>
        <!-- Modelo visual: os campos não são enviados nem persistidos. -->
        <!-- Os campos serão preenchidos com os dados do registro selecionado. -->
        <form action="" method="post">

            <div>
                <label for="loja">Loja:</label>
                <select name="loja" id="loja" required>
                    <?php foreach ($lojas as $loja): ?>
                        <option value="<?= $loja['id'] ?>" <?= $loja_produto['loja_id'] === $loja["id"] ? "selected" : "" ?>>
                            <?= $loja['nome'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div>
                <label for="produto">Produto:</label>
                <select name="produto" id="produto" required>
                    <!-- As opções serão preenchidas com os registros do banco de dados. -->
                    <?php foreach ($produtos as $produto): ?>
                        <option value="<?= $loja['id'] ?>" <?= $loja_produto['produto_id'] === $produto["id"] ? "selected" : "" ?>>
                            <?= $produto['nome_produto'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div>
                <label for="estoque">Estoque:</label>
                <input type="number" name="estoque" id="estoque" min="0" step="1" required value="<?= $loja_produto['estoque'] ?>">
            </div>
            <button type="submit">Atualizar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>