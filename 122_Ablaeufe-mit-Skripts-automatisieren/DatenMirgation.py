#!/usr/bin/python3.2
# Skript: DatenMigration.py
# Erstellt durch Lukas Grimm (ombre@ombre.ch)
# Im Modul 122 an der Gibb

#Import

import csv
import re

# Open

with open('Data1.csv', newline='') as f:
  reader = csv.reader(f, delimiter=";")
  rownr = 1
  for row in reader:
    colnr = 1
    for col in row:
      if colnr==1: 
        if re.match('^[0-9]{1,}$', col)
          print('AdrssNr ' + str(rownr) + 'OK!')
        else: print('AdrssNr ' + str(rownr) + 'ERROR!'
      if colnr==2:
        if re.match('^[A-Z]{1}[a-zA-Z]*\s{1}[A-Z]{1}[a-z]*$', col)
          print('Vorname Name ' + str(rownr) + 'OK!')
        else: print('Vorname Name ' + str(rownr) + 'ERROR!'
      if colnr==3:
        if re.match('^([a-zA-Z])*\s{1}[0-9]{1,}[a-z]{1}$', col)
          print('Strasse HNr ' + str(rownr) + 'OK!')
        else: print('Strasse HNr ' + str(rownr) + 'ERROR!'
      if colnr==4:
        if re.match('[0-9]{4}\s{1}([A-Za-z])*$', col)
          print('PLZ Ort ' + str(rownr) + 'OK!')
        else: print('PLZ Ort ' + str(rownr) + 'ERROR!'
      if colnr==5:
# continue here:
        if re.match('', col)
          print('AdrssNr ' + str(rownr) + 'OK!')
        else: print('AdrssNr ' + str(rownr) + 'ERROR!'
      if colnr==1:
        if re.match('^[0-9]{1,}$', col)
          print('AdrssNr ' + str(rownr) + 'OK!')
        else: print('AdrssNr ' + str(rownr) + 'ERROR!'
      if colnr==1:
        if re.match('^[0-9]{1,}$', col)
          print('AdrssNr ' + str(rownr) + 'OK!')
        else: print('AdrssNr ' + str(rownr) + 'ERROR!'
      if colnr==1:
        if re.match('^[0-9]{1,}$', col)
          print('AdrssNr ' + str(rownr) + 'OK!')
        else: print('AdrssNr ' + str(rownr) + 'ERROR!'

