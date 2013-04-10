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
include("FileManipulationClass_argp_extension.php");
/*
 * Source path to be manipulated
 */
$srcdir = "./src_argp/";

// SEE http://www.gnu.org/software/libc/manual/html_node/Argp-Option-Vectors.html#Argp-Option-Vectors
$argp_option_vectors=array(
		array("name"=>"verbose", "key"=>"'v'", "arg"=>"0", "flags"=>"0", "doc"=>"Produce verbose output","group"=>"0", "var_type"=>"int", "var_action"=>"bool", "default_value"=>"0"),
		array("name"=>"silent", "key"=>"'s'", "arg"=>"0", "flags"=>"0", "doc"=>"Don't produce any output","group"=>"0", "var_type"=>"int", "var_action"=>"bool", "default_value"=>"0"),
		array("name"=>"output", "key"=>"'o'", "arg"=>'"FILE"', "flags"=>"0", "doc"=>"Output to FILE instead of standard output","group"=>"0", "var_action"=>"char*", "var_type"=>"char*", "default_value"=>'"-"'),
		array("name"=>"a", "key"=>"2000", "arg"=>'"INPUT_NUMBER"', "flags"=>"0", "doc"=>"Input float number","group"=>"0", "var_type"=>"float", "var_action"=>"float", "default_value"=>"45.87"),
		array("name"=>"b", "key"=>"2001", "arg"=>'"INPUT_NUMBER"', "flags"=>"0", "doc"=>"Input integer number","group"=>"0", "var_type"=>"int", "var_action"=>"int", "default_value"=>"90"),
	);

//Declare static struct argp_option options[]
$a = new optionsReplacement($argp_option_vectors);
//Here we go
$delimitators = "//glxCodeGen delimitator\n";
$a->controller($srcdir."main.c", $delimitators);
unset ($delimitators);

//Declare struct arguments
$b = new argumentsReplacement($argp_option_vectors);
//Here we go
$delimitators = "//glxCodeGen delimitator2\n";
$b->controller($srcdir."main.c", $delimitators);
unset ($delimitators);

//Define action on each input (static error_t parse_opt)
$c = new parse_optReplacement($argp_option_vectors);
//Here we go
$delimitators = "//glxCodeGen delimitator3\n";
$c->controller($srcdir."main.c", $delimitators);
unset ($delimitators);

//Assign default input value
$d = new default_valueReplacement($argp_option_vectors);
//Here we go
$delimitators = "//glxCodeGen delimitator4\n";
$d->controller($srcdir."main.c", $delimitators);
unset ($delimitators);

