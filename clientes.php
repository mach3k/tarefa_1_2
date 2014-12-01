<?php
	// importa o código dos scripts
	require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'lib/funcoes.php';
	require_once 'lib/avalia_acao.php';

	switch($acao)
	{
		case 'listar':
			listar('clientes');
		case 'incluir':
			// define o título da página
			$titulo_pagina = 'Novo cliente';
			// carrega arquivo com o formulário para incluir novo registro
			require_once 'gui/form_clientes.php';
			// interrompe o switch...case
			break;
		case 'alterar':
			$campos = array('nome', 'email', 'senha');
			alterar('clientes', $campos);
		case 'gravar':
			gravar('clientes');
		case 'excluir':
			excluir('clientes');
		default:
			// encerra (mata) o script exibindo mensagem de erro
			die('Erro: Ação inexistente!');
	} // fim do switch...case
