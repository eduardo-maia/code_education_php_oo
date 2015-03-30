<?php
# NÃO É BOA PRÁTICA ESTE ARQUIVO ESTÁ DENTRO DO http_docs OU SIMILAR.
# ELE DEVE SER EXECUTADO UMA VEZ E MOVIDO PARA OUTRO LOCAL.

namespace Maia\Database;


class DB
{
    # Optei por trazer este método para dentro da fixture, ao invés de utilizá-lo dentro da classe DB
    # A idéia é que a classe DB conecte-se (através do site) ao database já criado e povoado, ou gere um erro caso
    # o database não exista, ou outro motivo qualquer. Dentro da fixture, não necessariamente o database
    # estará criado, de forma que não desejo um tratamento deste tipo de exceção dentro da classe DB.
    # A orientação a copy and paste de host, dbname, user e password não é adequada. Porém, como vamos rodar
    # a fixture apenas uma vez, e depois ela será descartada, considero este approach aceitável. O melhor seria
    # que host, dbname, user e password fosse um include, mas mais uma vez considero isso aceitável.
    const host = '127.0.0.1';
    const dbname = 'maia_education_code';
    const user = 'root'; # queria deixar claro que jamais faria isso em sistema produtivo...
    const password = '';
    public static function connect()
    {
        try
        {
            return new \PDO("mysql:host=" . self::host , self::user,self::password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        }
        catch (PDOException $e)
        {
            echo $e->getMessage() . "\n";
            echo $e->getTraceAsString() . "\n";
        }
    }

}


class Fixture
{
    private $conn;
    private $clientes;


    # Você terá que injetar no construtor dessa classe um objeto PDO (somente PDO).
    public function __construct(\PDO $pdo)
    {
        $this->conn = $pdo;
    }

    # Crie um método chamado persist dentro dessa mesma classe;
    # esse método deverá receber como dependência um objeto do tipo Cliente
    public function persist($c)
    {
        $this->clientes[]=$c;
    }

