<?php 

defined('BASEPATH') OR exit ('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('kontak_model');
    }

    // menampilkan data 
    function index_get(){
        $id = $this->get('id');
        if ($id == ''){
            $response = $this->kontak_model->list();
            $this->response($response);
        } else {
            $response = $this->kontak_model->detail($id);
            $this->response($response, 200);
        }

    }

    // menambahkan data
    function index_post(){
        $data = [
            'nama'  => $this->post('nama'),
            'nomor' => $this->post('nomor')
        ];
        $response = $this->kontak_model->insert($data);
        $this->response($response);
    }

    // update data
    function index_put(){
        $id = $this->put('id');
        $data = [
            'id'    => $this->put('id'),
            'nama'  => $this->put('nama'),
            'nomor' => $this->put('nomor')
        ];
        $response = $this->kontak_model->update($id, $data);
        $this->response($response);
    }

    // delete data
    function index_delete() {
        $id = $this->delete('id');
        $response = $this->kontak_model->delete($id, $data);
        $this->response($response);
     
    }
}

?>