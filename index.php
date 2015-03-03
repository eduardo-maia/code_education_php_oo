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
				require_once "Cliente.php";

				$cliente = array();

				echo "<p><a href=/>Ordem Ascendente</a> | <a href=?descending>Ordem descendente</a></p>";


				if ( !isset($_GET['descending']))
					{
					for ($i=0; $i<10; $i++)
						{
						$cliente[$i] = new Cliente();
						$cliente[$i]->setNome("Cliente do Code Education $i");
						$cliente[$i]->setEndereco("Rua dos Estudantes, $i");
						$cliente[$i]->setTelefone("(11) $i-$i$i$i$i-$i$i$i$i");
						$cliente[$i]->setCpf("$i$i$i$i$i$i$i$i$i-$i$i");

						echo "<p><a href=?details=$i>" . $cliente[$i]->getNome() . "</a></p>";
						}
					}
				else
					{
					for ($i=9; $i>=0; $i--)
						{
						$cliente[$i] = new Cliente();
						$cliente[$i]->setNome("Cliente do Code Education $i");
						$cliente[$i]->setEndereco("Rua dos Estudantes, $i");
						$cliente[$i]->setTelefone("(11) $i-$i$i$i$i-$i$i$i$i");
						$cliente[$i]->setCpf("$i$i$i$i$i$i$i$i$i-$i$i");

						echo "<p><a href=?details=$i>" . $cliente[$i]->getNome() . "</a></p>";
						}
					}

				if ( isset($_GET['details']) )
					{
					echo "<br /><p>Cliente selecionado para exibir detalhes:</p>";
					echo "<p>Nome: " . $cliente[$_GET['details']]->getNome() . "</p>";
					echo "<p>Endere&ccedil;o: " . $cliente[$_GET['details']]->getEndereco() . "</p>";
					echo "<p>CPF: " . $cliente[$_GET['details']]->getCpf() . "</p>";
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