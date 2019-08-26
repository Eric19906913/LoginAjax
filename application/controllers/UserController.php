<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

  public function __construct() {
      Parent::__construct();
      $this->load->model("UserModel","usuario");
  }

	public function login()
	{
		  $usuario = $_POST['usuario'];
      $password = $_POST['password'];

      $query = $this->usuario->ingreso($usuario,$password);
      if($query > 0){
          $response_array['status'] = 'success';
          echo json_encode($response_array);
      }else{
          $response_array['status'] = 'error';
          echo json_encode($response_array);
      }
	}

  public function registro()
  {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $query = $this->usuario->registro($usuario,$password);
    if($query > 0){
      $response_array['status'] = 'exists';
      echo json_encode($response_array);
    }else{
      $response_array['status'] = 'success';
      echo json_encode($response_array);
    }
  }
}
