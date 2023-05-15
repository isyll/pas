<?php

require_once dirname(__DIR__) . '/models/ArticleModel.php';

class ArticleController
{
  private $model;
  public function __construct()
  {
    $this->model = new ArticleModel();
  }

  public function jsonResponse(array $arr)
  {
    header('content-type:application/json;charset=utf-8');
    echo json_encode($arr);
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
        'errorCode' => 400,
        'errorMessage' => 'Les données sont invalides'
      ]);
    } else {
      $this->model->insert(
        ['libelle' => $datas['libelle'], 'prix' => (float) $datas['prix']]
      );
    }
  }
}