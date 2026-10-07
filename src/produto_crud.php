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

function inserirProduto(PDO $conexao, string $nome, string $descricao, float $preco, int $quantidade, int $fornecedor) : void {
    $sql = "INSERT INTO produtos (nome, descricao, preco, quantidade, fornecedor_id) VALUES (:nome, :descricao, :preco, :quantidade, :fornecedorID)";
    $consulta = $conexao->prepare($sql);

    $consulta->bindValue(":nome", $nome);
    $consulta->bindValue(":descricao", $descricao);
    $consulta->bindValue(":preco", $preco);
    $consulta->bindValue(":quantidade", $quantidade);
    $consulta->bindValue(":fornecedorID", $fornecedor);
    $consulta->execute();
}

function buscarProdutoPorId(PDO $conexao, int $id) : array {
    $sql = "SELECT * FROM produtos WHERE id = :id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(':id', $id);
    $consulta->execute();
    return $consulta->fetch();
}