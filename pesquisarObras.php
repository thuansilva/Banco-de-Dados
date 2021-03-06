<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<title>Pesquisar Obras</title>
	<link rel="stylesheet" href="../Banco/css/font-awesome.min.css">
	<link rel="icon" href="../Banco/img/icone.png">
	<link href="../Banco/css/bootstrap.min.css " rel="stylesheet">
	<link href="../Banco/css/cadastrarAluno.css " rel="stylesheet">

		<!-- Bootstrap JavaScript
    ================================================== -->
	<!-- -->
	<script src="../Banco/js/slim.min.js"></script>
	<script src="../Banco/js/popper.min.js"></script>
	<script src="../Banco/js/bootstrap.min.js"></script>
	<script src="../Banco/js/jquery.min.js"></script>
	<script src="./personalizado.js"></script>

</head>

<body>
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
            			<a class="nav-link" href="index.php"> Sair</a>
          			</li>
				</ul>
			</div>
		</div>
	</nav>

					<!-- Primeira Parte do aba Livros -->

	<?php
	include("../Banco/conexao/conexao.php");
	$consulta = "SELECT * FROM `obras`
    INNER JOIN `livros` ON `obras`.`idObras` = `livros`.`idObras_FK`
	INNER JOIN `tem` ON `tem`.`isbn_fk` = `livros`.`isbn`
	INNER JOIN `autor` ON `autor`.`idAutor` = `tem`.`idAutor_FK`
	INNER JOIN  `possui` ON  `possui`.`idObras_FK` =  `obras`.`idObras` 
	INNER JOIN `editora` ON `editora`.`idEditora` = `possui`.`idEditora_FK`";
	/* "SELECT `obras`.`idObras`, `obras`.`nomeObras`, `autor`.`nomeAutor`
	FROM `obras`
   	INNER JOIN `livros` ON `obras`.`idObras` = `livros`.`idObras_FK`
	INNER JOIN `tem` ON `tem`.`isbn_fk` = `livros`.`isbn`
	INNER JOIN `autor` ON `autor`.`idAutor` = `tem`.`idAutor_FK`";
*/
	$con = $mysqli->query($consulta);
	?>
	<div class="container my-3 px-lg-3 p-md-3" id="divAluno">
		<ul class="nav nav-tabs px-3" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Livro</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Revista</a>
			</li>
		</ul>



		<div class="tab-content py-lg-3" id="myTabContent">
			<div class="tab-pane fade show active" id="home" aria-labelledby="home-tab">
				<div class="container my-3 px-lg-3 p-md-3  " id="divAluno">
					<form method="post" action="/Banco/conexao/conexaoPesquisarLivro.php">
						<legend>
							<h2>Pesquisar Livro</h2>
						</legend>
						<br/>
						<div class="row justify-content-md-center ">
							<div class="form-row  col-md-8">
								<div class="form-group  justify col-md-8">
									<input type="text" class="form-control" placeholder="Digite o nome do livro" id="pesquisa4" name="pesquisa4" required autofocus>
								</div>
								
							</div>
						</div>
					</form>
					<ul class="resultado"></ul>
				</div>


				<form id="lista" name="lista" method="post">

					<div class="table-responsive">
						<div class="container  px-lg-3 p-md-3 text-lg-left ">

							<table class="table  my-2  ">
								<thead class="thead-light">
									<tr>
										<th scope="col">Cod. Livro</th>
										<th scope="col">Nome </th>
										<th scope="col">Autor</th>
										<th></th>

									</tr>
								</thead>

			<?php
			while ($tbl=$con->fetch_array()) {
			#while ($tbl = mysql_fetch_array($con)) {
			?>

			<tr>
				<td class="dif1">
					<?php echo $tbl["idObras"];?>
				</td>
				<td>
					<?php echo $tbl["nomeObras"];?>
				</td>
				<td>
					<?php echo $tbl["nomeAutor"];?>
				</td>
				<td>
					<button type="button" role="button" class="btn btn-outline-info" data-toggle="modal" data-target="#myModal<?php echo $tbl['idObras']; ?>">
						Visualizar
						<i class="fa fa-info"></i>
					</button>
					<button type="button" class="btn btn-outline-warning" 
							data-toggle="modal" data-target="#PesquisaObras" 
							data-whatever="<?php echo $tbl['idObras'];?>" 
							data-whatevernome="<?php echo $tbl['nomeObras'];?>" 
							data-whateveranopublicacao="<?php echo $tbl['anoPublicacao'];?>"
							data-whateverautor="<?php echo $tbl['nomeAutor'];?>" 
							data-whatevereditora="<?php echo $tbl['nomeEditora'];?>" 
							data-whatevervolume="<?php echo $tbl['volume'];?>" 
							data-whateverdatacadastro="<?php echo $tbl['dataCadastro'];?>"
							data-whateverobs="<?php echo $tbl['obs'];?>">
								Editar
								<i class="fa fa-edit"></i>
							</button>
					<button type="button" role="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#PesquisaObrasLivros" 
							data-whatever="<?php echo $tbl['idObras'];?>" 
							data-whatevernome="<?php echo $tbl['nomeObras'];?>" 
							data-whateveranopublicacao="<?php echo $tbl['anoPublicacao'];?>"
							data-whateverautor="<?php echo $tbl['nomeAutor'];?>" 
							data-whatevereditora="<?php echo $tbl['nomeEditora'];?>" 
							data-whatevervolume="<?php echo $tbl['volume'];?>" 
							data-whateverdatacadastro="<?php echo $tbl['dataCadastro'];?>"
							data-whateverobs="<?php echo $tbl['obs'];?>">
						Excluir
						<i class="fa fa-trash"></i>
					</button>
				</td>
			</tr>
			<!-- Inicio Modal -->
							<div class="modal fade" id="myModal<?php echo $tbl['idObras']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title text-center" id="myModalLabel"><?php echo $tbl['nomeObras']; ?></h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="modal-body">
											<p><?php echo "Cod. Livro: ", $tbl['idObras']; ?></p>
											<p><?php echo "Nome: ", $tbl['nomeObras']; ?></p>
											<p><?php echo "ISBN: ", $tbl['isbn']; ?></p> 
											<p><?php echo "Volume: ", $tbl['volume']; ?></p>
											<p><?php echo "Ano Publicação: ", $tbl['anoPublicacao']; ?></p> 
											<p><?php echo "Autor: ", $tbl['nomeAutor']; ?></p> 
											<p><?php echo "Editora: ", $tbl['nomeEditora']; ?></p> 
											<p><?php echo "Data de Cadastro: ", $tbl['dataCadastro']; ?></p> 
											<p><?php echo "Observação: ", $tbl['obs']; ?></p>
											<!--	<type="button" class="btn btn-outline-info" data-dismiss="modal">Alterar</button> -->
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


				<!--O primeiro        Modal -->

				<!-- Modal -->
	<div class="modal fade" id="PesquisaObras" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="PesquisaObras"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<!-- Formulario -->

		<form method="post" action="/Banco/conexao/conexaoAtualizarLivro.php">
		<div class="form-row ">
			<div class="form-group col-md-12">
				<label for="nome">Nome do Livro</label>
				<input type="text" class="form-control" id="nome" name="nome" required autofocus >
			</div>
			<div class="form-group col-md-12 ">
				<label for="autor">Autor</label>
				<input type="text" class="form-control"  id="autor" name="autor" required autofocus>
			</div>
		</div>	
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="editora">Editora</label>
				<input type="text" class="form-control" id="editora" name="editora"  required autofocus>
			</div>
			<div class="form-group col-md-6">
				<label for="volume">Volume</label>
				<input type="number" class="form-control" id="volume" name="volume"  required autofocus>
			</div>
		</div>
		<div class="form-row ">
			<div class="form-group col-md-6">
				<label for="anopublicacao">Ano de Publicacao</label>
				<input type="text" class="form-control" id="anopublicacao" name="anopublicacao" required autofocus >
			</div>
			<div class="form-group col-md-6">
				<label for="datacadastro">Data de Cadastro</label>
				<input type="text" class="form-control" id="datacadastro" name="datacadastro" required autofocus >
			</div>
			<div class="form-group col-md-12">
				<label for="obs">Obs</label>
				<input type="text" class="form-control" id="obs" name="obs" required autofocus >
			</div>
			<input id="id_Obras" type="hidden" name="id_Obras">
		</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="PesquisaObrasLivros" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="PesquisaObrasLivros"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- Formulario -->
					<form method="post" action="/Banco/conexao/conexaoRemoverLivro.php">
						<div class="form-row ">
							<div class="form-group col-md-12">
								<label for="nome">Nome do Livro</label>
								<input type="text" class="form-control" id="nome" name="nome" required autofocus >
							</div>
							<div class="form-group col-md-12 ">
								<label for="autor">Autor</label>
								<input type="text" class="form-control"  id="autor" name="autor" required autofocus>
							</div>
						</div>	
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="editora">Editora</label>
								<input type="text" class="form-control" id="editora" name="editora"  required autofocus>
							</div>
							<div class="form-group col-md-6">
								<label for="volume">Volume</label>
								<input type="number" class="form-control" id="volume" name="volume"  required autofocus>
							</div>
						</div>
						<div class="form-row ">
							<div class="form-group col-md-6">
								<label for="anopublicacao">Ano de Publicacao</label>
								<input type="text" class="form-control" id="anopublicacao" name="anopublicacao" required autofocus >
							</div>
							<div class="form-group col-md-6">
								<label for="datacadastro">Data de Cadastro</label>
								<input type="text" class="form-control" id="datacadastro" name="datacadastro" required autofocus >
							</div>
							<div class="form-group col-md-12">
								<label for="obs">Obs</label>
								<input type="text" class="form-control" id="obs" name="obs" required autofocus >
							</div>
							<input id="id_Obras" type="hidden" name="id_Obras">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
							<button type="submit" class="btn btn-danger">Sim</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
	<script type="text/javascript">
		$('#PesquisaObras').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var recipient = button.data('whatever') // Extract info from data-* attributes
		  var recipientnome = button.data('whatevernome')
		  var recipientanopublicacao = button.data('whateveranopublicacao')
		  var recipientautor = button.data('whateverautor')
		  var recipienteditora = button.data('whatevereditora')
		  var recipientvolume = button.data('whatevervolume')
		  var recipientdatacadastro = button.data('whateverdatacadastro')
		  var recipientobs = button.data('whateverobs')

		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.modal-title').text('ID de Livros: ' + recipient)
		  modal.find('#id_Obras').val(recipient)
		  modal.find('#nome').val(recipientnome)
		  modal.find('#volume').val(recipientvolume)
		  modal.find('#anopublicacao').val(recipientanopublicacao)
		  modal.find('#autor').val(recipientautor)
		  modal.find('#editora').val(recipienteditora)
		  modal.find('#datacadastro').val(recipientdatacadastro)
		  modal.find('#obs').val(recipientobs)
		})
	</script>

	<script type="text/javascript">
		$('#PesquisaObrasLivros').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var recipient = button.data('whatever') // Extract info from data-* attributes
		  var recipientnome = button.data('whatevernome')
		  var recipientanopublicacao = button.data('whateveranopublicacao')
		  var recipientautor = button.data('whateverautor')
		  var recipienteditora = button.data('whatevereditora')
		  var recipientvolume = button.data('whatevervolume')
		  var recipientdatacadastro = button.data('whateverdatacadastro')
		  var recipientobs = button.data('whateverobs')

		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.modal-title').text('Certeza que deseja excluir?')
		  modal.find('#id_Obras').val(recipient)
		  modal.find('#nome').val(recipientnome)
		  modal.find('#volume').val(recipientvolume)
		  modal.find('#anopublicacao').val(recipientanopublicacao)
		  modal.find('#autor').val(recipientautor)
		  modal.find('#editora').val(recipienteditora)
		  modal.find('#datacadastro').val(recipientdatacadastro)
		  modal.find('#obs').val(recipientobs)
		})
	</script>

	</div>

			<!-- Final da priemeira parteee -->
			<?php
			include("../Banco/conexao/conexao.php");
			$consulta = "SELECT * FROM `obras`
   			INNER JOIN `revistas` ON `obras`.`idObras` = `revistas`.`idObras_FK`
			INNER JOIN `possui` ON `possui`.`idObras_FK` = `obras`.`idObras`
			INNER JOIN `editora` ON `editora`.`idEditora` = `possui`.`idEditora_FK`";
			/*"SELECT `obras`.`idObras`, `obras`.`nomeObras`, `obras`.`dataCadastro`
    		FROM `obras`
    		INNER JOIN `revistas` ON `obras`.`idObras` = `revistas`.`idObras_FK`";
    		*/
			$con = $mysqli->query($consulta);
			?>

			<!-- Segunda Parte          -->

			<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
				<div class="container my-3 px-lg-3 p-md-3  " id="divAluno">
					<form method="post" action="/Banco/conexao/conexaoPesquisarRevista.php">
						<legend>
							<h2>Pesquisar Revista</h2>
						</legend>
						<br/>
						<div class="row justify-content-md-center ">
							<div class="form-row  col-md-8">
								<div class="form-group  justify col-md-8">
									<input type="text" class="form-control" placeholder="Digite o nome da revista" name="obra" required autofocus>
								</div>
								<div class="form-group col-md-4">
									<button type="submit" class="btn btn-primary"> Buscar </button>
								</div>
							</div>
						</div>
					</form>
				</div>


				<form id="lista" name="lista" method="post">

					<div class="table-responsive">
						<div class="container  px-lg-3 p-md-3 text-lg-left ">

							<table class="table  my-2  ">
								<thead class="thead-light">
									<tr>
										<th scope="col">Cod. Revista</th>
										<th scope="col">Nome </th>
										<th scope="col">Editora</th>
										<th></th>
									</tr>
								</thead>

								<?php
			while ($tbl=$con->fetch_array()) {
			#while ($tbl = mysql_fetch_array($con)) {
			?>

								<tr>
									<td class="dif1">
										<?php echo $tbl["idObras"];?>
									</td>
									<td>
										<?php echo $tbl["nomeObras"];?>
									</td>
									<td>
										<?php echo $tbl["nomeEditora"];?>
									</td>
									<td>
						<button type="button" role="button" class="btn btn-outline-info" data-toggle="modal" data-target="#myModal2">
						Visualizar	
						<i class="fa fa-info"></i>
						</button>
						<button type="button" class="btn btn-outline-warning" 
							data-toggle="modal" data-target="#PesquisaObras2" 
							data-whatever="<?php echo $tbl['idObras'];?>"
							data-whatevernomeobras="<?php echo $tbl['nomeObras'];?>" 
							data-whateveranopublicacao="<?php echo $tbl['anoPublicacao'];?>"
							data-whatevertitulo="<?php echo $tbl['titulo'];?>"
							data-whateveredicao="<?php echo $tbl['edicao'];?>"
							data-whatevereditora="<?php echo $tbl['nomeEditora'];?>"
							data-whateverdatacadastro="<?php echo $tbl['dataCadastro'];?>"
							data-whateverobs="<?php echo $tbl['obs'];?>">
								Editar
								<i class="fa fa-edit"></i>
						</button>
						<button type="button" role="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#PesquisaObrasRevista" 
							data-whatever="<?php echo $tbl['idObras'];?>"
							data-whatevernomeobras="<?php echo $tbl['nomeObras'];?>" 
							data-whateveranopublicacao="<?php echo $tbl['anoPublicacao'];?>"
							data-whatevertitulo="<?php echo $tbl['titulo'];?>"
							data-whateveredicao="<?php echo $tbl['edicao'];?>"
							data-whatevereditora="<?php echo $tbl['nomeEditora'];?>"
							data-whateverdatacadastro="<?php echo $tbl['dataCadastro'];?>"
							data-whateverobs="<?php echo $tbl['obs'];?>">
							Excluir	
							<i class="fa fa-trash"></i>
						</button>
					</td>
				</tr>

				<!-- Segundo  Modal -->
				<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="myModalLabel"><?php echo $tbl['nomeObras']; ?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p><?php echo "Cod. Revista: ", $tbl['idObras']; ?></p>
								<p><?php echo "Nome: ", $tbl['nomeObras']; ?></p>
								<p><?php echo "Ano Publicação: ", $tbl['anoPublicacao']; ?></p> 
								<p><?php echo "Titulo: ", $tbl['titulo']; ?></p>
								<p><?php echo "Edição: ", $tbl['edicao']; ?></p> 
								<p><?php echo "Editora: ", $tbl['nomeEditora']; ?></p> 
								<p><?php echo "Data de Cadastro: ", $tbl['dataCadastro']; ?></p> 
								<p><?php echo "Observação: ", $tbl['obs']; ?></p>
								<!--	<type="button" class="btn btn-outline-info" data-dismiss="modal">Alterar</button> -->
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
	<div class="modal fade" id="PesquisaObras2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title2" id="PesquisaObras2"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
			<!-- Formulario -->

		<form method="post" action="/Banco/conexao/conexaoAtualizarRevista.php">
		<div class="form-row ">
			<div class="form-group col-md-12">
				<label for="nome">Nome da Revista</label>
				<input type="text" class="form-control" id="nome" name="nome" required autofocus >
			</div>
		</div>	
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="titulo">Titulo</label>
				<input type="text" class="form-control" id="titulo" name="titulo"  required autofocus>
			</div>
			<div class="form-group col-md-7">
				<label for="editora">Editora</label>
				<input type="text" class="form-control" id="editora" name="editora" required autofocus >
			</div>
		</div>
		<div class="form-row ">
			<div class="form-group col-md-2">
				<label for="edicao">Edicao</label>
				<input type="text" class="form-control" id="edicao" name="edicao" required autofocus >
			</div>
			<div class="form-group col-md-5">
				<label for="anopublicacao">Ano de Publicacao</label>
				<input type="text" class="form-control" id="anopublicacao" name="anopublicacao" required autofocus >
			</div>
			<div class="form-group col-md-5">
				<label for="datacadastro">Data de Cadastro</label>
				<input type="date" class="form-control" id="datacadastro" name="datacadastro" required autofocus >
			</div>
			<div class="form-group col-md-12">
				<label for="obs">Observação</label>
				<textarea type="text" class="form-control" id="obs" name="obs" required autofocus ></textarea>
			</div>
			<input id="id_revista" type="hidden" name="id_Obras">
		</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</div>
		</div>
	</div>

<!-- Modal -->
	<div class="modal fade" id="PesquisaObrasRevista" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title2" id="PesquisaObrasRevista"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
			<!-- Formulario -->

		<form method="post" action="/Banco/conexao/conexaoRemoverRevista.php">
		<div class="form-row ">
			<div class="form-group col-md-12">
				<label for="nome">Nome da Revista</label>
				<input type="text" class="form-control" id="nome" name="nome" required autofocus >
			</div>
		</div>	
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="titulo">Titulo</label>
				<input type="text" class="form-control" id="titulo" name="titulo"  required autofocus>
			</div>
			<div class="form-group col-md-7">
				<label for="editora">Editora</label>
				<input type="text" class="form-control" id="editora" name="editora" required autofocus >
			</div>
		</div>
		<div class="form-row ">
			<div class="form-group col-md-2">
				<label for="edicao">Edicao</label>
				<input type="text" class="form-control" id="edicao" name="edicao" required autofocus >
			</div>
			<div class="form-group col-md-5">
				<label for="anopublicacao">Ano de Publicacao</label>
				<input type="text" class="form-control" id="anopublicacao" name="anopublicacao" required autofocus >
			</div>
			<div class="form-group col-md-5">
				<label for="datacadastro">Data de Cadastro</label>
				<input type="date" class="form-control" id="datacadastro" name="datacadastro" required autofocus >
			</div>
			<div class="form-group col-md-12">
				<label for="obs">Observação</label>
				<input type="text" class="form-control" id="obs" name="obs" required autofocus >
			<!--	<textarea type="text" class="form-control" id="obs" name="obs" required autofocus ></textarea> -->
			</div>
			<input id="id_revista" type="hidden" name="id_revista">
		</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
					<button type="submit" class="btn btn-danger">Sim</button>
				</div>
			</form>
			</div>
		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
	<script type="text/javascript">
		$('#PesquisaObras2').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var recipient = button.data('whatever') // Extract info from data-* attributes
		  var recipientnomeobras = button.data('whatevernomeobras')
		  var recipientanopublicacao = button.data('whateveranopublicacao')
		  var recipienttitulo = button.data('whatevertitulo')
		  var recipientedicao = button.data('whateveredicao')
		  var recipienteditora = button.data('whatevereditora')
		  var recipientdatacadastro = button.data('whateverdatacadastro')
		  var recipientobs = button.data('whateverobs')

		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.modal-title2').text('ID da Revista: ' + recipient)
		  modal.find('#id_revista').val(recipient)
		  modal.find('#nome').val(recipientnomeobras)
		  modal.find('#anopublicacao').val(recipientanopublicacao)
		  modal.find('#titulo').val(recipienttitulo)
		  modal.find('#edicao').val(recipientedicao)
		  modal.find('#editora').val(recipienteditora)
		  modal.find('#datacadastro').val(recipientdatacadastro)
		  modal.find('#obs').val(recipientobs)
		})
	</script>

	<script type="text/javascript">
		$('#PesquisaObrasRevista').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var recipient = button.data('whatever') // Extract info from data-* attributes
		  var recipientnomeobras = button.data('whatevernomeobras')
		  var recipientanopublicacao = button.data('whateveranopublicacao')
		  var recipienttitulo = button.data('whatevertitulo')
		  var recipientedicao = button.data('whateveredicao')
		  var recipienteditora = button.data('whatevereditora')
		  var recipientdatacadastro = button.data('whateverdatacadastro')
		  var recipientobs = button.data('whateverobs')

		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.modal-title2').text('Certeza que deseja excluir?')
		  modal.find('#id_revista').val(recipient)
		  modal.find('#nome').val(recipientnomeobras)
		  modal.find('#anopublicacao').val(recipientanopublicacao)
		  modal.find('#titulo').val(recipienttitulo)
		  modal.find('#edicao').val(recipientedicao)
		  modal.find('#editora').val(recipienteditora)
		  modal.find('#datacadastro').val(recipientdatacadastro)
		  modal.find('#obs').val(recipientobs)
		})
	</script>


	
</body>

</html>