<?php
// src/fornecedor_crud.php

// Todas as funções criadas neste arquivo precisando do script de conexão
require_once "conecta.php";

// Usada em fornecedores/listar.php
function buscarFornecedores(PDO $conexao): array {

    // Montando o comando SQL para a consulta
    $sql = "SELECT * FROM fornecedores ORDER BY nome";
    
    // Executando o comando e guarda o resultado da consulta.
    $consulta = $conexao->query($sql);

    // Retornando o resultado como um array associativo
    return $consulta->fetchAll();
}