<?php
/* glxCodeGen -- a simple PHP Class Code Generator

Copyright 2013 Alessandro Galassini

This file is part of glxCodeGen.

    glxCodeGen is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    glxCodeGen is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with glxCodeGen.  If not, see <http://www.gnu.org/licenses/>.
*/

//! class glxCodeGen.
/*!
It injects in your file between your delimitators what you want.
*/
class glxCodeGen
{
	//! Class Constructor
	/*!
	Reflect user input array in $this->array
	*/
	public function __construct($array) {
		$this->array = $array;
	}

	//! A public method calling scanfile method.
	/*!
	It does nothing of particular.
	\param file the filename to be manipulated.
	\param delimitators defined by user.
	\return nothing
	*/
	public function controller($file,  $delimitators) {
				
		$this->scanfile($file, $delimitators);
		
	} //end function controller
	
	//! A public method scanning source input file to be manipulated.
	/*!
	It scans file finding delimitators for exploding the buffer in an array.
	It replace content between delimitators with user input and overwrite
	the file with the buffer. 
	\param file the filename to be manipulated.
	\param delimiter lines user defined inside filename.
	\return nothing
	*/
	public function scanfile($file,  $delimiter) {
		//init buffer
		$b = NULL;
		//scan all file and put it in b
		$handle = @fopen($file, "r");
		if ($handle) {
			while (($buffer = fgets($handle, 4096)) !== false) {
				$b=$b.$buffer;
			}
			if (!feof($handle)) {
				echo "Error: unexpected fgets() fail\n";
			}
			fclose($handle);
		}
		//Exploding $b buffer in $c array
		$c = explode($delimiter, $b);
		$k=0;
		$new_buffer = NULL;
		for($i=0; $i<count($c); $i++){
			if ( $i == 1 ) {
				//replace delimitators with user replacement
				$new_buffer=$new_buffer.$delimiter.$this->replace($delimiter).$delimiter;
			}else{
				$new_buffer=$new_buffer.$c[$i];
			}
		}
		//write $new_buffer in file replacing old content
		$handle = @fopen($file, "r+");
		if ($handle) {
			if( fwrite($handle, $new_buffer) === FALSE ){
				echo "Cannot write to file $file";
				exit;
			}
			echo "Success, wrote to file $file ! \n";
		}
		fclose($handle);
	}//end function static_txt

	//! The default public method for user input. It has to be redefined by users! 
	/*!
	\param delimiter lines delimitators inside filename.
	\return $returned The text to inject between lines delimitators.
	*/
	function replace($delimiter) {
		
		$returned = "\n";

		for($i=0; $i <count($this->array); $i++){
			
			$returned = $returned. "Default methods: ".$this->array[$i][0]."\n";
			
		}// end for loop

		$returned = $returned."\n";
		return $returned;
	}// end function replace

} //end Class 

/*! \mainpage glxCodeGen utility Index Page
*
* \section intro_sec Introduction
*
* glxCodeGen utility helps you to inject code into your source files.
* It is written in php and it is useful for ripetitive tasks or for
* managment of complex structures. The examples provided here are 
* very simple and they are not so much useful. But think to manage 
* more than 200 user input. 
* With glxCodeGen you need just to define one array.  
*
* \section install_sec Requirements
* 
* You need just a recent version of PHP. I testet it with PHP 5.3.
* Let me know if it works with older PHP versions.
*
*/