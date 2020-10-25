<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use phpDocumentor\Reflection\Types\Null_;

class Paket extends ResourceController
{
    protected $modelName = 'App\Models\PaketModel';
    protected $format = 'json';
    public function index()
    {
        // $post = $this->model->findAll();
        // $db      = \Config\Database::connect();
        // $builder = $db->table('siswa');
        // $join1 = $builder->join('sekolah', 'sekolah.id_sekolah = sekolah.id', 'inner');
        // $post   = $join1->get();
        // return $this->respond($post);
    }


    public function create()
    {
        helper(['form']);
        $rules = [
            'nama' => 'required',
        ];
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $data = [
                'nama' => $this->request->getVar('nama'),
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