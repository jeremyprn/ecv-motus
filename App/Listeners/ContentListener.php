<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Decorators\Decorator;

class ContentListener
{

    private $name = "ContentListener";

    public function getName()
    {
        return $this->name;
    }

    public function update($data)
    {
        if (APP_ENV === 'dev') {
            $decorator = new Decorator();
            $data = $decorator->decorate($data);
        }

        return $data;
    }
}
