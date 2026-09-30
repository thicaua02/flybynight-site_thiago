<?php
// fornecedores/listar.php

// Exportando o arquivo de funções CRUD para fornecedor
require_once "../src/fornecedor_crud.php";
$fornecedores = buscarFornecedores($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fornecedores - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'fornecedores';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Fornecedores</h2>
        <div class="barra-acoes"><a class="botao" href="inserir.php">+ Novo fornecedor</a></div>
        <!-- Os registros serão carregados dinamicamente quando o back-end for implementado. -->
        <div class="area-tabela" tabindex="0">
            <table>
                <caption>Relação de Fornecedores</caption>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aqui serão geradas as linhas com os dados e as ações Editar e Excluir de cada registro. -->
                    <?php foreach($fornecedores as $fornecedor): ?>
                        <tr>
                            <td><?= $fornecedor["id"]; ?></td>
                            <td><?= $fornecedor["nome"]; ?></td>
                            <td>
                                <!-- Link Dinâmico
                                 Além de definir a página a ser aberta/navegada (no caso, editar.php),
                                 também é necessário "informar" à página com qual resgistro ela irá
                                 trabalhar. Por isso, criamos um parâmetro (?id) e aplicamos à ele
                                 o valor dinâmica (id) do fornecedor.
                                 -->
                                <a href="editar.php?id=<?= $fornecedor['id'] ?>">Editar</a>
                                <a href="excluir.php?id=<?= $fornecedor['id'] ?>" class="excluir">Deletar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>