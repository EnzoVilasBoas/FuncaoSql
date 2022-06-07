<?php
require 'iniSis.php';
/*****************************
FUNÇÃO DE CADASTRO NO BANCO
 *****************************/
function LogAcesso(string $arquivo,string $mensagem){
    $arquivo 		= fopen($arquivo, 'a');
    $novoArquivo 	= $mensagem."\n";
    fwrite($arquivo,utf8_decode($novoArquivo));
    fclose($arquivo);
}
function create($tabela, array $datas)
{
	$conn = mysqli_connect(HOST, USER, PASS, DBSA) or die('Erro ao conectar: ' . mysqli_connect_error($conn));
	$fields = implode(", ", array_keys($datas));
	$values = "'" . implode("', '", array_values($datas)) . "'";
	$qrCreate = "INSERT INTO {$tabela} ($fields) VALUES ($values)";
	if (LOG) {
		$stCreate   =  mysqli_query($conn, $qrCreate) or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>'
			. logAcesso('logbderro.txt', "ERRO NO CREATE, " . $_SERVER['REQUEST_URI'] . ", DATA: " . date('Y-m-d H:i:s') . " , TABELA: $tabela, QUERY:  $qrCreate  " . mysqli_error($conn)));
	} else {
		$stCreate   = mysqli_query($conn, $qrCreate)  or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>');
	}
	if (isset($stCreate)) {
		return mysqli_insert_id($conn);
	}
}



/*****************************
FUNÇÃO DE CADASTRO NO BANCO
 *****************************/

function read($tabela, $cond = NULL)
{
	$conn = mysqli_connect(HOST, USER, PASS, DBSA) or die('Erro ao conectar: ' . mysqli_connect_error($conn));
	$qrRead = "SELECT * FROM {$tabela} {$cond}";
	if (LOG) {
		$stRead   =  mysqli_query($conn, $qrRead) or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>'
			. logAcesso('logbderro.txt', "ERRO NA READ, " . $_SERVER['REQUEST_URI'] . ", DATA: " . date('Y-m-d H:i:s') . " , TABELA: $tabela, QUERY:  $stRead  " . mysqli_error($conn)));
	} else {
		$stRead   = mysqli_query($conn, $qrRead)  or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>');
	}
	if (isset($stRead)) {
		return $stRead;
	}
}

/*****************************
FUNÇÃO DE EDIÇÃO NO BANCO
 *****************************/

function update($tabela, array $datas, $where)
{
	$conn = mysqli_connect(HOST, USER, PASS, DBSA) or die('Erro ao conectar: ' . mysqli_connect_error($conn));
	foreach ($datas as $fields => $values) {
		$campos[] = "$fields = '$values'";
	}
	$campos = implode(", ", $campos);
	$qrUpdate = "UPDATE " . $tabela . " SET " . $campos . " WHERE " . $where;

	if (LOG) {
		$stUpdate = mysqli_query($conn, $qrUpdate) or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>'
			. logAcesso('logbderro.txt', "ERRO NO UPDATE, " . $_SERVER['REQUEST_URI'] . ", DATA: " . date('Y-m-d H:i:s') . " , TABELA: $tabela, QUERY:  $stUpdate  " . mysqli_error($conn)));
	} else {
		$stUpdate = mysqli_query($conn, $qrUpdate) or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>');
	}
	if (isset($stUpdate)) {
		return $campos;
	}
}

/*****************************
FUNÇÃO DE DELETAR NO BANCO
 *****************************/

function delete($tabela, $where)
{
	$conn = mysqli_connect(HOST, USER, PASS, DBSA) or die('Erro ao conectar: ' . mysqli_connect_error($conn));
	$qrDelete = "DELETE FROM {$tabela} WHERE {$where}";
	if (LOG) {
		$stDelete = mysqli_query($conn, $qrDelete)  or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>'
			. logAcesso('logbderro.txt', "ERRO NO UPDATE, " . $_SERVER['REQUEST_URI'] . ", DATA: " . date('Y-m-d H:i:s') . " , TABELA: $tabela, QUERY:  $stDelete  " . mysqli_error($conn)));
	} else {
		$stDelete = mysqli_query($conn, $qrDelete) or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>');
	}
	if (isset($stDelete)) {
		return $stDelete;
	}
}

/*****************************
FUNÇÃO DE SELECT NO BANCO
 *****************************/
function select($campo, $tabela, $cond = NULL)
{
	$conn = mysqli_connect(HOST, USER, PASS, DBSA) or die('Erro ao conectar: ' . mysqli_connect_error($conn));
	$qrRead = "SELECT {$campo} FROM {$tabela} {$cond}";

	if (LOG) {
		$stRead = mysqli_query($conn, $qrRead) or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>'
			. logAcesso('logbderro.txt', "ERRO NO SELECT, " . $_SERVER['REQUEST_URI'] . ", DATA: " . date('Y-m-d H:i:s') . " , TABELA: $tabela, QUERY:  $stRead  " . mysqli_error($conn)));
	} else {
		$stRead = mysqli_query($conn, $qrRead) or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>');
	}
	if (isset($stRead)) {
		return $stRead;
	}
}
