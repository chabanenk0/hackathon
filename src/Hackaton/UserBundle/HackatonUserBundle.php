<?php

namespace Hackaton\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class HackatonUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
