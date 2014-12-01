<?php
	
	$registro = array("nome" => "Marcelo",  "idade"=> "32","email" => "mr.machado@gmail.com");
	$parametro = array("nome","idade","email");
	$nome = "Nada";
	$idade = 0;
	$email = "@";

	foreach ($parametro as $value) {
		echo "Parametro $value: " . $registro["$value"];
		echo "<br/>";
		${$value} = $registro["$value"];
	}

	echo "Nome: " . $nome . "<br/>";
	echo "Idade: " . $idade . "<br/>";
	echo "Email: " . $email . "<br/>";
?>