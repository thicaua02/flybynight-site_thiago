<?php
// src/produto_crud.php

require_once "conecta.php";

function buscarProdutos(PDO $conexao) : array {
    $sql = "SELECT 
                id, nome, preco, quantidade 
            FROM produtos JOIN fornecedores
            ON fornecedores.id = produtos.fornecedor_id";
    $consulta = $conexao->query($sql);
    return $consulta->fetchAll();
}