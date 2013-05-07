#!/bin/bash
#
# not quite working yet...
#

error="Usage: BCtoSQL2.sh dbfile csvfile table"

if [ $# != 3 ]; 
  then
  echo $error
  exit 0
  else
  dbfile=$1
  csvfile=$2
  table=$3
  separator=";"
fi

#And now the Magic:

#Header greation
Code=ISO-8859-1
attributeList="$( head -n 1 ${csvfile} | iconv -f ${Code} | tr "${separator}" "\n" )"
#echo "${attributeList}"
sanedAttributeList="$( echo "${attributeList}" | while read attribute
do
   # Sonderzeichen rausschneiden und upper to lowercase
   sanedAttribute="$( echo "${attribute}" | grep -o [a-zA-Z] | tr "[:upper:]" "[:lower:]" | tr -d "\n" ) "
   type="TEXT"
   echo -n "${sanedAttribute} ${type}, "
done )"
# letztes Komma/Leerzeichen entfernen
sanedAttributeList="$( echo "${sanedAttributeList}" | rev | cut -c 3- | rev )"
# Headers to db
#echo ${sanedAttributeList}
sqlite3 $dbfile "CREATE TABLE ${table} (${sanedAttributeList});"

# Content to dba
#sqlite3 $dbfile ".separator \";\" \n .import ${csvfile} ${table}"
#echo ".separator \";\"" | sqlite3
echo -e ".separator \";\"\n.import $csvfile $table" | sqlite3 $dbfile
