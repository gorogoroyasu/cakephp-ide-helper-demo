<?php

namespace App\View\Helper;

use Cake\View\Helper;

class UsersHelper extends Helper
{
    public function passwordChanged($b) : string
    {
        if ($b) {
            return 'CHANGE PASSWORD, NOW!';
        }

        return 'good! password has changed!';
    }
}