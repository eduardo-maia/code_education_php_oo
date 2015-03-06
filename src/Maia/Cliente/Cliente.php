<?php

namespace Maia\Cliente;

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
