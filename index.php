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

				echo "<p><a href=/>Ordem Ascendente</a> | <a href=?descending=1>Ordem descendente</a></p>";

                ############################
                # caberia um MVC aqui
                ############################

                # não é boa prática, pois aloca memória desnecessariamente.
                # Estou fazendo apenas para demonstração de OO, já que
                # MVC em PHP não foi ensinado até o momento.
                $clientes = array();

                # select * não é boa prática, mas é o que foi ensinado
                $q="select * from cliente left outer join clientepf ON clientepf.cliente_id = cliente.id left outer join clientepj on clientepj.cliente_id=cliente.id ";
                if ( filter_input(INPUT_GET, "details")!=null )
                {
                    $q.=" WHERE cliente.id=" . $_GET['details'];
                }
                if ( isset($_GET['descending']) )
                {
                    $q.=" ORDER BY cliente.nome DESC";
                }
                else
                {
                    $q.=" ORDER BY cliente.nome ASC";
                }
                # print $q;
                use Maia\Database\DB;
                $conexao = new Maia\Database\DB();
                $conexao = DB::connect();
                $stmt = $conexao->prepare($q);
                $stmt->execute();
                $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (sizeof($records)==0)
                {
                    echo "<div align='center'>Banco de dados vazio? Nenhum resultado encontrado... talvez você deva rodar a fixture?</div>";
                }
                else
                {
                        foreach ($records as $record)
                        {
                            if ($record['tipo']=='PF')
                            {
                                $clientes[] = new Maia\Cliente\ClientePF();
                                $clientes[count($clientes)-1]->setCpf($record['cpf']);
                            }
                            elseif ($record['tipo']=='PJ')
                            {
                                $clientes[] = new Maia\Cliente\ClientePJ();
                                $clientes[count($clientes)-1]->setCnpj($record['cnpj']);
                            }
                            else
                            {
                                echo "Tivemos um tipo inesperado aqui: " . $record['tipo'];
                            }
                            $clientes[count($clientes)-1]->setId($record['id']);
                            $clientes[count($clientes)-1]->setNome($record['nome']);
                            $clientes[count($clientes)-1]->setTipo($record['tipo']);
                            $clientes[count($clientes)-1]->setNome($record['nome']);
                            $clientes[count($clientes)-1]->setEstrelas($record['estrelas']);
                            $clientes[count($clientes)-1]->setEndereco($record['endereco']);
                        }
                    for ($i=0; $i<count($clientes);$i++)
                        {
                            echo "<p><a href='?details=" . $clientes[$i]->getId() . "'>" . $clientes[$i]->getNome() . "</a></p>";
                            if ( filter_input(INPUT_GET, "details")!=null )
                            {
                                echo "Endereco: " . $clientes[$i]->getEndereco();
                                echo "<br />Telefone: " . $clientes[$i]->getTelefone();
                                echo "<br />Estrelas: " . $clientes[$i]->getEstrelas();
                                echo "<br />Tipo: " . $clientes[$i]->getTipo();
                                if ($clientes[$i]->getTipo() =='PF')
                                {
                                    echo "<br />CPF: " . $clientes[$i]->getCpf();
                                }
                                else
                                {
                                    echo "<br />CNPJ: " . $clientes[$i]->getCnpj();
                                }
                            }
                        }

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