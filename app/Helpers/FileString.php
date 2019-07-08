<?php

namespace App\Helpers;

class FileString {
	/**
	 * Remove extension in filename
	 * @param  [String] $filename : File name
	 * @return [String] Filename without extension
	 */
	public static  function raw_name($filename){
		return substr($filename, 0, strrpos($filename, "."));
	}
}