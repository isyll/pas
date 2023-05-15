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
    // if (
    //   isset($_POST['prix']) &&
    //   is_numeric($_POST['prix']) &&
    //   isset($_POST['libelle'])
    // ) {
    //   $this->model->insert(
    //     ['libelle' => $_POST['libelle'], 'prix' => (float) $_POST['prix']]
    //   );
    // }

    $jsonDatas = file_get_contents('php://input');

    $datas = json_decode($jsonDatas, true);
    if (null === $datas) {
      echo 'invalide';
    } else {
      echo $this->model->insert(
        ['libelle' => $datas['libelle'], 'prix' => (float) $datas['prix']]
      );
    }
  }
}