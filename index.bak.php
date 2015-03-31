<html>
	<head>
		<title>Code Education</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/theme.css">
	</head>

	<body>

	<script src="/js/jquery-2.1.3.min.js"></script>

	<div class="navbar navbar-inverse navbar-static-top">

		<div class="container">

			<a href="#" class="navbar-brand">PHP + bootstrap</a>

			<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<div class="collapse navbar-collapse navHeaderCollapse">
				<ul class="nav navbar-nav navbar-right">
				</ul>

			</div>

		</div>

	</div>



<!-- HERE COMES THE PAGE CONTENT -->
	<div class="container">
		<div class="jumbotron">
			<div style='text-align:center;font-size:12pt'>
				<?php

				# define ('CLASS_DIR', 'src/');
				# set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR); # path_separator = depende do OS
				# spl_autoload_register(); # registra automaticamente todas as classes que estao dentro do src
                define('CLASS_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR);
                set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
                spl_autoload_register(function($className) {
                    $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);
                    $file = CLASS_DIR . $path . '.php';
                    if (is_file($file)) {
                        require_once($file);
                    } else {
                        throw new \ErrorException("Could not load class {$className}. File not found: {$file}");
                        die();
                    }
                });

				$cliente = array();

				echo "<p><a href=/>Ordem Ascendente</a> | <a href=?descending=1>Ordem descendente</a></p>";


				for ($i=0; $i<10; $i++)
					{
					if ($i%2==0)
						{
						$cliente[$i] = new Maia\Cliente\ClientePF();
						$cliente[$i]->setCpf("$i$i$i$i$i$i$i$i$i-$i$i");
						$cliente[$i]->setTipo("PF");
						}
					else
						{
						$cliente[$i] = new Maia\Cliente\ClientePJ();
						$cliente[$i]->setCnpj("00$i\\000$i");
						$cliente[$i]->setTipo("PJ");
						}
					$cliente[$i]->setNome("Cliente do Code Education $i");
					$cliente[$i]->setEndereco("Rua dos Estudantes, $i");
					$cliente[$i]->setTelefone("(11) $i-$i$i$i$i-$i$i$i$i");
					$cliente[$i]->setEstrelas($i);
					}

				// IMPRIMINDO NOMES DOS CLIENTES
				if ( filter_input(INPUT_GET, "descending")!=null )
					{
					for ($i=9; $i>=0; $i--)
						{
						print "<p><a href='?details=$i'>" . $cliente[$i]->getNome() . "</a></p>";
						}
					}
				else
					{
					for ($i=0; $i<10; $i++)
						{
						print "<p><a href='?details=$i'>" . $cliente[$i]->getNome() . "</a></p>";
						}
					}

				if ( filter_input(INPUT_GET, "details")!=null )
					{
					echo "<br /><p>Cliente selecionado para exibir detalhes:</p>";
					echo "<p>Nome: " . $cliente[$_GET['details']]->getNome() . "</p>";
					echo "<p>Tipo: " . $cliente[$_GET['details']]->getTipo() . "</p>";
					echo "<p>Estrelas: " . $cliente[$_GET['details']]->getEstrelas() . "</p>";
					echo "<p>Endere&ccedil;o: " . $cliente[$_GET['details']]->getEndereco() . "</p>";
					if ($cliente[$_GET['details']] instanceof Maia\Cliente\ClientePF)
						{
						echo "<p>CPF: " . $cliente[$_GET['details']]->getCpf() . "</p>";
						}
					else if ($cliente[$_GET['details']] instanceof Maia\Cliente\ClientePJ)
						{
						echo "<p>CNPJ: " . $cliente[$_GET['details']]->getCnpj() . "</p>";
						}
					else
						{
						echo "<p>Erro ao acessar detalhe do cliente</p>";
						}
					echo "<p>Telefone: " . $cliente[$_GET['details']]->getTelefone() . "</p>";

					}

				?>
			</div>
		</div>
	</div>
<!-- END PAGE CONTENT -->





	<script src="js/bootstrap.min.js"></script>

	<div class="navbar navbar-default navbar-fixed-bottom">
		<div class="container">
			<p class="navbar-text pull-left">Todos os direitos reservados -
				<?php
				date_default_timezone_set("America/Sao_Paulo");
				echo date("Y");
				?></p>
			<a href="http://sites.code.education/home-code/" class="navbar-btn btn-danger btn pull-right">Go to real Code Education website</a>
		</div>
	</div>
</body>
</html>