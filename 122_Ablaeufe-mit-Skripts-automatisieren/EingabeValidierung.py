#!/usr/bin/python3.2
# Skript: EingabeValidierung.py
# Erstellt durch Lukas Grimm (ombre@ombre.ch)
# Im Modul 122 an der Gibb

# Regex importieren
import re

# Variablen Definieren
Name = input('"Name Vorname" = ')
Str = input('"Strasse HausNr." = ')
PlzOrt = input('"PLZ Ort" = ')
Email = input('"Email" = ')
Geb = input('Geburtsdatum "DD.MM.YYYY" = ')
PC = input('Postkonto NR. =')


while True:
  if reg.match('^[A-Z]{1}[a-z]*\s{1}[A-Z]{1}[a-z]*$', Name)
    break
  Name = input('Name Vorname = ')

while True:
  if reg.match('^([a-z]|[A-Z])*/s{1}[1-9]{1,}$', Str)
    break
  Str = input('Strasse HausNr. = ')

while True:
  if reg.match('[0-9]{4}\s{1}([A-Z]|[a-z])*$', PlzOrt)
    break
  PlzOrt = input('Plz Ort = ')

while True:
  if reg.match('', Email)
    break
  Email = input('Email = ')

while True:
  if reg.match('', Geb)
    break
  Geb = input('Geburtsdatum "DD.MM.YYYY" = ')

while True:
  if reg.match('', PC)
    break
  PC = input('Postkonto Nr. =')
