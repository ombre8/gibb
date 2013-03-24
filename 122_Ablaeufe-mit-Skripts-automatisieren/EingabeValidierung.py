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

print("Ihre Daten werden Überprüft:")


#Überprüfen der Eingabe, bei Fehler nachfragen bis korrekt:
while True:
  if re.match('^[A-Z]{1}[a-z]*\s{1}[A-Z]{1}[a-z]*$', Name):
    break
  Name = input('Name Vorname = ')

while True:
  if re.match('^([a-zA-Z])*\s{1}[1-9]{1,}$', Str):
    break
  Str = input('Strasse HausNr. = ')

while True:
  if re.match('[0-9]{4}\s{1}([A-Za-z])*$', PlzOrt):
    break
  PlzOrt = input('Plz Ort = ')

while True:
  if re.match('^[a-zA-Z0-9-_.]+@[a-zA-Z0-9-.]+\.[a-zA-Z]{2,}', Email):
    break
  Email = input('Email = ')

while True:
  if re.match('([0-9]{1,2}(.|/)){2}(19|20)[0-9]{2}$', Geb):
    break
  Geb = input('Geburtsdatum "DD.MM.YYYY" = ')

while True:
  if re.match('^[0-9]{1,2}-[0-9]{2,15}-[0-9]{1,2}$', PC):
    break
  PC = input('Postkonto Nr. =')

print("Alle Daten sind Korrekt, danke und auf Wiedersehen")
