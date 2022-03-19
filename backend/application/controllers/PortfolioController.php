<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class PortfolioController extends CI_Controller {
        
        public function __construct() {
            parent::__construct();

            $this->load->model("Portfolio");
        }

        public function index() {
            if($this->session->userdata("user") == NULL) {
                redirect (base_url(). 'admin');            
                return ;
            }
            
            $portfolios = [];
            $portfolios = $this->Portfolio->get();

            $this->load->view("Portfolio/index", ["portfolios" => $portfolios]);
        }

        public function get_all() {
            header('Access-Control-Allow-Origin: *');
            header("Access-Control-Allow-Methods: GET, OPTIONS");
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($portfolios = $this->Portfolio->get());
        }

        public function store() {
            if($this->session->userdata("user") == NULL) {
                redirect (base_url(). 'admin');            
                return ;
            }

            if($this->input->post("id")) {
                $this->update($this->input->post("id"));
            }
            else {
                $title = $this->input->post("title");
                $description = $this->input->post("description");
            
                $file = $this->upload_file("image");

                if($file['status']){
                    $data = [
                        "image"         => $file['upload_data']['file_name'],
                        "title"         => $title,
                        'description'   => $description,
                    ];

                    $this->Portfolio->add($data);

                    $this->session->set_flashdata("status", "New Portfolio is added");

                    redirect (base_url(). 'admin/portfolio');
                }
                else {
                    $this->session->set_flashdata("error", $file['error']);
                    
                    redirect (base_url(). 'admin/portfolio');
                }
            }
        }

        public function update($id) {
            if($this->session->userdata("user") == NULL) {
                redirect (base_url(). 'admin');            
                return ;
            }

            $data = [
                "title" => $this->input->post("title"),
                "description" => $this->input->post("description")
            ];
            
            $file = $this->upload_file("image");

            if(!$file["status"]) {
                $this->Portfolio->update($id, $data);

                redirect (base_url(). 'admin/portfolio');
            }
            else {
                $record = $this->Portfolio->get($id);

                $this->delete_file($record->image);

                $data["image"] = $file['upload_data']['file_name'];

                $this->Portfolio->update($id, $data);

                redirect (base_url(). 'admin/portfolio');
            }
        }

        public function delete($id) {

            $record = $this->Portfolio->get($id);

            $this->delete_file($record->image);

            $this->Portfolio->delete($id);

            redirect (base_url(). 'admin/portfolio');

        }

        protected function upload_file($photo){
            $config['upload_path']          = 'assets/images/portfolio';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['file_name']            = time(); 
    
            $this->load->library('upload', $config);
    
            if ( $this->upload->do_upload($photo))
            {
                return array(
                    'status' => true,
                    'upload_data' => $this->upload->data()
                );                
            }
            else
            {
                return array(
                    'status' => false,
                    'error' => $this->upload->display_errors()
                );    
            }
        }
    
        protected function delete_file($photo){
            $path = 'assets/images/portfolio';
            $filename =  $path . "/" . $photo;
            
            if (file_exists($filename)) {
                unlink($filename);
                return true;
            } 
            else {
                return false;
            }
        }
    }