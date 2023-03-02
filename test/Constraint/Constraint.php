<?php 

namespace Nourman\UKK\Pembayaran\SPP\Constraint;

interface Constraint {

	public function message(): string;

	public function handle();

	public function getResult();

	public function passMessage(): string;

	public function failMessage(): string;
}

 ?>