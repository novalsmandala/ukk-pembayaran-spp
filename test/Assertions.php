<?php 

namespace Nourman\UKK\Pembayaran\SPP;

use Nourman\UKK\Pembayaran\SPP\Constraint\IsEquals;
use Nourman\UKK\Pembayaran\SPP\Constraint\NotNull;
use Nourman\UKK\Pembayaran\SPP\Constraint\IsIdentical;

class Assertions {

	public static function assertEquals(mixed $expected = 1, mixed $actual = 0, string $message = '') {
		$isEqual = new IsEquals($expected, $actual, debug_backtrace()[1]['function']);
		$isEqual->getResult();
	}

	public static function assertNotNull(mixed $value = null, string $message = '') {
		$notNull = new NotNull($value, debug_backtrace()[1]['function']);
		$notNull->getResult();
	}

	public static function assertSame(mixed $value1 = null, mixed $value2 = null, string $message = '') {
		$isIdentical = new IsIdentical($value1, $value2, debug_backtrace()[1]['function']);
		$isIdentical->getResult();
	}
}

 ?>