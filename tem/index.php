<?php
require 'conexao.php';
// Recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';
// Verifica se o termo de pesquisa está vazio, se estiver executa uma consulta completa
if (empty($termo)):
	$conexao = conexao::getInstance();
	$sql = 'SELECT 	idAluno, nomeAluno, emailAluno, celAluno, cursoAluno, status, foto FROM tab_alunos';
	$stm = $conexao->prepare($sql);
	$stm->execute();
	$geral = $stm->fetchAll(PDO::FETCH_OBJ);
else:
	// Executa uma consulta baseada no termo de pesquisa passado como parâmetro
	$conexao = conexao::getInstance();
	$sql = 'SELECT 	idAluno, nomeAluno, emailAluno, celAluno, cursoAluno, status, foto FROM tab_alunos WHERE nomeAluno LIKE :nomeAluno OR status LIKE :status';
	
$stm = $conexao->prepare($sql);
	$stm->bindValue(':nomeAluno', $termo.'%');
	$stm->bindValue(':status', $termo.'%');
	$stm->execute();
	$geral = $stm->fetchAll(PDO::FETCH_OBJ);
endif;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Stark CE</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	
</head>
<body>
<div class='container'>
<fieldset>
		<!-- Cabeçalho da Listagem -->
	
	<div class="alert alert-success" role="alert">
  <legend><h1>Stark CE</h1></legend>
</div>

			<!-- Link para página de cadastro -->
		</div>
<article class="container">
		<hr>			
		
		<a href='../index.html' class="btn btn-danger">Inicio</a>
		
		<a class="btn btn-danger" href="../tem/up_down">Exibir lista</a>

		<div class='clearfix'></div>
</article>	
			<?php if(!empty($geral)):?>
<div class="table-responsive">
			
				<!-- Tabela de geral -->
				<table class="table table-hover">
					<tr class='active'>
					<center><th>Foto</th>
					<center>	<th>Nome</th> 	</center>
					<center>	<th>E-mail</th> </center>
					<center>	<th>Celular</th></center>
					<center>	<th>Curso</th>  </center>
					<center>	<th>Status</th> </center>
					<center>	<th>Ação</th>   </center>
					</tr>
					<?php foreach($geral as $geral):?>
						<tr>
							<td><img src='fotos/<?=$geral->foto?>' height='100' width='100'></td>
							<center><td><?=$geral->nomeAluno?></td></center>
						<center>	<td><?=$geral->emailAluno?></td></center>
							<center><td><?=$geral->celAluno?></td></center>
						<center>	<td><?=$geral->cursoAluno?></td></center>
						<center>	<td><?=$geral->status?></td></center>
						<td>
								<a href='editar_aluno.php?idAluno=<?=$geral->idAluno?>' class="btn btn-danger">Editar</a>
								
								<a href='deletar_aluno.php?idAluno=<?=$geral->idAluno?>' class="btn" >Excluir</a>

						</tr>	
						
						
					<?php endforeach;?>
			

						<?php else: ?>

		<!-- Mensagem caso não exista geral ou não encontrado  -->
		<h3 class="text-center text-primary">Não existem Alunos cadastrados!</h3>
		<?php endif; ?>
		</fieldset>
		</div>
		</div>
</body>
</html>