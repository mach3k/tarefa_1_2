<?php
	// importa o código dos scripts
	require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'lib/funcoes.php';
	require_once 'lib/avalia_acao.php';

	switch($acao)
	{
		case 'listar':
			listar('departamentos');
		case 'incluir':
			// define o título da página
			$titulo_pagina = 'Novo departamento';
			// carrega arquivo com o formulário para incluir novo usuário
			require_once 'gui/form_departamentos.php';
			// interrompe o switch...case
			break;
		case 'alterar':
			$campos = array("nome");
			alterar('departamentos', $campos);
		case 'gravar':
			gravar('departamentos');
		case 'excluir':
			excluir('departamentos');
		default:
			// encerra (mata) o script exibindo mensagem de erro
			die('Erro: Ação inexistente!');
	} // fim do switch...case
