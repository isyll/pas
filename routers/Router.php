<?php

class Router
{
  public function route()
  {
    $method = $_SERVER['REQUEST_METHOD'];
    $uri    = $_SERVER['REQUEST_URI'];

    if (false !== $pos = strpos($uri, '?')) {
      $uri = substr($uri, 0, $pos);
    }

    switch ($uri) {
      case '/article/all':
        require_once dirname(__DIR__) . '/controllers/ArticleController.php';
        $arc = new ArticleController();
        $arc->all();
        break;
      case '/article/ajouter':
        if ($method == 'POST') {
          require_once dirname(__DIR__) . '/controllers/ArticleController.php';
          $arc = new ArticleController();
          echo $arc->insert();
        }
        break;
    }
  }
}