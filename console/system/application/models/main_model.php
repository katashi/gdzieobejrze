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
    function load_all() {
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

/*
    //
    // active set
    //
    function active_set($id, $state) {
        $this->db->where('id', $id);
        $this->db->set('active', $state);
        $this->db->update($this->config_db_table_main);
        return '{"success": true}';
    }

    //
    // suspend set
    //
    function suspend_set($id, $state) {
        $this->db->where('id', $id);
        $this->db->set('suspend', $state);
        $this->db->update($this->config_db_table_main);
        return '{"success": true}';
    }

    //
    // conditions apply ( bunch of critierias for db filtration )
    //
    function condition_set($condition) {
        // all elements are reusable to fullfill conditions to db
        $condition = unserialize($condition);
        if ($condition) {
            foreach($condition as $name => $value) {
                if ($name == 'limit') {
                    $this->db->limit($value);
                    $this->limit_flag = true;
                    $this->limit = $value;
                }
                if ($name == 'page') {
                    $this->page = ($value-1) * $this->limit;
                    $this->db->limit($this->limit, $this->page);
                    $this->limit_flag = true;
                }
                if ($name == 'order') {
                    $this->db->order_by($value.' desc');
                    $this->limit_flag = false;
                }
            }
        }
    }

    //
    // filter apply ( bunch of critierias for db filtration )
    //
    function filter_set($type = null, $filter = null) {
        if ($filter == null) {
            $filter = array('filter1' => 0, 'filter2' => 0, 'filter3' => 0, 'filter_source' => 3);
        } else {
            $f1 = isset($filter['filter1']) ? (int)$filter['filter1'] : 0;
            $f2 = isset($filter['filter2']) ? (int)$filter['filter2'] : 0;
            $f3 = isset($filter['filter3']) ? (int)$filter['filter3'] : 0;
            $f_source = isset($filter['filter_source']) ? (int)$filter['filter_source'] : 3;
            if ($f1 != 0) {
                switch($f1) {
                    case 1:
                        $this->db->order_by('date_added desc');
                        break;
                    case 2:
                        $this->db->where('kreomaniak_'.$type.'.id = kreomaniak_comment.id_element');
                        if ($type == 'song') {
                            $this->db->select('kreomaniak_song.id, kreomaniak_song.author, kreomaniak_song.title, kreomaniak_song.genre, kreomaniak_song.image, kreomaniak_song.display, count(kreomaniak_comment.text) as kct');
                            $type2 = 0;
                        }
                        if ($type == 'arrange') {
                            $this->db->select('kreomaniak_arrange.id, kreomaniak_arrange.id_user, kreomaniak_arrange.id_file, kreomaniak_arrange.author, kreomaniak_arrange.title, kreomaniak_arrange.genre, kreomaniak_arrange.image, kreomaniak_arrange.display, count(kreomaniak_comment.text) as kct');
                            $type2 = 1;
                        }
                        if ($type == 'text') {
                            $this->db->select('kreomaniak_text.id, kreomaniak_text.id_user, kreomaniak_text.author, kreomaniak_text.title, kreomaniak_text.text, kreomaniak_text.genre, kreomaniak_text.image, kreomaniak_text.display, count(kreomaniak_comment.text) as kct');
                            $type2 = 2;
                        }
                        $this->db->where('kreomaniak_comment.type', $type2);
                        $this->db->group_by('kreomaniak_'.$type.'.id');
                        $this->db->order_by('kct desc');
                        $this->filter_tables = 'kreomaniak_'.$type.', kreomaniak_comment';
                        break;
                    case 3:
                        break;
                    case 4:
                        break;
                    case 5:
                        $this->db->order_by('display desc');
                        break;

                }
            } else {
                $this->db->order_by('date_added desc');
            }
            if ($f2 != 0) {
                $this->db->where('id_genre', $f2);
            }
            if ($f3 != 0) {
                $now = date("Y-m-d H:i:s");
                switch($f3) {
                    case 1:
                        $from = strtotime(date("Y-m-d H:i:s", strtotime($now)) . "-1 month");
                        break;
                    case 2:
                        $from = strtotime(date("Y-m-d H:i:s", strtotime($now)) . "-7 days");
                        break;
                    case 3:
                        $from = strtotime(date("Y-m-d H:i:s", strtotime($now)) . "-1 day");
                        break;
                    default:
                        break;
                }
                $from = date("Y-m-d H:i:s", $from);
                $this->db->where('kreomaniak_'.$type.'.date_added > "'. $from .'"');
            }
            if ($f_source != 0) {

            }
        }
    }*/

}
?>