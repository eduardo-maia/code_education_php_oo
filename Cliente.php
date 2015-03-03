<?php

class Cliente
{
	private $nome;
	private $cpf;
	private $endereco;
	private $telefone;
	
	public function getNome()
	{
		return $this->nome;
	}

	public function getCpf()
	{
		return $this->cpf;
	}

	public function getEndereco()
	{
		return $this->endereco;
	}

	public function getTelefone()
	{
		return $this->telefone;
	}


	public function setNome($nome=null)
	{
		$this->nome = $nome;
	}

	public function setCpf($cpf=null)
	{
		$this->cpf = $cpf;
	}

	public function setEndereco($endereco=null)
	{
		$this->endereco=$endereco;
	}

	public function setTelefone($telefone=null)
	{
		$this->telefone = $telefone;
	}


}

?>