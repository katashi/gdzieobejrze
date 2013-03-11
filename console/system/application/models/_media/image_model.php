<?php
class Image_Model extends Main_Model {
	
	function Image_Model() {
        parent::Model();
        if (isset($this->ci)) { $this->db = $this->ci->db; }
		//
		$this->config_image['image_library'] = 'gd2';
		$this->config_image['source_image'] = $this->file;
		$this->config_image['maintain_ratio'] = TRUE;
        //
        $this->dimensions = $this->config->item('dimensions');
        $this->load->library('image_lib');
        $this->path = getcwd();
	}

	// load
    function load_total($id_tree) {
        $this->db->where('id_tree', $id_tree);
        $this->db->from($this->_name.'_relations');
        return $this->db->count_all_results();
    }
    function load_all($id_tree) {
        $this->limit_check();
        $this->db->where('id_tree', $id_tree);
        $query = $this->db->get($this->_name.'_relations');
        $result = $query->result();
        $record = array();
        foreach ($result as $item) {
            $values['tree'] = $this->_name;
            $values['relations_id'] = $item->id;
            $values['relations_id_element'] = $item->id_element;
            $query2 = $this->db->query("select * from ".$this->_name." where id=".$item->id_element);
            foreach ($query2->result() as $item2) {
                $values['element_id'] = $item2->id;
                $values['element_title'] = $item2->title;
                $values['element_file_name'] = $item2->file_name;
                $values['element_file_name'] = $item2->file_name;
                $values['element_file_type'] = $item2->file_type;
                $values['element_orig_name'] = $item2->orig_name;
                $values['element_file_ext'] = $item2->file_ext;
                $values['element_file_size'] = $item2->file_size;
                $values['element_is_image'] = $item2->is_image;
                $values['element_dimensions'] = $item2->image_width.'x'.$item2->image_height;
                $values['element_date']	= $item2->date;
                $values['element_dimensions_all'] = $this->dimensions;
            }
            if (file_exists($this->path.'/../media/image/original/'. $values['element_file_name'])) {
                $record[] = $values;
            }
        }
        return $record;
    }

    // crud
	function add($id_tree) {
		// additional data related to curl
		if (isset($_POST['userfile_name'])) { $_FILES['userfile']['name'] = $_POST['userfile_name']; }
		if (isset($_POST['userfile_type'])) { $_FILES['userfile']['type'] = $_POST['userfile_type']; }
		// upload config definition
		$config_upload['upload_path'] = './tmp';
		$config_upload['encrypt_name'] = true;
		// load library
		$this->load->library('upload', $config_upload);
		// upload
		if ($this->upload->do_upload()) {
			$this->upload_data = $this->upload->data();
			if ($this->upload_data['is_image']) {
                // check for proper place of storage
                if (STORAGE_ACTIVE && STORAGE_IMAGE) {
                    if (STORAGE_TYPE == 'S3') {
                        $this->move_to_s3($this->upload_data);
                    }
                } else {
                    // else move to original image location
				    $this->move_to_images_original($this->upload_data);
                }
				//resizing images
				foreach ($this->dimensions as $dimension) { 
					$success = $this->resize($dimension['w'], $dimension['h'], $dimension['watermark'], $this->path.'/../media/image/'.$dimension['w'].'x'.$dimension['h'].'/', $this->upload_data);
				}
                // insert into db
                $this->add_save($id_tree, $this->upload_data);
			} else {
                return '{"success": 0, "error": "Plik nie jest obrazem"}';
			}
			// remove file from tmp
			@unlink('./tmp/'.$this->upload_data['file_name']);
			//
			return '{"success": 1, "upload_data": '. json_encode($this->upload_data) .'}';
		} else {
            $error = $this->upload->get_errors();
            var_dump($error);
			return '{"success": 0, "error": "'.$error.'"}';
		}
	}
	function delete($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('image');
		$result = $query->row();
		if ($result->is_image) {
			@unlink($this->path.'/../media/image/original/'.$result->file_name);
			foreach ($this->dimensions as $dimension) { 
				@unlink($this->path.'/../media/image/'.$dimension['w'].'x'.$dimension['h'].'/'.$result->file_name);
			}
		} else {
			@unlink($this->path.'/../media/file/'.$result->file_name);
		}
		// delete db entries
		$this->db->where('id_element', $id);
		$query = $this->db->delete('image_relations');
		$this->db->where('id', $id);
		$query = $this->db->delete('image');
		return 1;
	}

