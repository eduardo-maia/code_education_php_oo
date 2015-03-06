<?php

namespace Maia\Cliente;

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

