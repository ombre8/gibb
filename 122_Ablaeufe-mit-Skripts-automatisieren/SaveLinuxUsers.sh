#!/bin/bash
#Programm zum auslesen der Benutzer

# divider=-----------------------------
# divider=$divider$divider
# header="\n %-15s %-9s %5s %5s %-34s %-12s %-10s \n"
# format=" %-15s %-9s %5s %5s %-34s %-12s %-10s \n"
# index=0
# while read line; do
#   Array[$index]="line"
#   index=$(($index+1))
# done < /etc/passwd  
# 
# width=400

printf "$header" "Benutzer" "Passwort" "UID" "GID" "Kommentar" "Heimatverzeichnis" "Login-Kommando" >> myusers

#printf "%$width.${width}s\n" "$divider" >> myusers

# printf "$format"  $Array

getent passwd  | tr  ':' '\t' >> myusers