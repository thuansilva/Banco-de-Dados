<?php
	session_start();
	$nome = $_POST['nome'];
	$anoPublicacao = $_POST['anoPublicacao'];
	$volume = $_POST['volume'];
	$dataCadastro= $_POST['dataCadastro'];
	$obs= $_POST['obs'];
	$editora= $_POST['editora'];	
	$autor= $_POST['autor'];

    $conexao = mysql_connect('localhost', 'root', '') or die (mysql_error());
    $select = mysql_select_db('sigb') or die (mysql_error());
    
    $cadastro = ("INSERT INTO `obras` (`dataCadastro`, `nome`, `anoPublicacao`, `obs`)
    VALUES('$dataCadastro', '$nome', '$anoPublicacao', '$obs')");
    mysql_query($cadastro);

    $id = mysql_insert_id();

	$cadastro1 = ("INSERT INTO `livros` (`idObras_FK`, `volume`)
    VALUES({$id}, '$volume')");
    mysql_query($cadastro1);

    $idChave = mysql_insert_id();

 	$cadastro2 = ("INSERT INTO `editora` (`nome`)
    VALUES ('$editora')");
    mysql_query($cadastro2);

    $identificador = mysql_insert_id();

    $cadastro3 = ("INSERT INTO `sigb`.`possui` (`idEditora_FK`, `idObras_FK`)
    VALUES ('$identificador', '$id')");
    mysql_query($cadastro3);

    $cadastro4 = ("INSERT INTO `autor` (`nome`)
    VALUES ('$autor')");
    mysql_query($cadastro4);

    $chave = mysql_insert_id();

    $cadastro5 = ("INSERT INTO sigb.`tem` (`idAutor_FK`, `idLivro_FK`)
    VALUES ('$chave', '$idChave')");
    mysql_query($cadastro5);

	header("location:/Banco/cadastroLivro.php");
?>