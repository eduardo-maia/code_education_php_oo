<?php

error_reporting(E_ALL);

class DB
{
    const host = '127.0.0.1';
    const dbname = 'maia_education_code';
    const user = 'root'; # queria deixar claro que jamais faria isso em sistema produtivo...
    const password = '';

    public function __construct()
    {
        try
        {
            return new \PDO("mysql:host=" . self::host, self::user, self::password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        }
        catch (PDOException $e)
        {
            echo $e->getMessage() . "\n";
            echo $e->getTraceAsString() . "\n";
        }
    }

}

$pdo = new DB();
$pdo->prepare("select sysdate()");
?>