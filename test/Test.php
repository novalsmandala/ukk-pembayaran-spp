<?php 

namespace Nourman\UKK\Pembayaran\SPP;

class Test {

  public function __construct()
    {
      $methods = get_class_methods($this);

        forEach($methods as $method)
        {
          // var_dump($methods);
            if($method !== "__construct")
            {
                echo $this->{$method}() . PHP_EOL;
            }
        }
    }
}

// new Test();

 ?>