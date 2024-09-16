<?php

namespace App\Html;

use App\Repositories\CountyRepository;

class Request
{
    static function handle() {
        switch ($_SERVER["REQUEST_METHOD"]) {
            /*case "POST":
                self::postRequest();
                break;
            case "PUT":
                self::putRequest();
                break;*/
            case "GET":
                self::getRequest();
                break;
            /*case "DELETE":
                self::deleteRequest();
                break;*/
            default:
                echo 'Unknown request type';
                break;
        }
    }

    private static function getRequest() {
        $resourceName = self::getResourceName();
        switch ($resourceName) {
            case 'counties':
                $db = new CountyRepository();
                $code = 200;

                $entities = $db->getAll();
                if (empty($entities)) {
                    $code = 404;
                }
                Response::response(data: $entities, code: $code);
                break;
            default:
                Response::response(
                    data: [],
                    code: 404,
                    message: $_SERVER['REQUEST_URI'] . " not found"
                );
        }
    }

    private static function getResourceName(): string 
    {
        $arrUri = self::getArrUri(requestUri: $_SERVER['REQUEST_URI']);
        $result = $arrUri[count(value:$arrUri) - 1];
        if(is_numeric(value: $result)) {
            $result = $arrUri[count(value: $arrUri) - 2];
        }

        return $result;
    }

    private static function getArrUri(string $requestUri): ?array
    {
        return explode(separator: "/", string: $requestUri) ?? null;
    }
}