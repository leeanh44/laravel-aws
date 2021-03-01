<?php

use Carbon\Carbon;

if (!function_exists('isLocalEnv')) {
    function isLocalEnv()
    {
        return config('app.env') === 'local';
    }
}

if (!function_exists('randomString')) {
    function randomString()
    {
        return md5(uniqid((string) rand(), true));
    }
}

if (!function_exists('encryptFileName')) {
    function encryptFileName(string $id, string $ext)
    {
        return sprintf("%s.%s", md5($id), $ext);
    }
}

if (!function_exists('formatDate')) {
    function formatDate(string $date, string $format)
    {
        return $date ? Carbon::parse($date)->format($format) : '';
    }
}
