<?php

class DB
	{

    const host = '127.0.0.1';
    const dbname = 'maia_education_code';
    const user = 'root'; # queria deixar claro que jamais faria isso em sistema produtivo...
    const password = '';


	public static function connect()
	    {
		try
			{
			return new \PDO("mysql:host=" . self::host . "; dbname=" . self::dbname , self::user,self::password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
			}
		catch (PDOException $e)
			{
			echo $e->getMessage() . "\n";
			echo $e->getTraceAsString() . "\n";
			}
	    }

    }

# Apenas para testes
# DB::connect();