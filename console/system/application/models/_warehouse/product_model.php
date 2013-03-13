<?php
class Product_Model extends Main_Model {
		
	function Product_Model() {
        parent::Model();
        if (isset($this->ci)) { $this->db = $this->ci->db; }
    }
	// load
    function load_total($id_tree) {
        $this->db->where('id_tree', $id_tree);
        $this->db->from('product_relations');
        return $this->db->count_all_results();
    }
    function load_all($id_tree) {
        $this->limit_check();
        $this->db->where('id_tree', $id_tree);
        $query = $this->db->get('product_relations');
        $result = $query->result();
        $record = array();
        foreach ($result as $item) {
            $values['tree'] = 'product';
            $values['relations_id'] = $item->id;
            $values['relations_id_element'] = $item->id_element;
            $query2 = $this->db->query("select * from product where id=".$item->id_element);
            foreach ($query2->result() as $item2) {
                $values['id'] = $item2->id;
                $values['title'] = $item2->title;
                $values['header'] = $item2->header;
                $values['date_created'] = $item2->date_created;
                $values['active'] = $item2->active;
            }
            $record[] = $values;
        }
        return $record;
    }

    // crud
    function add($id_tree) {
        $record = $_POST;
        $record['date_created'] = date("Y-m-d H:i:s");
        $record['date_last_modified'] = date("Y-m-d H:i:s");
        $this->db->insert('product', $record);
        $id_element = $this->db->insert_id();
        //
        $record = array();
        $this->db->select_max('position');
        $this->db->where('id_tree', $id_tree);
        $query = $this->db->get('product_relations');
        $result = $query->row_array();
        $position = $result['position'] + 1;
        $record['id_tree'] = $id_tree;
        $record['id_element'] = $id_element;
        $record['position'] = $position;
        $this->db->insert('product_relations', $record);
        return 1;
    }
    function edit($id) {
        $record = $_POST;
        $record['date_last_modified'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->update('product', $record);
        return 1;
    }
    function delete($id) {
        $this->db->where('id_element', $id);
        $query = $this->db->delete('product_relations');
        $this->db->where('id', $id);
        $query = $this->db->delete('product');
        return 1;
    }

}
?>