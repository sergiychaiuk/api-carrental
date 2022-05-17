<?php

namespace Core;

class Router
{
    static public function get($uri, $callback)
    {
        $pattern = self::createPattern($uri);

        if (preg_match($pattern, $_SERVER['REQUEST_URI'], $params) && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $params = self::clearParams($params);

            if (!empty($params)) {
                $request = ['params' => json_encode($params)];
            }

            call_user_func($callback, $request ?? []);
        }
    }

    static public function post($uri, $callback)
    {
        $pattern = self::createPattern($uri);

        if (preg_match($pattern, $_SERVER['REQUEST_URI'], $params) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $params = self::clearParams($params);

            !empty($_FILES) ?
                $request = ['data' => $_POST, 'file' => $_FILES] :
                $request = ['data' => $_POST];

            if (!empty($params)) {
                $request['params'] = json_encode($params);
            }

            call_user_func($callback, $request);
        }
    }

    static public function createPattern($uri): string
    {
        return '#^' . preg_replace('#/:([^/]+)#', '/(?<$1>[^/]+)', $uri) . '/?$#';
    }

    static private function clearParams($params): array
    {
        $result = [];

        foreach ($params as $key => $param) {
            if (!is_int($key)) {
                $result[$key] = $param;
            }
        }

        return $result;
    }
}
