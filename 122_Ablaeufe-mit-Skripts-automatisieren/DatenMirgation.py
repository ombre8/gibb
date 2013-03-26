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
  for row in reader :
    colnr = 1
    for col in row:
      if colnr == 1: 
        if re.match('^[0-9]{1,}$', col):
          print('AdrssNr ' + str(rownr) + 'OK!')
        else: print('AdrssNr ' + str(rownr) + 'ERROR!'
      if colnr == 2:
        if re.match('^[A-Z]{1}[a-zA-Z-\'öäüéàèÖÄÜ]*\s{1}[A-Z]{1}[a-zA-Z-\'öäüéàèÖÄÜ]*$', col):
          print('Vorname Name ' + str(rownr) + 'OK!')
        else: print('Vorname Name ' + str(rownr) + 'ERROR!'
      if colnr == 3:
        if re.match('^([a-zA-Z])*\s{1}[0-9]{1,}[a-z]{1}$', col):
          print('Strasse HNr ' + str(rownr) + 'OK!')
        else: print('Strasse HNr ' + str(rownr) + 'ERROR!'
      if colnr == 4:
        if re.match('[0-9]{4}\s{1}([A-Za-z])*$', col):
          print('PLZ Ort ' + str(rownr) + 'OK!')
        else: print('PLZ Ort ' + str(rownr) + 'ERROR!'
      if colnr == 5:
        if re.match('[^a-zA-Z]', col):
          print('Tel.N° ' + str(rownr) + 'OK!')
        else: print('Tel N° ' + str(rownr) + 'ERROR!'
      if colnr == 6:
        if re.match('^[a-zA-Z0-9-_.]+@[a-zA-Z0-9-.]+\.[a-zA-Z]{2,4}', col):
          print('Email ' + str(rownr) + 'OK!')
        else: print('Email ' + str(rownr) + 'ERROR!'
      if colnr == 7:
        if re.match('[0-9]{1-3}([.]{1}[0-9]{1-3}){3}', col):
          print('IP-Adresse ' + str(rownr) + 'OK!')
        else: print('IP-Adresse ' + str(rownr) + 'ERROR!'
      if colnr == 8:
        if re.match('^((((0?[1-9]|[12]\d|3[01])[\.\-\/](0?[13578]|1[02])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|[12]\d|30)[\.\-\/](0?[13456789]|1[012])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|1\d|2[0-8])[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|(29[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00)))|(((0[1-9]|[12]\d|3[01])(0[13578]|1[02])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|[12]\d|30)(0[13456789]|1[012])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|1\d|2[0-8])02((1[6-9]|[2-9]\d)?\d{2}))|(2902((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00))))$', col): #knallharter Regex aus dem Internet (Date with leap years. Accepts '.' '-' and '/' as separators d.m.yy to dd.mm.yyyy (or d.mm.yy, etc) Ex: dd-mm-yyyy d.mm/yy dd/m.yyyy etc etc Accept 00 years also)  sonst ([1-9]|[0[1-9]|[1-2][0-9]|3[01])\.([1-9]|0[1-9]|1[0-2])\.\d{4}
          print('Datum ' + str(rownr) + 'OK!')
        else: print('Datum ' + str(rownr) + 'ERROR!'
      colnr += 1
    rownr += 1
