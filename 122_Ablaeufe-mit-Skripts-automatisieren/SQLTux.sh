#!/bin/bash

dbfile=/home/ombre/data/Dropbox/gibb/122/linuxusers.db
tableName=LinuxBenutzer
userFilter="vm root ombre" #Wer will darf hier gerne noch die Tuxe erfassen...

### db erstellen
dberstellen () {

	sqlite3 ${dbfile} "CREATE TABLE ${tableName} (id INTEGER PRIMARY KEY, name TEXT, uid INTEGER, gid INTEGER, home TEXT);"
}

### Kontrollieren ob das db-File bereits vorhanden ist.

dbkontrollieren () {

	if [ -e ${dbfile} ]
	then
		echo -n "${dbfile} existiert bereits. Überschreiben (Y/n)? "
		read -n 1 antwort
		echo
		if [ "$antwort" = "j" ] || [ "$antwort" = "J" ] || [ "$antwort" = "y" ] || [ "$antwort" = "Y" ]
		then
		rm  ${dbfile}

		dberstellen
		
		else
  		echo
		exit 1
		fi
	else
		dberstellen
	fi
}

### Benutzer auslesen

benutzerlesen () {

	for filter in ${userFilter}
	do
		uName="$( getent passwd | grep $filter | cut -d \: -f 1 )"
		uId="$( getent passwd | grep $filter | cut -d \: -f 3 )"
		gId="$( getent passwd | grep $filter | cut -d \: -f 4 )"
		uHome="$( getent passwd | grep $filter | cut -d \: -f 6 )"

		echo "Benutzer $uName gefunden: uid = $uId, gid = $gId, home = $uHome" >&2
		maxIndex="$( sqlite3 ${dbfile} "SELECT MAX(id) FROM ${tableName}" )"
		echo "max ist $maxIndex." >&2
		if [ "${maxIndex}" = "" ]
		then
			nextIndex="1"
		else
			nextIndex="$(( ${maxIndex} + 1 ))"
		fi
		echo "next index ist $nextIndex" >&2

		sqlite3 ${dbfile} "INSERT INTO ${tableName} VALUES (${nextIndex}, '${uName}', ${uId}, ${gId}, '${uHome}');"
	done

}

### db ausgeben

dbausgeben () {

	sqlite3 ${dbfile} "SELECT * FROM ${tableName};"

}

##############################################
#
# Und nun noch das Script
#

dbkontrollieren

benutzerlesen

dbausgeben
