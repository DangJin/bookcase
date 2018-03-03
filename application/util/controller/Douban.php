<?php

namespace app\util\controller;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use think\Controller;
use think\Request;

class Douban extends Common
{

    private $client;

    public function __construct(\think\Request $request = null)
    {
        parent::__construct($request);
        $this->client = new Client(
            [
                'base_uri' => 'https://api.douban.com',
            ]
        );
    }

    /**
     * @param \think\Request $req
     *
     * @return \think\response\Json
     */
    public function getBookByIsbn(Request $req)
    {
        try {
            $res = $this->client->request(
                'GET',
                '/v2/book/isbn/'.$req->get('isbn')
            );

            return returnJson(
                200, 200, json_decode(
                    $res->getBody()
                        ->getContents()
                )
            );

        } catch (RequestException $exception) {
            return returnJson(400, 400, $exception->getMessage());
        }
    }
}
