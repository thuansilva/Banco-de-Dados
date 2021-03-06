<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<link rel="icon" href="../Banco/img/favicon.ico">
	<title>Pesquisar Alunos</title>
	<link href="../Banco/css/bootstrap.min.css " rel="stylesheet">
	<link href="../Banco/css/cadastrarAluno.css " rel="stylesheet">
	<link href="../Banco/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
	<!-- Barra de Navegação -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top ">
		<div class="container ">
			<a class="navbar-brand h1" href="home.php"> SIGB </a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite" data-target="#navbarSupportedContent">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSite">
				<ul class="navbar-nav ml-auto ">
					<li class="nav-item dropdown px-2">
						<a class="nav-link dropdown-toggle " href="#" id="navbarSite" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cadastro</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item " href="/Banco/cadastroProf.php">Professor(a)</a>
							<a class="dropdown-item" href="/Banco/cadastroAluno.php"> Aluno(a)</a>
							<a class="dropdown-item" href="/Banco/cadastroLR.php"> Obras</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="/Banco/cadastroBibli.php"> Bibliotecário(a)</a>
						</div>
					</li>
					<li class="nav-item dropdown px-2">
						<a class="nav-link dropdown-toggle" href="#" id="navbarSite" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pesquisar</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="/Banco/pesquisarProfessor.php"> Professor</a>
							<a class="dropdown-item" href="/Banco/pesquisarAlunos.php"> Aluno</a>
							<a class="dropdown-item" href="/Banco/pesquisarObras.php"> Obras</a>
						</div>
					</li>
					<ul class="navbar-nav px-2">
						<li class="nav-item ">
							<a class="nav-link" href="/Banco/emprestimo.php"> Empréstimo</a>
						</li>
					</ul>
					<ul class="navbar-nav px-2">
						<li class="nav-item ">
							<a class="nav-link" href="/Banco/devolucao.php"> Devolução</a>
						</li>
					</ul>
				</ul>
				<ul class="navbar-nav ml-auto px-md-4">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="" data-toggle="dropdown">Usuário </a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#"> Perfil </a>
							<a class="dropdown-item" href="index.php"> Sair</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<?php
	include_once("../Banco/conexao/conexao.php");

	$consulta = "SELECT * FROM `usuarios`
    INNER JOIN `telefoneusuario` ON `usuarios`.`idUsuario` = `telefoneusuario`.`idUsuario_FK`
	INNER JOIN `alunos` ON `usuarios`.`idUsuario` = `alunos`.`idUsuario_FK`
    INNER JOIN `enderecousuario` ON `usuarios`.`idUsuario` = `enderecousuario`.`idUsuario_FK`";
	
	#$resultado = mysqli_query($conn, $consulta);
	$con = $mysqli->query($consulta);
	?>

	<!-- Campo de Pesquisa -->
	<div class="container my-3 px-lg-3 p-md-3 " id="divAluno">
		<form method="post" action="/Banco/conexao/conexaoPesquisarAluno.php">
			<legend>
				<h2>Pesquisar Aluno</h2>
			</legend>
			<br/>
			<div class="form-row ">
				<div class="form-group col-md-8">
					<!--		<label >Pesquisar</label> -->
					<input type="text" class="form-control" placeholder="Digite o nome do aluno" name="aluno" required autofocus>
				</div>
				<div class="form-group col-md-4">

					<button type="submit" name="busca" class="btn btn-primary"> Buscar </button>
				</div>
			</div>
		</form>
	</div>


	<!-- Tabela -->
	<form id="lista" name="lista" method="post">

		<div class="table-responsive">
			<div class="container  px-lg-3 p-md-3 text-lg-left ">
				<table class="table my-2">
					<thead class="thead-light">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nome</th>
							<th scope="col">Série</th>
							<th scope="col">Turma</th>
							<th>                 </th>


						</tr>
					</thead>


					<?php
					while ($tbl=$con->fetch_array()) {
					#while($tbl = mysqli_fetch_assoc($resultado)){
					?>
					<tr>
						<td class="dif1">
							<?php echo $tbl['idUsuario'];?>
						</td>
						<td>
							<?php echo $tbl['nome'];?>
						</td>
						<td>
							<?php echo $tbl['serie'];?>
						</td>
						<td>
							<?php echo $tbl['turma'];?>
						</td>
						<td>
						<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal<?php echo $tbl['idUsuario']; ?>">Visualizar</button>

			<!--			<button type="button" class="btn btn-outline-info" data-toggle="modal"data-target="#PesquisaModal" data-whatever="<?php #echo $tbl["idUsuario"]; ?>">
						Editar
						</button> -->
						
						</td>
					</tr>
					<!-- Inicio Modal -->
								<div class="modal fade" id="myModal<?php echo $tbl['idUsuario']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title text-center" id="myModalLabel"><?php echo $tbl['nome']; ?></h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<div class="modal-body">
												<p><?php echo $tbl['idUsuario']; ?></p>
												<p><?php echo $tbl['nome']; ?></p>
												<p><?php echo $tbl['telefone']; ?></p>
												<p><?php echo $tbl['responsavel']; ?></p>
												<p><?php echo $tbl['turma']; ?></p>
												<p><?php echo $tbl['serie']; ?></p>
												<p><?php echo $tbl['matricula']; ?></p>
												<p><?php echo $tbl['rua']; ?></p>
												<p><?php echo $tbl['bairro']; ?></p>
												<p><?php echo $tbl['numero']; ?></p>

											</div>
										</div>
									</div>
								</div>
								<!-- Fim Modal -->
	<?php } ?>
	</table>
	</div>
	</div>
