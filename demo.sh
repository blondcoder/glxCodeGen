#!/bin/sh
echo "Calling launcher1.php..."
php launcher1.php
cd src
echo "Compiling src/main.c"
gcc -o glxCodeGen.out main.c
./glxCodeGen.out
cd ..

echo "Calling launcher2.php..." 
php launcher2.php
cd src2
echo "Compiling src2/main.c"
gcc -o glxCodeGen.out main.c
echo "Execution of compiled program:"
./glxCodeGen.out
cd ..

echo "Calling launcher_argp.php..." 
php launcher_argp.php
cd src_argp
echo "Compiling src_argp/main.c"
gcc -o glxCodeGen.out main.c
echo "Execution of compiled program:"
./glxCodeGen.out -s glx_ARG1 glx_ARG2
cd ..

