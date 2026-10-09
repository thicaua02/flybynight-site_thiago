<?php
//buscarLojasProdutos -> ok
//inserirLojaProduto
//buscarLojaProdutoPorIds
//atualizarLojaProduto
//excluirLojaProduto
require_once "conecta.php";

function buscarLojasProdutos (PDO $conexao) : array {
    $sql = "SELECT 
                lojas_produtos.loja_id,
                lojas_produtos.produto_id,
                lojas_produtos.estoque
            FROM lojas_produtos 
            INNER JOIN lojas
            ON lojas_produtos.loja_id = lojas.id
            INNER JOIN produtos
            ON lojas_produtos.produto_id = produtos.id";
    $consulta = $conexao->query($sql);
    return $consulta->fetchAll();
}

