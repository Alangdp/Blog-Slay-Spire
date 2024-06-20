<?php

require_once __DIR__ . '/RouteSwitch.php';

class Router extends RouteSwitch
{
  public function run(string $requestUri)
  {
    $parsedUrl = parse_url($requestUri);
    $route = isset($parsedUrl['path']) ? trim($parsedUrl['path'], '/') : '';
    parse_str(isset($parsedUrl['query']) ? $parsedUrl['query'] : '', $params);

    if ($route === '') {
      $this->home($params);
    } else {
      $this->route($route, $params);
    }
  }

  private function route($route, $params)
  {
    if (method_exists($this, $route)) {
      $this->$route($params);
    } else {
      $this->__call($route, $params);
    }
  }
}
