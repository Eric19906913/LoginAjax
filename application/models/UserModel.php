<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model{
    //var $table ="usuarios";
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //comprobar si el usuario existe
    public function ingreso($usuario, $password){
      $data = array(
        'nombre' => $usuario,
        'clave' => sha1($password)
      );
      $this->db->select('nombre','clave');
      $this->db->from('usuarios');
      $this->db->where($data);
      $query = $this->db->get()->num_rows();
      return $query;
    }
    //registraun nuevo usuario en la BDD
    public function registro($usuario,$password){
        $data = array(
          'nombre' => $usuario,
          'clave' => sha1($password)
        );
        $this->db->select('nombre','clave');
        $this->db->from('usuarios');
        $this->db->where($data);
        $query = $this->db->get()->num_rows();
        if($query > 0){
          return $query;
        }else{
          $this->db->insert('usuarios',$data);
          return $query;
        }
      }
    }
