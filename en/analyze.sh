#/bin/bash

find . -mindepth 2 -iname "*.php" |xargs wc > analysis.txt
echo '' >> analysis.txt
find . -mindepth 2 -iname "*.php" | xargs cat | tr '\t' ' ' | tr -s ' ' | sed -e 's/<.*>/ /g' | tr -d [:punct:] | tr [:upper:] [:lower:] | tr ' ' '\n' | sed -e '/^[0-9]*$/d' | sort | uniq -c | sort >> analysis.txt

