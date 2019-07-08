<?php

namespace App\Helpers;

use App\Helpers\FileString;

class FileInfo {

	private $file;
	private $file_info = [
		"mime"=>"",
		"orig_name"=>"",
		"raw_name"=>"",
		"extension"=>"",
		"size"=>0,
	];


	/**
	 * Define Variables
	 * @param [File] $file : Laravel Requested File Object
	 */
	public function __construct($file) {
		$this->file = $file;
	}

	/**
	 * Get File information
	 * @return [Array] File information
	 */
	public function get_fileinfo(){
		$this->file_info['mime'] = $this->file->getMimeType();
		$this->file_info['orig_name'] = $this->file->getClientOriginalName();
		$this->file_info['raw_name'] = FileString::raw_name($this->file->getClientOriginalName());
		$this->file_info['extension'] = $this->file->getClientOriginalExtension();
       		$this->file_info['size'] = $this->file->getClientSize();

       		return $this->file_info;
	}

	

	

}