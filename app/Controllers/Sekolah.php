<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use phpDocumentor\Reflection\Types\Null_;

class Sekolah extends ResourceController
{
    protected $modelName = 'App\Models\SekolahModel';
    protected $format = 'json';
    public function index()
    {
        $post = $this->model->findAll();
        return $this->respond($post);
    }

    public function create()
    {
        helper(['form']);
        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',

        ];
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $data = [
                'nama' => $this->request->getVar('nama'),
                'alamat' => $this->request->getVar('alamat'),
                'kelurahan' => $this->request->getVar('kelurahan'),
                'kecamatan' => $this->request->getVar('kecamatan'),
                'kota' => $this->request->getVar('kota'),
            ];
            $id = $this->model->insert($data);
            $data['id'] = $id;

            return $this->respondCreated($data);
        }
    }

    public function delete($id = null)
    {
        $data = $this->model->find($id);
        $data['message'] = "Deleted id = $id";
        if ($data) {
            $this->model->delete($id);
            return $this->respond($data);
        } else {
            return $this->failNotFound('Item not Found');
        }
    }
}