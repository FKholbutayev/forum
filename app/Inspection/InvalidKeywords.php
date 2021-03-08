<?php

namespace App\Inspection;


use Exception;

class InvalidKeywords {

    protected $keywords = [
        'yahoo customer service'
    ];

    public function detect($body)
    {
        foreach ($this->keywords as $keyword) {

            if(strpos($body, $keyword) !== false) {

                throw new Exception('Your reply contains spam');
            }
        }
    }
}
