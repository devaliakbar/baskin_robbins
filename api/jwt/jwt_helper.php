<?php
class JWTHelper
{
    private static $SERVER_KEY = '5f2b5cdbe5194f10b3241568fe4e2b24';

    public static function createToken($userId)
    {
        require_once 'jwt.php';
        $payloadArray = array();
        $payloadArray['userId'] = $userId;
        $token = JWT::encode($payloadArray, self::$SERVER_KEY);
        return $token;
    }

    public static function validateToken($token)
    {
        require_once 'jwt.php';
        try {
            $payload = JWT::decode($token, self::$SERVER_KEY, array('HS256'));
            $userId = $payload->userId;
        } catch (Exception $e) {
            $userId = null;
        }
        return $userId;
    }
}
