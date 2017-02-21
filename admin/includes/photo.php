<?php

class Photo extends Db_object{

	protected static $db_table = "photos";
	protected static $db_table_field = array('id', 'title', 'caption', 'description', 'filename', 'alternet_text','type', 'size',  );
	public $id;
	public $title;
	public $caption;
	public $description;
	public $filename;
	public $alternet_text;
	public $type;
	public $size;
	public $tmp_path;
	public $upload_directory = "images";
	public $errors = array(); 
	public $upload_errors_array = array(
		UPLOAD_ERR_OK			=> "There is no error",
		UPLOAD_ERR_INI_SIZE		=> "Upload File is to big",
		UPLOAD_ERR_FORM_SIZE	=> "Upload file exceeds max file size",
		UPLOAD_ERR_PARTIAL		=> "Upload file only partically uploaded",
		UPLOAD_ERR_NO_FILE		=> "No file was uploaded",
		UPLOAD_ERR_NO_TMP_DIR	=> "Missing tmp folder",
		UPLOAD_ERR_CANT_WRITE	=> "Failed to write to disk",
		UPLOAD_ERR_EXTENSION	=> "Php extension stopped file upload"
		);
//THis is passing $_FILE['upload_file'] as an argument
	public function set_file($file){

		if(empty($file) || !$file || !is_array($file)){

			$this->errors[] = "There was no file uploaded here";
			return false;
		}elseif($file['error'] != 0){

			$this->errors[] = $this->upload_errors_array[$file['error']];
			return false;
		}else{

			$this->filename = basename($file['name']);
			$this->tmp_path = $file['tmp_name'];
			$this->type     = $file['type'];
			$this->size     = $file['size'];

		}

	}

	public function picture_path(){

		return $this->upload_directory.DS.$this->filename;
	}

	public function save(){
		if($this->id){
			$this->update();
		}else { 


			if(!empty($this->errors)){

			return false;
		}

		if(empty($this->filename) || empty($this->tmp_path)){
			$this->errors[] = "The file was no available";
			return false;
		}

		$traget_path = SITE_ROOT . DS .'admin' . DS . $this->upload_directory . DS . $this->filename;

		if(file_exists($traget_path)){
			$this->errors[] = "The file {$this->filename} already exists";
			return false;
		}

		if(move_uploaded_file($this->tmp_path, $traget_path)){
			if($this->create()){
				unset($this->tmp_path);
				return true;
			}
		}else{
			$this->errors[] = "The folder directory probably does not have permission";
			return false;
		}

	}

}



public function delete_photo(){
	if($this->delete()){
		$traget_path = SITE_ROOT.DS. 'admin' . DS . $this->picture_path();
		return unlink($traget_path) ? true : false;
	}else{
		return false;
	}
}

}

?>