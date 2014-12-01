<?php 
	//require_once 'constantes';
	//require_once 'database';

	function listar($tabela)
	{
		// monta a consulta para recuperar a listagem de usuários ordenada pelo nome
		if ($tabela == 'produtos') {
			// monta a consulta para recuperar a listagem de produtos, com o respectivo nome
			// do departamento associado, ordenada pelo nome do produto
			$consulta = "
				select p.id, p.nome as nome_produto,
				p.preco, d.nome as nome_departamento
				from produtos p,
				departamentos d
				where d.id = p.id_departamento
				order by p.nome
			";
		}
		else {
			$consulta = "select * from $tabela order by nome";
		}
		
		// executa a consulta sql
		consultar($consulta);
		// declara um vetor de registros para passar para a view (gui)
		$registros = array();
		// percorre o resultset retornado pela consulta extraindo um a um os registros retornados
		while ($registro = proximo_registro())
		{
			// acrescenta o registro ao vetor
			array_push($registros, $registro);
		}
		// define o título da página
		$titulo_pagina = "Lista de $tabela";
		// carrega o arquivo com a listagem de clientes (gui)
		require_once "gui/lista_$tabela.php";
		break;
	}

	function alterar($tabela, $campos)
	{
		// se não informou id na URL
		if (!isset($_GET['id']))
		{
			// encerra (mata) o script com mensagem de erro
			die('Erro: O código do registro a alterar não foi
			 informado.');
		}

		// captura o id passado na URL
		$id = $_GET['id'];
		// monta consulta SQL para recuperar os dados do usuário a ser alterado
		$consulta = "select * from $tabela where id = $id";
		// executa a consulta
		consultar($consulta);
		// captura o registro retornado pela consulta
		$registro = proximo_registro();
		
		foreach ($campos as $value) {
			${$value} = $registro["$value"];
		}

		if ($tabela == 'produtos') {
			$lista_deptos = montaListaDeptos($id_departamento);
		}

		// define o título da página
		$titulo_pagina = 'Alterar ' . substr($tabela, 0, -1);
		// carrega o formulário para alterar o usuário
		require_once('gui/form_' . $tabela . '.php');
		break;
	}

	function gravar($tabela)
	{
		$dados = $_POST;
		foreach ($dados as $key => $value) {
			${$key} = $value;
			if ($key != 'confirma_senha') {
				if (isset($id)) {
					if ($key != 'id'){
						$strCampos = $strCampos . $key . " = '" . $value . "',";
					}
				}
				else{
					$strCampos = $strCampos . $key . ',';
					$strValores = $strValores . "'" . $value . "',";
				}
			}
		}

		$strCampos = substr($strCampos, 0, -1);
		$strValores = substr($strValores, 0, -1);
		
		if (!isset($id))
		{
		// monta consulta sql para realização a inserção

			$consulta = "
				insert into $tabela ($strCampos) values ($strValores)
			";
			$msg_erro = 'Não foi possível inserir.';
		}
		else
		{
			$consulta = "
				update $tabela set 
					$strCampos
				where id = {$id}
			";
			$msg_erro = 'Não foi possível alterar.';
		}
		// executa a consulta
		consultar($consulta);
		// verifica se a operação foi bem sucedida
		if(linhas_afetadas() > 0)
		{
			// redireciona para a listagem
			header('location:' . URL_BASE .
				"$tabela.php?acao=listar");
			// finaliza a execução do script
			exit;
		}
		else {
			// exibe mensagem de erro
			echo 'Erro: ' . $msg_erro;
			// finaliza a execução do script
			exit;
		}
		break;
	}

	function excluir($tabela)
	{
		// se não informou id na URL
		if (!isset($_GET['id']))
		{
			// encerra (mata) o script com mensagem de erro
			die('Erro: O código do registro a excluir não foi
				informado.');
		}

		// captura o id passado na URL
		$id = $_GET['id'];
		// monta consulta SQL para excluir o registro
		$consulta = "delete from $tabela where id = $id";
		// executa a consulta
		consultar($consulta);
		// verifica se a exclusão foi bem sucedida
		if(linhas_afetadas() > 0)
		{
			// redireciona para a listagem
			header('location:' . URL_BASE .
				"$tabela.php?acao=listar");
			// encerra a execução do script
			exit;
		}
		else {
			// exibe mensagem de erro
			echo "Erro: Não foi possível excluir.";
			exit;
		}
		break;
	}

	function montaListaDeptos($id='')
	{
		// recupera departamentos
		$consulta = "
			select * from departamentos
			order by nome
		";

		consultar($consulta);

		$lista_deptos = '';

		while($registro = proximo_registro())
		{
			$lista_deptos .= '<option value="' .
				$registro['id'] .
				( $id == $registro['id'] ? ' selected="selected"' : '') .
				'">' . $registro['nome'] . '</option>';
		}

		return $lista_deptos;
	}
?>