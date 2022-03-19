<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class UserController extends CI_Controller {
        public function __construct() {
            parent::__construct();

            $this->load->library("session");
            $this->load->library("form_validation");
            $this->load->model("User");
        }

        public function register() {
            $username = $this->input->post("username");
            $password = $this->input->post("password");

            $hash = password_hash($password, PASSWORD_BCRYPT);

            $this->User->add($username, $hash);

            echo "Success";
        }

        public function login() {
            $username = $this->input->post("username");
            $password = $this->input->post("password");

            $user = $this->User->get($username);

            if(password_verify($password, $user->hash)) {
                $this->session->user = ["id" => $user->id, "username" => $user->username];
                
                redirect(base_url(). 'admin');
            }
            else {
                echo "Invalid Credentials!";
            }
        }

        public function logout(){
            $this->session->sess_destroy();
            redirect(base_url() . 'admin');
        }
    }