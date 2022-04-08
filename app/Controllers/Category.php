<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\HTTP\RequestTrait;
use CodeIgniter\RESTful\ResourceController;

class Category extends ResourceController
{

    public function __construct()
    {
        $this->category = new CategoryModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    use RequestTrait;
    public function index()
    {
        $categories = $this->category->getCategory();

        foreach ($categories as $row) {
            $category_all[] = [
                'category_id' => intval($row['category_id']),
                'category_name' => ($row['category_name']),
                'category_status' => ($row['category_status']),

            ];
        }

        return $this->respond($category_all, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $category = $this->category->getCategory($id);
        if (!empty($category)) {
            $output = [
                'category_id' => intval($category['category_id']),
                'category_name' => $category['category_name'],
                'category_status' => $category['category_status'],
            ];
            return $this->respond($output, 200);
        } else {
            $output = [
                'status' => 0,
                'message' => 'Data Menemukan Data'
            ];
            return $this->respond($output, 400);
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $data = [
            'category_name' => $this->request->getVar('category_name'),
            'category_status' => $this->request->getVar('category_status'),
        ];

        $simpan = $this->category->save($data);
        if ($simpan) {
            $output = [
                'status' => 1,
                'message' => 'Data Berhasil Disimpan'
            ];
        } else {
            $output = [
                'status' => 0,
                'message' => 'Data Gagal Disimpan'
            ];
        }
        return $this->respond($output);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $category = $this->category->getCategory($id);
        if (!empty($category)) {
            $output = [
                'category_id' => intval($category['category_id']),
                'category_name' => $category['category_name'],
                'category_status' => $category['category_status'],
            ];
            return $this->respond($output, 200);
        } else {
            $output = [
                'status' => 0,
                'message' => 'Data Menemukan Data'
            ];
            return $this->respond($output, 400);
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        // Menangkap data dari method PUT, DELETE, PATCH
        $data = $this->request->getRawInput();

        // Cek data category berdasarkan id
        $category = $this->category->getCategory($id);

        if (!empty($category)) {
            $updateCategory = $this->category->updateCategory($data, $id);
            $output = [
                'status' => 1,
                'message' => 'Update Successfully'
            ];
        } else {
            $output = [
                'status' => 1,
                'message' => 'Update Failed'
            ];
        }
        return $this->respond($output);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $category = $this->category->getCategory($id);

        if (!empty($category)) {
            $deleteCategory = $this->category->deleteCategory($id);
            $output = [
                'status' => 1,
                'message' => 'Delete Successfully'
            ];
        } else {
            $output = [
                'status' => 1,
                'message' => 'Delete Failed'
            ];
        }
        return $this->respond($output);
    }
}
