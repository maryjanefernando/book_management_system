<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array $result
     * @param string $message
     * @param string $type
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function response($result = array(), $message = "", $status = 0, $type = "success") {
        return response()->json([
            'result' => $result,
            'message' => $message,
            'type' => $type,
            'status' => $status,
        ]);
    }

    public function enableSearchBy($allowedFields = array(), $searchText) {

    }
}
