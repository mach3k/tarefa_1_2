<?php require 'cabecalho.php' ?>
			<form method="post" action="<?php echo URL_BASE; ?>departamentos.php?acao=gravar">
				<?php
					// se há um id definido (se é uma alteração)
					if (isset($id))
					{
						echo '<input type="hidden" name="id" value="'. $id . '">';
					}
				?>
				<fieldset>
					<legend>Dados do cliente</legend>
					<div class="form-group">
						<label for="nome">Nome:</label>
						<input type="text" name="nome" id="nome" value="<?=isset($nome) ? $nome : ''; ?>">
					</div>
				</fieldset>
				<div class="form-group">
					<button type="submit">Gravar</button><button type="button" onclick="document.location='<?=URL_BASE;?>departamentos.php';">Voltar</button>
				</div>
			</form>
		</div>
	</body>
</html>