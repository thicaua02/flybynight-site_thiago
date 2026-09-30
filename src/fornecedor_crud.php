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

// Usada em fornecedores/inserir.php
function inserirFornecedor(PDO $conexao, string $nome) : void {
    // Sobre o recebimento de dados para o comando SQL
    // No PDO, visando minimizar a chance de injeção de código SQL nocivo à partir de entradas de dados (no caso, formulário), devemos passar no comando SQL "parâmetros nomeados" (Named Parameter). Esse tipo de prática permite receber de forma segura/controlada os dados para a consulta. NUNCA passe os dados de forma direta.

    // Passo 1: definir os parâmetros nomeados
    $sql = "INSERT INTO fornecedores (nome) VALUES (:nome)";
    
    // Passo 2: preparar o comando para execução
    $consulta = $conexao->prepare($sql);

    // Passo 3: vincular o valor ao parâmetro nomeado
    $consulta->bindValue(":nome", $nome);

    // Passo 4: executar a consulta/comando no banco
    $consulta->execute();
}

// Usada em fornecedores/editar.php
function buscarFornecedorPorId(PDO $conexao, int $id) : array {

    // Comando SQL (atenção ao uso do parâmetro nomeado)
    $sql = "SELECT * FROM fornecedores WHERE id = :id";
 
    // Preparação da consulta
    $consulta = $conexao->prepare($sql);

    // Atribuição do valor recebedio (em $id) ao parâmetro nomeado (:id)
    $consulta->bindValue(":id", $id);

    // Execução da consulta
    $consulta->execute();

    // Retorno dos dados como array associativo
    return $consulta->fetch();
}

// Usada em fornecedores/editar.php
function atualizarFornecedor(PDO $conexao, int $id, string $nome) : void {
    // Comando SQL
    $sql = "UPDATE fornecedores SET nome = :nome WHERE id = :id";

    // Preparar comando SQL
    $consulta = $conexao->prepare($sql);
    
    // Atribuir valores aos campos
    $consulta->bindValue(":nome", $nome);
    $consulta->bindValue(":id", $id);

    // Executar
    $consulta->execute();
}

// Usada em fornecedores/excluir.php
function excluirFornecedor(PDO $conexao, int $id) : void {
    $sql = "DELETE FROM fornecedores WHERE id = :id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(':id', $id);
    $consulta->execute();
}