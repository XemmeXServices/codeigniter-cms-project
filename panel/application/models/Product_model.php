<?php

class Product_model extends CI_Model
{

  public $tableName = "products";

  public function __construct()
  {
    parent::__construct();
  }

  /** Tüm Kayıtları bana getirecek olan metot.. */
  public function get_all($where = array(), $order = "id ASC")
  {
    return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
  }

  /** Bir ürün getiren metot */
  public function get($where = array())
  {
    return $this->db->where($where)->get($this->tableName)->row();
  }

  /** Ürün kaydı */
  public function add($data = array())
  {
    return $this->db->insert($this->tableName, $data);
  }

  /** Ürün güncelle */
  public function update($where = array(), $data = array())
  {
    return $this->db->where($where)->update($this->tableName, $data);
  }

  /** Ürün silme */
  public function delete($where = array())
  {
    return $this->db->where($where)->delete($this->tableName);
  }
}
