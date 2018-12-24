<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class ReadRequestComponent extends Component
{
    public function isGet()
    {
        return $this->request->is('get');
    }
}
