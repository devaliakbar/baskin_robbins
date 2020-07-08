<?php
class JWTHelper
{
    private static $SERVER_KEY = '5f2b5cdbe5194f10b3241568fe4e2b24';

    public static function createToken($userId)
    {
        require_once 'jwt/jwt.php';
        $payloadArray = array();
        $payloadArray['created_on'] = time();
        $payloadArray['userId'] = $userId;
        $token = JWT::encode($payloadArray, self::$SERVER_KEY);

        $isSavedToken = self::saveToken($userId, $token);

        if ($isSavedToken) {
            return $token;
        }
        return null;
    }

    public static function saveToken($userId, $token)
    {
        require 'db/db.php';
        require_once 'db/table/jwt_token.php';

        $TokenSaveQuery = "INSERT INTO " . JWTToken::$TABLE_NAME . "(
            " . JWTToken::$COLUMN_USER_ID . " ,
            " . JWTToken::$COLUMN_TOKEN . "
        )
        VALUES('" . $userId . "' , '" . $token . "')";

        if (mysqli_query($conn, $TokenSaveQuery)) {
            return true;
        } else {
            return false;
        }
    }

    public static function validateToken($token)
    {
        require_once 'jwt/jwt.php';
        try {
            $payload = JWT::decode($token, self::$SERVER_KEY, array('HS256'));
            $userId = $payload->userId;

            if (!self::checkTokenExist($token)) {
                return null;
            }

            $user = self::getUser($userId);
            if ($user == null) {
                return null;
            }
            $user['token'] = $token;
            return $user;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getUser($userId)
    {
        require 'db/db.php';
        require_once 'db/table/user.php';

        $UserQuery = "SELECT
        " . User::$ID . " ,
        " . User::$COLUMN_NAME . " ,
        " . User::$COLUMN_USERNAME . " ,
        " . User::$COLUMN_TYPE . "
        FROM
        " . User::$TABLE_NAME . "
        WHERE
        " . User::$ID . " = '" . $userId . "'";

        $userResult = mysqli_query($conn, $UserQuery);

        if (mysqli_num_rows($userResult) > 0) {
            $userInfo = mysqli_fetch_assoc($userResult);

            $user = array();
            $user['userId'] = $userInfo[User::$ID];
            $user['name'] = $userInfo[User::$COLUMN_NAME];
            $user['username'] = $userInfo[User::$COLUMN_USERNAME];
            $user['type'] = $userInfo[User::$COLUMN_TYPE];

            return $user;
        } else {
            return null;
        }
    }

    public static function checkTokenExist($token)
    {
        require 'db/db.php';
        require_once 'db/table/jwt_token.php';

        $TokenCheckQuery = "SELECT
        " . JWTToken::$ID . "
        FROM
        " . JWTToken::$TABLE_NAME . "
        WHERE
        " . JWTToken::$COLUMN_TOKEN . " = '" . $token . "'";

        $tokenCheckResult = mysqli_query($conn, $TokenCheckQuery);

        if (mysqli_num_rows($tokenCheckResult) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
