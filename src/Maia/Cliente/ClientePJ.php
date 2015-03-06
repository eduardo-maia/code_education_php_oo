<?php

namespace Maia\Cliente;

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