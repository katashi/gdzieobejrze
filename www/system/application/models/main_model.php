<?php
class Main_Model extends Model {
		
	function Main_Model() {
		parent::Model();
		if (isset($this->ci)) { $this->db = $this->ci->db; }
	}

    // load
    function load_field() {
        return $this->db->list_fields($this->_name);
    }
    function load_total() {
        $this->db->from($this->_name);
        return $this->db->count_all_results();
    }
    function load_all($id=null , $where = 'id') {
        if(isset($id) && !empty($id)){
            ($where == null ? $where = 'id':'');
            $this->db->where($where, $id);
        }
        $query = $this->db->get($this->_name);
        $record = $query->result_array();
        return $record;
    }
    function load($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->_name);
        $record = $query->row_array();
        return $record;
    }
    // crud
    function add() {
        $this->db->insert($this->_name, $_POST);
        return 1;
    }
    function edit($id) {
        $this->db->where('id', $id);
        $this->db->update($this->_name, $_POST);
        return 1;
    }
    function delete($id) {
        $this->db->where('id', $id);
        $query = $this->db->delete($this->_name);
        return 1;
    }

    // db query modifier
    function limit_check() {
        if (isset($_REQUEST['start']) && isset($_REQUEST['limit'])) {
            $this->start = $_REQUEST['start'];
            $this->limit = $_REQUEST['limit'];
            $this->db->limit($this->limit, $this->start);
        }
    }

}
?>