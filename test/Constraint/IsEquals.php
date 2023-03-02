<?php 

namespace Nourman\UKK\Pembayaran\SPP\Constraint;

class IsEquals implements Constraint{

	public function __construct(private mixed $expected, private mixed $actual, private string $message = '') {

	}

	public function message(string $result = ''): string {
		return $this->message . ' -> ' . $result;
	}

	public function handle() {
		if ($this->actual == $this->expected) {
			return $this->message($this->passMessage());
		} 

		return $this->message($this->failMessage());
	}

	public function getResult() {
		echo $this->handle();
	}

	public function passMessage(): string {
		return "Test Success";
	}

	public function failMessage(): string{
		return "Test Failed, Expected : " . $this->expected . ', Actual : ' . $this->actual;
	}

}

 ?>