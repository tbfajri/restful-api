<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak_model extends CI_Model{

    function __construct(){
        $this->load->database();
    }

    // response jika field ada yang kosong
    public function empty_response(){
        $response['status']=502;
        $response['error']=true;
        $response['message']='Field tidak boleh kosong';
        return $response;
    }

    // menampilkan listing kontak 
    public function list(){
        $query = $this->db->get('telepon')->result();
        $response['status']=200;
        $response['error']=false;
        $response['person']= $query;

        return $response;
    }

    // menampilkan detail kontak
    public function detail($id){
        $this->db->where('id', $id);
        $query = $this->db->get('telepon')->row();

        $response['status']=200;
        $response['error']=false;
        $response['person']= $query;

        return $response;
    }

    // menambahkan kontak baru
    public function insert($data) {
     
        if (empty($data['nama']) || empty($data['nomor'])){
            return $this->empty_response();
        }
        $query = $this->db->insert('telepon', $data);
        if($query){
            $response['status']     = 200;
            $response['error']      =  false;
            $response['message']    = 'Data berhasil di tambahkan';
            return $response;
        } else {
            $response['status']     = 502;
            $response['error']      = true;
            $response['message']    = 'Data gagal di tambahkan';
            return $response;
        }
    }

    // mengedit kontak 
    public function update($id, $data){
        if($id == ''|| empty($data['nama']) || empty($data['nomor'])){
            return $this->empty_response();
        } else {
            $this->db->where('id', $id);
            $update = $this->db->update('telepon', $data);
            if($update){
                $response['status'] = 200;
                $response['error']  = false;
                $response['message']    = 'Data Berhasil di update';
                return $response;
            } else {
                $response['status'] = 502;
                $response['error']  = true;
                $response['message']    = 'Data Gagal di update';
                return $response;
            }
        }
    }

    // menghapus kontak 
    public function delete($id){
        if($id == ''){
            return $this->empty_response();
          }else{
            $where = ["id"=>$id];
            $this->db->where('id', $id);
            $delete = $this->db->delete('telepon');
            if($delete){
                $response['status'] = 200;
                $response['error'] = false;
                $response['message'] = 'Data berhasil di hapus';
                return $response;
            } else {
                $response['status'] = 502;
                $response['error'] = true;
                $response['message'] = 'Data gagal di hapus';
                return $response;
            }
          }
    }
}
?>