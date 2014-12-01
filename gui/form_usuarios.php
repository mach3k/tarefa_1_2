<?php require 'cabecalho.php' ?>
			<form method="post" action="<?php echo URL_BASE; ?>usuarios.php?acao=gravar">
				<?php
					// se há um id definido (se é uma alteração)
					if (isset($id))
					{
						echo '<input type="hidden" name="id" value="'. $id . '">';
					}
				?>
				<fieldset>
					<legend>Dados do usuário</legend>
					<div class="form-group">
						<label for="nome">Nome:</label>
						<input type="text" name="nome" id="nome" value="<?=isset($nome) ? $nome : ''; ?>">
					</div>
					<div class="form-group">
						<label for="email">e-mail:</label>
						<input type="text" name="email" id="email" value="<?=isset($email) ? $email : ''; ?>">
					</div>
					<div class="form-group">
						<label for="login">Login:</label>
						<input type="text" name="login" id="login" value="<?=isset($login) ? $login : ''; ?>">
					</div>
					<div class="form-group">
						<label for="senha">Senha:</label>
						<input type="password" name="senha" id="senha">
					</div>
					<div class="form-group">
						<label for="confirma_senha">Confirmação da senha:</label>
						<input type="password" name="confirma_senha" id="confirma_senha">
					</div>
				</fieldset>
				<div class="form-group">
					<button type="submit">Gravar</button><button type="button" onclick="document.location='<?=URL_BASE;?>usuarios.php';">Voltar</button>
				</div>
			</form>
		</div>
	</body>
</html>