<?php

class Customer_model extends CI_model
{

    public $nama_tabel = 'customer';
   

    public function all_customers(){
        $query = $this->db->get("customer");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function customer_by_id($customer_id){
        $query = $this->db->get_where("customer",array('customer_id'=>$customer_id));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function add($data){
        $customer_name = $data['customer_name'];
        $address = $data['address'];
        $company = $data['company'];
        $this->db->query("INSERT INTO customer (customer_name,address,company) VALUES('$customer_name','$address','$company') ");
    }

    public function edit($data){
        $update_data = array(
            'customer_name' => $data['customer_name'],
            'address' => $data['address'],
            'company' => $data['company']
        );

        $this->db->where('customer_id', $data['customer_id']);
        $this->db->update('customer', $update_data);


    }

    public function delete($customer_id){
        $query = $this->db->delete("customer",array('customer_id'=>$customer_id));
        if ($query) {
            return true;
        }
        else {
            return false;
        }
    }
   

}

?>
