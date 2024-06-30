<?php
class HomeController {
  private $category;
  private $product;
  protected $data;

  function __construct() {
      $this->category = new CategoryModel();
  }

  public function view($data) {
      $this->data = $data;
      require_once('app/view/home.php');
  }

  function home() {
      $this->data['dsdm'] = $this->category->getCate();
      $this->view($this->data);
  }


}