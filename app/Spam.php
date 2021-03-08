<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spam extends Model
{
    public function detect($body)
    {
        $this->detectInvalidKeywords($body);

        return false;
    }

    public function detectInvalidKeywords($body)
    {
        $invalidKeywords = [
            'yahoo customer service'
        ];

        foreach ($invalidKeywords as $keyword) {

            if(strpos($body, $keyword) !== false) {

                throw new \Exception('Your reply contains spam');
            }
        }




    }
}
