<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'categories';
    protected $primaryKey       = 'category_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['category_name', 'category_status'];

    public function getCategory($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['category_id' => $id])->getRowArray();
        }
    }

    // public function insertCategory($data)
    // {
    //     $query = $this->db->table($this->table)->insert($data);
    //     if ($query) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function updateCategory($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['category_id' => $id]);
    }

    public function deleteCategory($id)
    {
        return $this->db->table($this->table)->delete(['category_id' => $id]);
    }
}
