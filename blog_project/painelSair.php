<?php
	include "funcoes.php";
	@session_start();
	@session_destroy();
	direcionaPagina("index.php");
?>