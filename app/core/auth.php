<?php

class Auth {

    protected $permissions;

    public static function check()
    {
        if (
            !isset($_SESSION['logged']) ||
            $_SESSION['logged'] !== true ||
            (time() - $_SESSION['timeout']) >= SESSION_TIMEOUT
        ) {
            return false;
        }

        $_SESSION['timeout'] = time();

        return true;
    }

    public static function login($user, $password)
    {
        if (isset($user, $user->username, $user->password) && self::passwordVerify($password, $user->password)) {
            $_SESSION['logged'] = true;
            $_SESSION['user'] = $user->username;
            $_SESSION['timeout'] = time();
            $_SESSION['permissions'] = explode(',', $user->permissions);

            return true;
        } else {
            return false;
        }
    }

    protected static function passwordVerify($password, $hash)
    {
        if (strcmp(crypt($password, SALT), $hash)) {
            return false;
        }

        return true;
    }

    public static function canWrite()
    {
        if (in_array('write', $_SESSION['permissions'])) {
            return true;
        } else {
            return false;
        }
    }
}