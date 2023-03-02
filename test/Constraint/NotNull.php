<?php 

namespace Nourman\UKK\Pembayaran\SPP\Constraint;

class NotNull implements Constraint{

	public function __construct(private mixed $value, private string $message = '') {

	}

	public function message(string $result = ''): string {
		return $this->message . ' -> ' . $result;
	}

	public function handle() {
		if (is_null($this->value)) {
			return $this->message($this->failMessage());
		} 
		return $this->message($this->passMessage());
	}

	public function getResult() {
		echo $this->handle();
	}

	public function passMessage(): string {
		return "Test Success";
	}

	public function failMessage(): string{
		return "Test Failed, Actual result is null";
	}

}

 ?>