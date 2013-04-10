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
//! Declare static struct argp_option options[]
/*!
\param delimiter lines delimitators inside filename.
\return The text to inject to the filename between lines delimitators.
*/
class optionsReplacement extends glxCodeGen{
	function replace($delimiter) {
		$returned = "\n";
		for($i=0; $i <count($this->array); $i++){
			$returned = $returned."\t{\"".$this->array[$i]["name"]."\", \t".
					$this->array[$i]["key"].", \t".
					$this->array[$i]["arg"].", \t".
					$this->array[$i]["flags"].", \t\"".
					$this->array[$i]["doc"]."\", \t".
					$this->array[$i]["group"]." },";
			$returned = $returned."\n";
				
		}// end for loop
		$returned = $returned."\n";
		return $returned;
	}// end function display
}

//! Declare struct arguments
/*!
 \param delimiter lines delimitators inside filename.
\return The text to inject to the filename between lines delimitators.
*/
class argumentsReplacement extends glxCodeGen{
	function replace($delimiter) {
		$returned = "\n";
		for($i=0; $i <count($this->array); $i++){
			$returned = $returned."\t".
					$this->array[$i]["var_type"]." ".
					$this->array[$i]["name"].";\n";

		}// end for loop
		$returned = $returned."\n";
		return $returned;
	}// end function display
}

//! Define action on each input (static error_t parse_opt) 
/*!
 \param delimiter lines delimitators inside filename.
\return The text to inject to the filename between lines delimitators.
*/
class parse_optReplacement extends glxCodeGen{
	function replace($delimiter) {
		$returned = "\n";
		for($i=0; $i <count($this->array); $i++){
				
			switch($this->array[$i]["var_action"]){
				case "bool" :
					$action = "1";
					break;
				case "char*" :
					$action = "arg";
					break;
				case "float" :
					$action = "arg ? atof (arg) : 10";
					break;
				case "int" :
					$action = "arg ? atoi (arg) : 10";
					break;
			}
			$returned = $returned."\tcase ".
					$this->array[$i]["key"]." : \n\t\targuments->".
					$this->array[$i]["name"]." = ".$action.";\n".
					"\t\tbreak;\n";
		}// end for loop
		$returned = $returned."\n";
		return $returned;
	}// end function display
}

//! Assign default input value
/*!
\param delimiter lines delimitators inside filename.
\return The text to inject to the filename between lines delimitators.
*/
class default_valueReplacement extends glxCodeGen{
	function replace($delimiter) {
		$returned = "\n";
		for($i=0; $i <count($this->array); $i++){
			$returned = $returned."\targuments.".
					$this->array[$i]["name"]." = ".
					$this->array[$i]["default_value"].";\n";
		}// end for loop
		$returned = $returned."\n";
		return $returned;
	}// end function display
}