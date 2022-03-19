<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Portfolio extends CI_Model {
        public function get($id = NULL) {
            
            if($id) {
                return $this->db->where("id", $id)->get("portfolio")->row();
            }
            else {
                return $this->db->get("portfolio")->result();
            }
        
        }
        
        public function add($data) {
            $this->db->insert("portfolio", $data);
        }

        public function update($id, $data) {
            $this->db->where("id", $id)->update("portfolio", $data);
        }

        public function delete($id) {
            $this->db->where("id", $id)->delete("portfolio");
        }
    }