<?php

namespace Maia\Cliente;

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