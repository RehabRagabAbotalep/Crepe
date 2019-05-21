<?php
/**
 * Created by PhpStorm.
 * User: FR
 * Date: 2/11/2019
 * Time: 6:29 PM
 */

namespace App\Traits;


trait Responses
{

    protected function fullErrorResponse($message, $data = [])
    {
        $arr = is_array($data)? array_merge(["success" => false,"message" =>$this->ErrorMessages[$message]["message"]], $data):$data;
        return response()->json($arr, $this->ErrorMessages[$message]["statusCode"]);
    }

    protected function noContent()
    {
        return $this->successfulResponse(null, 204);
    }

    protected function successfulResponse($data = [], $statusCode = 200)
    {
        $arr = is_array($data) ? array_merge(["success"=>true],$data): $data;

        return response()->json($arr, $statusCode);
    }
}