	// move
	function move_to_images_original(&$upload_data, $path_tmp = './tmp/', $file_name = NULL) {
		if(!file_exists($this->path.'/../media/image/')) { mkdir($this->path.'/../media/image/'); chmod($this->path."/../media/image/", 0777); }
		if(!file_exists($this->path.'/../media/image/original/')) { mkdir($this->path.'/../media/image/original/'); chmod($this->path."/../media/image/original", 0777); }
		if(!empty($file_name)){
			copy($path_tmp.'/'.$file_name, $this->path.'/../media/image/original/'.$upload_data['file_name']);
			$upload_data['file_path'] = 'media/image/original/';
		} else {
			copy($path_tmp.$upload_data['file_name'], $this->path.'/../media/image/original/'.$upload_data['file_name']);
			$upload_data['file_path'] = 'media/image/original/';
		}
		chmod($this->path.'/../media/image/original/'.$upload_data['file_name'], 0777);
	}
    function move_to_s3(&$upload_data, $path_tmp = './tmp/', $file_name = NULL) {
        // include s3 sdk
        require_once './services/s3/sdk.class.php';
        // s3 init
		$s3 = new AmazonS3();
        // upload partial file
        $response = $s3->create_object('media_image', $upload_data['file_name'], array(
            'fileUpload' => $path_tmp.$upload_data['file_name'],
            'acl' => AmazonS3::ACL_PUBLIC
        ));
    }

	// resize
	function resize($w, $h, $watermark, $dir, $upload_data) {
		if(!file_exists($dir)) { mkdir($dir); chmod($dir, 0777);  }
		//
		$config_image = $this->config_image;
		//
		if (MEDIA_DIM == 'both') {
			if ($upload_data['image_width'] < $upload_data['image_height']) {
				$config_image['width'] = $h;
				$config_image['height'] = $w;
			} else {
				$config_image['width'] = $w;
				$config_image['height'] = $h;
			}
			if ($config_image['width'] / $config_image['height'] < $upload_data['image_width'] / $upload_data['image_height']) {
				$config_image['master_dim'] = 'height';
			} else { 
				$config_image['master_dim'] = 'width';
			}
		} 
		if (MEDIA_DIM == 'width') {
			$config_image['width'] = $w;
			$config_image['height'] = $h;
			$config_image['master_dim'] = 'width';
		}
		if (MEDIA_DIM == 'height') {
			$config_image['width'] = $w;
			$config_image['height'] = $h;
			$config_image['master_dim'] = 'height';
		}
		//
		$config_image['source_image'] = $upload_data['full_path'];
		$config_image['new_image'] = $dir.$upload_data['file_name'];
		$config_image['maintain_ratio'] = true;
		//
		$this->image_lib->initialize($config_image);
		$this->image_lib->resize();
		//
		// watermarking
		//
		if ($watermark) {
			$config_watermark['source_image'] = $dir.$upload_data['file_name'];
			$config_watermark['wm_type'] = 'overlay';
			$config_watermark['wm_vrt_alignment'] = 'middle';
			$config_watermark['wm_hor_alignment'] = 'center';
			$config_watermark['wm_overlay_path'] = MEDIA_WATERMARK_PATH;
			//
			$this->image_lib->initialize($config_watermark);
			$this->image_lib->watermark();
		}
		//
		return true;
	}
	function add_save($id_tree, $data) {
		$record['title'] = $data['orig_name'];
		$record['file_name'] = $data['file_name'];
		$record['file_type'] = $data['file_type'];
		$record['file_path'] = $data['file_path'];
		$record['full_path'] = $data['full_path'];
		$record['orig_name'] = $data['orig_name'];
		$record['file_ext'] = $data['file_ext'];
		$record['file_size'] = $data['file_size'];
		$record['is_image'] = $data['is_image'];
		$record['image_width'] = $data['image_width'];
		$record['image_height'] = $data['image_height'];
		$record['image_type'] = $data['image_type'];
		$record['image_size_str'] = $data['image_size_str'];
		$record['date'] = date("Y-m-d H:i:s");
		//
		$this->db->insert($this->_name, $record);
		$id_media = $this->db->insert_id();
		//
		$this->add_save_relation($id_tree, $id_media);
	}
	function add_save_relation($id_tree, $id_element){
		$record = array();
		$this->db->select_max('position');
		$this->db->where('id_tree', $id_tree);
		$query = $this->db->get($this->_name.'_relations');
		$result = $query->row_array();
		$position = $result['position'] + 1;
		//
		$record['id_tree'] = $id_tree;
		$record['id_element'] = $id_element;
		$record['position'] = $position;
		$this->db->insert($this->_name.'_relations', $record);
	}

}
?>