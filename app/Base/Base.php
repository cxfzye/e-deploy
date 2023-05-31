<?php
namespace  App\Base;

use Httpful\Mime;
use Psr\Container\ContainerInterface;

class Base
{
    public static $container;
    function __construct(ContainerInterface $c) {
        self::$container = $c;
    }

    public function success($response, $data = [],  $msg = '', $code = 1)
    {
        $rtn['code'] = $code;
        $rtn['data'] = $data;
        $rtn['msg'] = $msg;
        return $this->response($response, $rtn);
    }

    public function error($response, $msg = '',  $data = [], $code = 0)
    {
        $rtn['code'] = $code;
        $rtn['data'] = $data;
        $rtn['msg'] = $msg;
        return $this->response($response, $rtn);
    }

    public function response($response, $data)
    {
        $payload = json_encode($data);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getParsedBody($request)
    {
        switch ($_SERVER['CONTENT_TYPE'] ) {
            case Mime::JSON:
                $body = file_get_contents('php://input');
                return json_decode($body, true);
                break;
            default:
                $body = $request->getParsedBody();
                return $body;
        }
    }

    public function getQueryParams($request)
    {
        return $request->getQueryParams();
    }
}
