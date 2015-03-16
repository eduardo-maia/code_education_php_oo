<?php
# NÃO É BOA PRÁTICA ESTE ARQUIVO ESTÁ DENTRO DO http_docs OU SIMILAR.
# ELE DEVE SER EXECUTADO UMA VEZ E MOVIDO PARA OUTRO LOCAL.

namespace Maia\Database;


class Fixture
{
    private $conn;

    private $clientes;

    # Você terá que injetar no construtor dessa classe um objeto PDO (somente PDO).
    public function __construct(PDO $pdo)
    {
        $this->conn = $pdo;
    }

    # Crie um método chamado persist dentro dessa mesma classe;
    # esse método deverá receber como dependência um objeto do tipo Cliente
    public function persist(Cliente $c)
    {
        $this->clientes[]=$c;
    }

}

# define ('CLASS_DIR', 'src/');
# set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR); # path_separator = depende do OS
# spl_autoload_register(); # registra automaticamente todas as classes que estao dentro do src

#define('CLASS_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR);
define('CLASS_DIR', __DIR__ . DIRECTORY_SEPARATOR);
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

use DB;
use Maia\Cliente\ClientePF;


$f = new Fixture(DB::connect());

$c = new \Maia\Cliente\ClientePF();
$c->setEstrelas(1);
print $c->getEstrelas();
exit;

/*
echo "#### Executando Fixture ####\n";
echo "Dropando database ";
$conn->query("drop database if exists maia_education_code");
echo " - OK\n";

echo "Criando database ";
$conn->query("create database maia_education_code");
echo " - OK\n";

echo "Usando database ";
$conn->query("USE maia_education_code");
echo " - OK\n";


####################
# TABELA CLIENTE
####################

echo "Removendo tabela cliente";
$conn->query("DROP TABLE IF EXISTS cliente");
echo " - OK\n";

echo "Criando tabela cliente";
try
	{
	$conn->query("CREATE TABLE cliente
		(
		id tinyint auto_increment,
		Primary Key(id),
		nome varchar(45) NOT NULL,
		endereco varchar(45),
		telefone varchar(11),
		estrelas tinyint unsigned,
		tipo varchar(2), -- in 'PF' or 'PJ'
		constraint ck_tipo check (tipo in ('PF','PJ'))
		) ENGINE=InnoDB;
		");
	}
catch (PDOException $e)
	{
	die ( $e->getMessage() );
	}
echo " - OK\n";



####################
# TABELA CLIENTEPF
####################

echo "Removendo tabela clientePF";
$conn->query("DROP TABLE IF EXISTS clientePF");
echo " - OK\n";

echo "Criando tabela clientePF";
try
	{
	$conn->query("CREATE TABLE clientePF
		(
		cliente_id tinyint,
		Primary Key(cliente_id),
		Foreign Key (cliente_id) references cliente(id),
		cpf int(9) NOT NULL
		) ENGINE=InnoDB;
		");
	}
catch (PDOException $e)
	{
	die ( $e->getMessage() );
	}
echo " - OK\n";



####################
# TABELA CLIENTEPJ
####################

echo "Removendo tabela clientePJ";
$conn->query("DROP TABLE IF EXISTS clientePJ");
echo " - OK\n";

echo "Criando tabela clientePF";
try
	{
	$conn->query("CREATE TABLE clientePJ
		(
		cliente_id tinyint,
		Primary Key(cliente_id),
		Foreign Key (cliente_id) references cliente(id),
		CNPJ int(15) NOT NULL
		) ENGINE=InnoDB;
		");
	}
catch (PDOException $e)
	{
	die ( $e->getMessage() );
	}
echo " - OK\n";




echo "Inserindo dados...\n";


echo "Cliente 1 - Eduardo Maia (PF)";
$conn->query("INSERT INTO cliente (nome,endereco,telefone,estrelas,tipo) VALUES ('Eduardo Maia','Rua das Flores 123','11959031963',5,'PF')");
$conn->query("INSERT INTO clientePF (id,cpf) VALUES (1,'08234011707')");
echo " - OK\n";





echo "#### Concluído ####\n";




*/