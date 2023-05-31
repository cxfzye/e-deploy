<?php
namespace App\Controller;

use App\Base\Base;
use App\Models\Bossgoo\Ad;
use Service\Activities\CloudExhibition;
use Service\Company\Company;
use Service\Activities\Ptp;
use Service\Message\Message;
use Service\Utils\Meta;
use Service\Utils\Valid;
use Service\Video\Video;
use Service\Products\Categories;

class Index extends Base
{
    public function index($request, $response, $args)
    {
        return $this->success($response, 'Welcom to deploy!');
    }
}
