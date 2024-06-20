<?php

abstract class RouteSwitch
{
  protected function home($params = [])
  {
    require __DIR__ . '/src/views/home.php';
  }

  protected function admin($params = [])
  {
    require __DIR__ . '/src/views/admin.php';
  }

  protected function postagem($params = [])
  {
    $id = isset($params['id']) ? $params['id'] : null;
    require __DIR__ . '/src/views/postagem.php';
  }

  public function __call($name, $arguments)
  {
    http_response_code(404);
    require __DIR__ . '/src/views/not-found.php';
  }
}