</form>

	<!-- Modal -->
	<!--
	<div class="modal fade" id="PesquisaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="PesquisaModal">Dados do Aluno </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        			</button>
				</div>
				<div class="modal-body"> -->
				

					<!-- Formulario 

					<form method="post"> action="/Banco/conexao/conexaoCadastroAluno.php"
						<div class="form-row ">
							<div class="form-group col-md-12">
							<label>ID</label>
								<input type="text" class="form-control" name="id" required autofocus >
							</div>
							<div class="form-group col-md-12">
								<label>Nome Completo</label>
								<input type="text" class="form-control" name="nome" required autofocus >
							</div>
							<div class="form-group col-md-4">
								<label>Telefone</label>
								<input type="text" class="form-control" name="telefone" required autofocus >
							</div>
						</div>
						<div class="form-row  ">
							<div class="form-group col-md-12 mx-auto">
								<label>Responsável</label>
								<input type="text" class="form-control" name="responsavel" required autofocus >
							</div>
						</div>
						<div class="form-row ">
							<div class="form-group col-md-3">
								<label>Turma</label>
								<input type="text" class="form-control" name="turma" required autofocus >
							</div>
							<div class="form-group col-md-4">
								<label>Série</label>
								<input type="text" class="form-control" name="serie" required autofocus > 
							</div>
							<div class="form-group col-md-5">
								<label>Matrícula</label>
								<input type="text" class="form-control" name="matricula" required autofocus >
							</div>
						</div>
						<div class="form-row ">
							<div class="form-group col-md-5">
								<label>Rua</label>
								<input type="text" class="form-control" name="rua" required autofocus >
							</div>
							<div class="form-group col-md-5">
								<label>Bairro</label>
								<input type="text" class="form-control" name="bairro" required autofocus >
							</div>
							<div class="form-group col-md-2">
								<label>Número</label>
								<input type="tel" class="form-control" name="numero" required autofocus >
							</div>
						</div> 

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
					</form>
				</div>
				
			</div>
		</div>
	</div>
	-->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     Include all compiled plugins (below), or include individual files as needed 
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$('#exampleModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var recipient = button.data('whatever') // Extract info from data-* attributes
		  var recipientnome = button.data('whatevernome')
		  var recipientdetalhes = button.data('whateverdetalhes')
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.modal-title').text('ID ' + recipient)
		  modal.find('#id-curso').val(recipient)
		  modal.find('#recipient-name').val(recipientnome)
		  modal.find('#detalhes').val(recipientdetalhes)
		  
		})
	</script>
-->
	<!-- Bootstrap JavaScript
    ================================================== -->
	<!-- -->
	<script src="./js/slim.min.js"></script>
	<script src="./js/popper.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>


</body>

</html>