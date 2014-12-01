<?php
	// importa o código dos scripts
	require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'lib/funcoes.php';
	require_once 'lib/avalia_acao.php';
	
	switch($acao)
	{
		case 'listar':
			listar('produtos');
		case 'incluir':
			// define o título da página
			$titulo_pagina = 'Novo produto';

			$lista_deptos = montaListaDeptos();

			// carrega arquivo com o formulário para incluir novo usuário
			require_once 'gui/form_produtos.php';
			// interrompe o switch...case
			break;
		case 'alterar':
			$campos = array('nome', 'id_departamento', 'detalhes', 'preco');
			alterar('produtos', $campos);
		case 'gravar':
			gravar('produtos');
		case 'excluir':
			excluir('produtos');
		default:
			// encerra (mata) o script exibindo mensagem de erro
			die('Erro: Ação inexistente!');
	} // fim do switch...case
