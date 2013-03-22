#!/bin/bash
############################################################
#
# Datenbanksuche für die eingelesene Datei
# mit dem Skript BCtoSQL.sh
# Erstellt im Modul 122 an der GIBB
# Author: Lukas Grimm (& David Vollmer)
# Email: ombre@ombre.ch
#
#############################################################

dbfile=./SIXBC/SIX_Bankenstamm.db
tableName=SIX_Bankenstamm

### Eingaben pruefen
if [ ${#} -lt 1 ]
then
	echo "$0: Bitte mindestens ein Suchargument angeben" >&2
	exit 1
fi

if ! [ -r ${dbfile} ]
then
	echo "$0: Keine Leserechte auf ${dbfile}" >&2
	exit 1

fi

### Attributliste erstellen
attributes="$( echo ".schema ${tableName}" | sqlite3 ${dbfile} | cut -d \( -f 2 | rev | cut -d \) -f 2 | rev | tr "," "\n" | while read line
do
	# attr="$( echo "${line}" | cut -d \  -f 1 )"
	# echo -n "$attr "
	echo -n "$( echo "${line}" | cut -d \  -f 1 ) "
done )"

for argument in $*
do
	result=""
	result="${result}$( for attribute in $attributes
	do
		sqlite3 ${dbfile} "SELECT * FROM ${tableName} WHERE ${attribute} LIKE '%${argument}%';"
	done )"

	if [ "$( echo "${result}" | tr -d " " )" = "" ]
	then
		echo "Argument $argument nicht gefunden."
	else
		count="$( echo "${result}" | wc -l )"
		echo "${count} Resultat(e) für ${argument} gefunden:"
		echo
		echo "${attributes}" | sed 's/ /, /g'
		echo
		echo "${result}" | uniq | sed 's/|/, /g'
	fi
done
