<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
use CodeIgniter\HTTP\ResponseInterface;

class Post extends BaseController
{
    public function index()
    {
        $model = new PostModel();
        return $this->response->setJSON($model->findAll());
    }

    public function show($id)
    {
        $model = new PostModel();
        return $this->response->setJSON($model->find($id));
    }

    public function create()
    {
        $data = $this->request->getJSON();
        $model = new PostModel();
        $model->insert((array)$data);
        return $this->response->setJSON(['status' => 'created']);
    }

    public function update($id)
    {
        $data = $this->request->getJSON();
        $model = new PostModel();
        $model->update($id, (array)$data);
        return $this->response->setJSON(['status' => 'updated']);
    }

    public function delete($id)
    {
        $model = new PostModel();
        $model->delete($id);
        return $this->response->setJSON(['status' => 'deleted']);
    }
}
