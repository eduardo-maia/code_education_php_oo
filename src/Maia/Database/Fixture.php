<?php
# NÃO É BOA PRÁTICA ESTE ARQUIVO ESTÁ DENTRO DO http_docs OU SIMILAR.
# ELE DEVE SER EXECUTADO UMA VEZ E MOVIDO PARA OUTRO LOCAL.

namespace Maia\Database;

use DB;
use Maia\Cliente\Cliente;

class Fixture
{
    private $conn;

    private $clientes;

    # Você terá que injetar no construtor dessa classe um objeto PDO (somente PDO).
    private function __construct()
    {
        $this->conn = DB::connect(); # isso nao é legal porque esta criando outro objeto automaticamente, conforme explicado em aula
    }

    # Crie um método chamado persist dentro dessa mesma classe;
    # esse método deverá receber como dependência um objeto do tipo Cliente
    private function persist(Cliente $c)
    {
        $this->clientes[]=$c;
    }

}

$c = new Maia\Cliente\Cliente();
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