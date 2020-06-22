<?php
namespace App\Http\Controllers\Admin\API\Resources;

use http\Message;
use Symfony\Component\HttpFoundation\JsonResponse;

class Error extends JsonResponse
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public static function JsonError($error=null,$code=null,$status=null,$messageAr=null,$messageEn=null)
    {
        if($error==0 || !in_array($error,[404,401,403,422,400])) {
            $error = 500;
            $messageEn='General server error';
            $messageAr='خطأ عام';
            $code=500;

        }
        return response()->json(
            [
                'code' => $code,
                'error' => intval($error),
                'status' => $status,
                'messageAr' => $messageAr,
                'message' => $messageEn,

            ]
        );

    }
}