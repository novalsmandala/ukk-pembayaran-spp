<?php 

namespace Nourman\UKK\Pembayaran\SPP\Constraint;

class IsIdentical implements Constraint{

	public function __construct(private mixed $value1, private mixed $value2, private string $message = '') {

	}

	public function message(string $result = ''): string {
		return $this->message . ' -> ' . $result;
	}

	public function handle() {
		if (get_class($this->value1) === get_class($this->value2)) {
			return $this->message($this->passMessage());
		} else
		{
			return $this->message($this->failMessage());
		}
	}

	public function getResult() {
		echo $this->handle();
	}

	public function passMessage(): string {
		return "Test Success";
	}

	public function failMessage(): string{
		return "Test Failed, Object not same";
	}

}

 ?>