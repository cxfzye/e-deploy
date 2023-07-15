<?php
try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
} catch (\Dotenv\Exception\InvalidPathException $e) {
    //
}
define('USER_PASS_SHA1', sha1('netcecpwsswordusername~!~!~+_)(*&%$#Q?<><?""}{{'));
define('USER_TOKEN_TIME', 86400);
define('VERIFY_CODE_EXPIRE', 300); //验证码到期time

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value =  isset($_ENV[$key]) ? $_ENV[$key] : $default;

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }
        return $value;
    }
}

/**
 * 密码加密
 * */
if (!function_exists('sha1_string')) {
    function sha1_string($string)
    {
        $string = sha1($string . USER_PASS_SHA1);
        return $string;
    }
}