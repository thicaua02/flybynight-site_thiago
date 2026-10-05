<?php
// src/produto_crud.php

require_once "conecta.php";

function buscarProdutos(PDO $conexao) : array {
    $sql = "SELECT 
        produtos.nome AS produto, 
        produtos.preco, 
        fornecedores.nome AS fornecedor
        FROM produtos
        INNER JOIN fornecedores ON produtos.fornecedor_id = fornecedores.id;";
    $consulta = $conexao->query($sql);
    return $consulta->fetchAll();
}