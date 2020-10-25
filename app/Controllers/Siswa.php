<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use phpDocumentor\Reflection\Types\Null_;

use App\Models\SiswaModel;
use App\Models\SekolahModel;

class Siswa extends ResourceController
{
    protected $modelName = 'App\Models\SiswaModel';
    protected $SiswaModel;
    protected $SekolahModel;
    protected $format = 'json';

    public function __construct()
    {
        $this->SiswaModel = new SiswaModel;
        $this->SekolahModel = new SekolahModel;
    }

    public function index()
    {

        $db      = \Config\Database::connect();
        $q = $db->query('SELECT siswa.*, sekolah.nama as nama_sekolah, paket.nama as nama_paket FROM siswa 
            left JOIN sekolah on siswa.id_sekolah = sekolah.id
            left JOIN paket on siswa.id_paket = paket.id')->getResultArray();
        return $this->respond($q);
    }

    public function show($id = null)
    {
        $db      = \Config\Database::connect();
        $data = $db->query("SELECT siswa.*, sekolah.nama as nama_sekolah, paket.nama as nama_paket FROM siswa 
            left JOIN sekolah on siswa.id_sekolah = sekolah.id
            left JOIN paket on siswa.id_paket = paket.id WHERE siswa.id='$id'")->getResultArray();

        if ($data) {

            return $this->respond($data);
        } else {
            return $this->failNotFound('Item not Found');
        }
    }

    public function create()
    {
        helper(['form']);
        $rules = [
            'nomor_induk' => 'required',
            'id_sekolah' => 'required',
            'id_paket' => 'required'
        ];
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $data = [
                'nama' => $this->request->getVar('nama'),
                'nomor_induk' => $this->request->getVar('nomor_induk'),
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                'alamat' => $this->request->getVar('alamat'),
                'nama_wali' => $this->request->getVar('nama_wali'),
                'nomor_telepon' => $this->request->getVar('nomor_telepon'),
                'id_sekolah' => $this->request->getVar('id_sekolah'),
                'id_paket' => $this->request->getVar('id_paket')
            ];
            $nomor_induk = $this->model->insert($data);
            $data['id'] = $nomor_induk;

            return $this->respondCreated($data);
        }
    }

    public function update($id = null)
    {
        helper(['form']);

        $rules = [
            'id_sekolah' => 'required',
            'id_paket' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'id' => $id,
                'nama' => $input['nama'],
                'nomor_induk' => $input['nomor_induk'],
                'jenis_kelamin' => $input['jenis_kelamin'],
                'tanggal_lahir' => $input['tanggal_lahir'],
                'alamat' => $input['alamat'],
                'nama_wali' => $input['nama_wali'],
                'nomor_telepon' => $input['nomor_telepon'],
                'id_sekolah' => $input['id_sekolah'],
                'id_paket' => $input['id_paket']
            ];

            $this->model->save($data);
            return $this->respond($data);
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