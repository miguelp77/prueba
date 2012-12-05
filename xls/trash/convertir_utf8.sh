#!/bin/sh
#for fichero in `ls señalISO.bdp`
iconv -f iso-8859-15 -t utf-8 $1 > Intermedio.txt
mv Intermedio.txt $1
