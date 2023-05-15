<?php

require_once dirname(__DIR__) . '/models/ArticleModel.php';

class ArticleController
{
  private $model;
  public function __construct()
  {
    $this->model = new ArticleModel();
  }

  public function jsonResponse(array $datas)
  {
    header('content-type:application/json;charset=utf-8');
    echo json_encode($datas);
  }

  public function all()
  {
    return $this->jsonResponse($this->model->all());
  }

  public function insert()
  {
    $jsonDatas = file_get_contents('php://input');
    $datas = json_decode($jsonDatas, true);

    if (null === $datas || !isset($datas['libelle']) || !isset($datas['prix'])) {
      header("HTTP/1.1 400 Bad Request");

      $this->jsonResponse([
        'code' => 400,
        'message' => 'Les données sont invalides'
      ]);
    } else {
      $this->model->insert(
        ['libelle' => $datas['libelle'], 'prix' => (float) $datas['prix']]
      );
    }
  }
}