<?php

interface ClienteInterface
{
	public function getEndereco();
	public function setEndereco();
	public function getNome();
	public function setNome();
	public function getTelefone();
	public function setTelefone();
	public function setTipo(); // PF ou PJ
	public function getTipo();
	public function setEstrelas($estrelas);
	public function getEstrelas();
}

class Cliente implements ClienteInterface
{
	private $nome;
	private $endereco;
	private $telefone;
	private $tipo;
	private $estrelas;
	
	public function getEstrelas()
	{
		return $this->estrelas;
	}

	public function setEstrelas($estrelas)
	{
		$this->estrelas = $estrelas;
	}

	public function getTipo()
	{
		return $this->tipo;
	}

	public function setTipo($tipo=null)
	{
		$this->tipo = $tipo;
	}

	public function getNome()
	{
		return $this->nome;
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

	public function setEndereco($endereco=null)
	{
		$this->endereco=$endereco;
	}

	public function setTelefone($telefone=null)
	{
		$this->telefone = $telefone;
	}
}

class ClientePF extends Cliente implements ClienteInterface
{
	private $cpf;
	
	public function getCpf()
	{
		return $this->cpf;
	}

	public function setCpf($cpf=null)
	{
		$this->cpf = $cpf;
	}
}

class ClientePJ extends Cliente implements ClienteInterface
{
	private $cnpj;
	
	public function getCnpj()
	{
		return $this->cnpj;
	}

	public function setCnpj($cnpj=null)
	{
		$this->cnpj = $cnpj;
	}
}

?>