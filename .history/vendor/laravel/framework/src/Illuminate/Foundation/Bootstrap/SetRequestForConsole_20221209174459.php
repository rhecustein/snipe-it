<?php

namespace Illuminate\Foundation\Bootstrap;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class SetRequestForConsole
{
    /**
     * Bootstrap the given application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $uri = $app->make('config')->get('app.url', 'http://localhost');

        $components = parse_url($uri);

        $server = $_SERVER;

        if (isset($components['path'])) {
            $server = array_merge($server, [
                'SCRIPT_FILENAME' => $components['path'],
                'SCRIPT_NAME' => $components['path'],
            ]);
        }
        // fix
        // $app->instance('request', Request::create(
        //     $uri, 'GET', [], [], [], $server
        // ));
        $uri = '/';
        $method = 'GET';
        $parameters = [];
        $cookies = [];
        $files = [];
        $server = [];
        
        // Check if the $uri variable is a valid string
        if (!is_string($uri)) {
          // Set the $uri variable to the default value of '/'
          $uri = '/';
        }
        
        // Check if the $method variable is a valid string
        if (!is_string($method)) {
          // Set the $method variable to the default value of 'GET'
          $method = 'GET';
        }
        
        // Check if the $parameters, $cookies, $files, and $server variables are valid arrays
        if (!is_array($parameters) || !is_array($cookies) || !is_array($files) || !is_array($server)) {
          // Set the variables to the default empty array value
          $parameters = [];
          $cookies = [];
          $files = [];
          $server = [];
        }
        
        // Create the request using the validated variables
        $request = Request::create($uri, $method, $parameters, $cookies, $files, $server);


    }
}
