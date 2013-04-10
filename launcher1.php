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
include("glxCodeGenClass.php");

/*
 * Source path to be manipulated
*/
$srcdir = "./src/";

/*
 * Array init
*/
$array_dictionary=array(
		0 => array("name"=>"vrrms4", "value"=>417.45),
		1 => array("name"=>"fr4", "value"=>312.4904633),
		2 => array("name"=>"angr4", "value"=>360.67)
);

/*
 * Redefine replace
*/
//! A public method taking one argument
/*!
 \param delimiter lines delimitators inside filename.
\return The text to inject to the filename between lines delimitators.
*/
class MyReplacement extends glxCodeGen{
	function replace($delimiter) {
		$returned = "\n";
		for($i=0; $i <count($this->array); $i++){
			$returned = $returned."float ".$this->array[$i]["name"]. " = ".
					$this->array[$i]["value"].";\n";
			$returned = $returned.'printf("'.$this->array[$i]["name"].' = %f\n", '.
					$this->array[$i]["name"].');';
			$returned = $returned."\n";
		}// end for loop
		$returned = $returned."\n";
		return $returned;
	}// end function display
}
//Init Class
$a = new MyReplacement($array_dictionary);
//Here we go
$delimitators = "//glxCodeGen delimitator\n";
$a->controller($srcdir."main.c", $delimitators);
unset ($delimitators);
