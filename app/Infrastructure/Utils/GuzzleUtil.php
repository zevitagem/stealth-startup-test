<?php

namespace App\Infrastructure\Utils;

use Psr\Http\Message\ResponseInterface;

class GuzzleUtil
{

    public static function extractResponse(ResponseInterface $requester)
    {
        $content = $requester->getBody()->getContents();
        $json    = json_decode($content, true);

        return $json;
    }
}