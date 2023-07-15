<?php
namespace App\Controller;

use App\Base\Base;

class Index extends Base
{
    public function index($request, $response, $args)
    {
        return $this->success($response, 'Welcom to deploy!');
    }
}
