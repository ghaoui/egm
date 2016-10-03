<?php

namespace EgmBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EgmBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
