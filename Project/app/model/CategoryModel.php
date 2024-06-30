<?php
class CategoryModel{
  private $db;
  function __construct(){
    $this->db = new Database();
  }
  function getCate(){
    $sql="SELECT * FROM category";
    return $this->db->getAll($sql);
  }


}