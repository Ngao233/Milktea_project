<?php

class ProductController{
  public $data = [];
  public $listpro = [];

  public function __construct(){
    global $$listproduct;
    $this->listpro = $listproduct;
  }
  public function renderView($data,$view){
    extract($data);
    $view = 'app/view/'.$view.'.php';
    require_once $view;

  }
  public function viewDetail(){
    if(isset($_GET['id'])){
      $id = $_GET['id'];
      foreach($this ->listpro as $item){
        if($item['id'] ==$id){
          $this -> data = $item;
        }
      }
      $this ->renderView($this->data,'detail');
    }
  }

}

?>