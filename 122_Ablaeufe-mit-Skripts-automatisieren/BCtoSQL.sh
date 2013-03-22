#!/bin/bash
############################################################
#
# Programm zum einlesen einer CSV-Datei in eine Datenbank
# Erstellt im Modul 122 an der GIBB
# Author: Lukas Grimm (& David Vollmer)
# Email: ombre@ombre.ch
#
#############################################################

dbfile=./SIXBC/SIX_Bankenstamm.db
tableName=SIX_Bankenstamm
source=./SIX_BankenstammCH.csv
separator=";"
AttributesInFile=true #gibt die erste Zeile die Attribute an
Code=ISO-8859-1


### Kontrollieren ob das db-File bereits vorhanden ist.

	if [ -e ${dbfile} ]
	then
		echo -n "${dbfile} existiert bereits. Überschreiben (Y/n)? "
		read -n 1 antwort
		echo
		if [ "$antwort" = "j" ] || [ "$antwort" = "J" ] || [ "$antwort" = "y" ] || [ "$antwort" = "Y" ]
		then
		rm  ${dbfile}
		### db erstelle
			if [ "${AttributesInFile}" = "true" ]
				 then
				 attributeList="$( head -n 1 ${source} | iconv -f ${Code} | tr "${separator}" "\n" )"
				 echo "${attributeList}"
				 sanedAttributeList="$( echo "${attributeList}" | while read attribute
		 		 do
			  	# Sonderzeichen rausschneiden und upper to lowercase
			  		sanedAttribute="$( echo "${attribute}" | grep -o [a-zA-Z] | tr "[:upper:]" "[:lower:]" | tr -d "\n" ) "
			  		type="TEXT"
				 	echo -n "${sanedAttribute} ${type}, "
				  done )"
				 # letztes Komma/Leerzeichen entfernen
		  		sanedAttributeList="$( echo "${sanedAttributeList}" | rev | cut -c 3- | rev )"
		  sqlite3 $dbfile "CREATE TABLE ${tableName} (${sanedAttributeList});"
		  if [ "$?" != "0" ]
		  then
			  echo "Tabellenerstellung fehgeschlagen, Programm wird beendet"
			  echo
			  exit 1
		  fi
		else
  		echo
		exit 1
		fi
	else
		if [ "${AttributesInFile}" = "true" ]
		  then
			  attributeList="$( head -n 1 ${source} | iconv -f ${Code} | tr "${separator}" "\n" )"
			  echo "${attributeList}"
			  saneAttributes="$( echo "${attributeList}" | while read attribute
			  do
			  saneAttribute="$(echo "${attribute}" | grep -o [a-zA-Z] | tr "[:upper:]" "[:lower:]" | tr -d "\n" )"
				  
			  # type definieren
			  type="TEXT"
			 echo -n "${saneAttribute} ${type}"
			 done )"
			      
			 # letztes Komma/Leerzeichen entfernen
			saneAttributes="$( echo "${saneAttributes}" | rev | cut -c 3- | rev )"
			sqlite3 ${dbfile} "CREATE TABLE ${tableName} (${saneAttributes});"
		    if [ "$?" != "0" ]
		    then
		    echo "Tabellenerstellung fehlgeschlagen. Programm wird beendet"
		    echo
		    exit 1
		  fi
		 fi
	fi
fi
	if [ "${AttributesInFile}" = "true" ]
	then 
	      firstLine=2
	else
	      firstLine=1
	fi
	
tail -n +${firstLine} ${source} | iconv -f ${Code} | while read line
do
	# echo "Line ist $line" >&2
	lineCount="$( echo "${line}" | tr "${separator}" "\n" | wc -l )"
	tuple="$( echo "${line}" | tr "${separator}" "\n" | while read value
	do
                echo -n "\"$( echo -n "${value}" | sed 's/"/""/g' )\""
		if [ ${lineCount} -gt 1 ]
		then
			echo -n ","
		fi

		let "lineCount -= 1"
		echo -n " "
	done )"


	sqlite3 $dbfile "INSERT INTO ${tableName} VALUES (${tuple});"

	if [ "$?" != "0" ]
        then
                echo "Could not insert: $line"
		echo "Tuple is ${tuple}"
        fi

done
