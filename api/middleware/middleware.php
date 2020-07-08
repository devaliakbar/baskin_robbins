<?php
class Middleware
{

    private static $FAIL_MSG = array("success" => false, "status" => "USER");

    public static function verifyToken()
    {
        require_once 'jwt/jwt_helper.php';

        if (!isset($_SERVER['HTTP_TOKEN'])) {
            echo json_encode(self::$FAIL_MSG);
            die();
        }

        $token = $_SERVER['HTTP_TOKEN'];

        $user = JWTHelper::validateToken($token);
        if ($user == null) {
            echo json_encode(self::$FAIL_MSG);
            die();
        }

        return $user;
    }
}
