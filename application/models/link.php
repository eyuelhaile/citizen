<?php

class Link extends My_Model {
    /**
    */
    function fetch_menu() {
        try 
        {
            $this->load->library('session');
            $id = $this->session->userdata('id');
            $role_id = $this->session->userdata('role');
            
            if(!$id){
                header("Location:".base_url().'index.php/login');
                exit();
            }  
            $commandText = "SELECT 
                                   role_link AS id 
                                FROM 
                                    role 
                                WHERE role_id = $role_id";    
            $result = $this->db->query($commandText);
            $query_menu = $result->result(); 
            $modules = $query_menu[0]->id;          
            $commandText = "SELECT 
                                id AS parent_id, 
                                link_name AS link_name, 
                                link,
                                icon
                            FROM links
                            WHERE id IN (
                                $modules)";    
            $result = $this->db->query($commandText);
            $queryModule = $result->result();

            foreach($queryModule as $key => $value) 
            {   
  
                $data['menu'][] = array(
                        'module_name'   => $value->link_name,
                        'link'          => $value->link,
                        'icon'          => $value->icon);
                             
            }        
                 
            return $data; 
        }
        catch (Exception $e) 
        {
            print $e->getMessage();
            die();  
        }
    }
}