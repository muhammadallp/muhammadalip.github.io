<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class Product_model extends Model
{ 
    protected $table = "product";
    protected $primaryKey = "product_id";
    protected $allowedFields = ["product_name", "product_price","product_category", "deskripsi","image"];
    protected $useTimestamps = false;
     
    public function getCategory()
    {
        $builder = $this->db->table('category');
        return $builder->get();
    }
 
    public function getProduct()
    {
        $builder = $this->db->table('product');
        $builder->select('*');
        $builder->join('category', 'category_id = product_category_id','left');
        return $builder->get();
        
    }
 
    public function saveProduct($data){
        return $this->db->table('product')->insert($data);
        
    }
 
    public function updateProduct($data, $id)
    {   
        
        return $this->db->table('product')->update($data, array('product_id' => $id));
        
    }
 
    public function deleteProduct($id)
    {
        $query = $this->db->table('product')->delete(array('product_id' => $id));
        return $query;
    } 

    // category
    
    public function savekategori($data){
        return $this->db->table('category')->insert($data);
        
    }
 
    public function updatekatagori($data, $id)
    {
        return $this->db->table('category')->update($data, array('category_id' => $id));
        
    }
 
    public function deletekatagori($id)
    {
        $query = $this->db->table('category')->delete(array('category_id' => $id));
        return $query;
    } 

}