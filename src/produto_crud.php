<?php
// src/produto_crud.php

require_once "conecta.php";

function buscarProdutos(PDO $conexao) : array {
    $sql = "SELECT 
                produtos.id, 
                produtos.nome as nome_produto, 
                produtos.preco, 
                produtos.quantidade,
                fornecedores.nome as nome_fornecedor
            FROM produtos JOIN fornecedores
            ON fornecedores.id = produtos.fornecedor_id
            ORDER BY nome_produto";
    $consulta = $conexao->query($sql);
    return $consulta->fetchAll();
}