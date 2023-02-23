<?php

namespace Nourman\UKK\Pembayaran\SPP\App;

class View
{

    public static function render(string $view, $model)
    {
        require __DIR__ . '/../Views/template/header.php';
        require __DIR__ . '/../Views/' . $view . '.php';
        require __DIR__ . '/../Views/template/footer.php';
    }

}