    # o mais correto seria ter colocado try catch para cada query
    private function createDatabaseAndTables()
    {
        echo "Dropando database ";
        $this->conn->query("drop database if exists maia_education_code");
        echo " - OK\n";

        echo "Criando database ";
        $this->conn->query("create database maia_education_code");
        echo " - OK\n";

        echo "Usando database ";
        $this->conn->query("USE maia_education_code");
        echo " - OK\n";

        echo "Removendo tabela cliente";
        $this->conn->query("DROP TABLE IF EXISTS cliente");
        echo " - OK\n";

        echo "Criando tabela cliente";
        $this->conn->query("CREATE TABLE cliente (
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
        echo " - OK\n";

        echo "Removendo tabela clientePF";
        $this->conn->query("DROP TABLE IF EXISTS clientepf");
        echo " - OK\n";

        echo "Criando tabela clientePF";
        $this->conn->query("CREATE TABLE clientepf
            (
            cliente_id tinyint,
            Primary Key(cliente_id),
            Foreign Key (cliente_id) references cliente(id),
            cpf int(9) NOT NULL
            ) ENGINE=InnoDB;
            ");
        echo " - OK\n";

        echo "Removendo tabela clientepj";
        $this->conn->query("DROP TABLE IF EXISTS clientepj");
        echo " - OK\n";

        echo "Criando tabela clientepj";
        $this->conn->query("CREATE TABLE clientepj
            (
            cliente_id tinyint,
            Primary Key(cliente_id),
            Foreign Key (cliente_id) references cliente(id),
            cnpj int(15) NOT NULL
            ) ENGINE=InnoDB;
            ");
        echo " - OK\n";
    }


    public function flush()
    {
        $this->createDatabaseAndTables();

        for ($i=0; $i<count($this->clientes); $i++)
        {
            echo "Inserindo cliente " . ($i+1) . "... ";

            $this->conn->query("INSERT INTO cliente (nome,endereco,telefone,estrelas,tipo) VALUES (" . $this->conn->quote($this->clientes[$i]->getNome()) . "," . $this->conn->quote($this->clientes[$i]->getEndereco())  . "," . $this->conn->quote($this->clientes[$i]->getTelefone()) . "," . $this->conn->quote($this->clientes[$i]->getEstrelas()) . "," . $this->conn->quote($this->clientes[$i]->getTipo()) . ")");
            $cliente_id = $this->conn->lastInsertId();

            if ($this->clientes[$i]->getTipo() == 'PF')
            {
                $q="INSERT INTO clientepf (cliente_id,cpf) VALUES ($cliente_id," . $this->conn->quote($this->clientes[$i]->getCpf())  .  ")";
                # print "\n\n$q\n\n";
                $this->conn->query($q);
            }
            else if ($this->clientes[$i]->getTipo() == 'PJ')
            {
                $this->conn->query("INSERT INTO clientepj (cliente_id,cnpj) VALUES ($cliente_id," . $this->conn->quote($this->clientes[$i]->getCnpj())  .  ")");
            }
            else
            {
                echo "Tipo desconhecido: " . $this->clientes[$i]->getTipo();
            }

            //$this->conn->query("INSERT INTO clientePF (id,cpf) VALUES (1,'08234011707')");
            echo "OK\n";
        }
    }
}

define('CLASS_DIR', __DIR__  . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR );
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register(function($className) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $file = CLASS_DIR . $path . '.php';
    # echo ">> $file\n\n";
    if (is_file($file)) {
        require_once($file);
    } else {
        throw new \ErrorException("Could not load class {$className}. File not found: {$file}");
        die();
    }
});

use Maia\Cliente\ClientePF;
use Maia\Cliente\ClientePJ;

$f = new Fixture(DB::connect());

$c = new \Maia\Cliente\ClientePF();
$c->setEstrelas(100);
$c->setTipo('PF');
$c->setNome('Jose da Silva');
$c->setEndereco('Travessa das Flores 123');
$c->setTelefone('11 9 9999 9999');
$c->setCpf('00000000000');
$f->persist($c);

$c = new \Maia\Cliente\ClientePF();
$c->setEstrelas(10);
$c->setTipo('PF');
$c->setNome('Jose Maria');
$c->setEndereco('Travessa das Flores 1234');
$c->setTelefone('11 9 9999 9998');
$c->setCpf('11111111111');
$f->persist($c);

$c = new \Maia\Cliente\ClientePF();
$c->setEstrelas(123);
$c->setTipo('PF');
$c->setNome('Jose Maria Silvano');
$c->setEndereco('Travessa das Flores 321');
$c->setTelefone('11 9 9999 9997');
$c->setCpf('22222222222');
$f->persist($c);

$c = new \Maia\Cliente\ClientePJ();
$c->setEstrelas(1000);
$c->setTipo('PJ');
$c->setNome('Code Education');
$c->setEndereco('Travessa das Flores 333');
$c->setTelefone('11 9 9999 9996');
$c->setCnpj('0000000000000\0001');
$f->persist($c);

$c = new \Maia\Cliente\ClientePJ();
$c->setEstrelas(1000);
$c->setTipo('PJ');
$c->setNome('Maiasoft Informatica LTDA ME');
$c->setEndereco('Travessa das Flores 1111');
$c->setTelefone('11 9 9999 9995');
$c->setCnpj('1111111111111\0001');
$f->persist($c);

# Vamos utilizar apenas os clientes acima, não considero necessário mais copy and paste para criar mais clientes

$f->flush();

/*

echo "Inserindo dados...\n";

echo "Cliente 1 - Eduardo Maia (PF)";
$conn->query("INSERT INTO cliente (nome,endereco,telefone,estrelas,tipo) VALUES ('Eduardo Maia','Rua das Flores 123','11959031963',5,'PF')");
$conn->query("INSERT INTO clientePF (id,cpf) VALUES (1,'08234011707')");
echo " - OK\n";

echo "#### Concluído ####\n";

*/