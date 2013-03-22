#!/bin/bash
# Skript: M122_Scripts/addPerson.sh
echo "Bitte Namen eingeben (mit quit beenden):"
read name
while true; do
if [ "$name" == "quit" ]; then
  echo "exit"
  break
else
  echo $name >> /home/vmadmin/Dokumente/M122_Scripts/Phonelist
  echo "Bitte Namen eingeben:"
  read name
fi
done