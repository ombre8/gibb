#!/usr/bin/python3.2
# Skript: strings.py

#String ausgeben
ausgabe = "Python lernen!"
print(ausgabe)
print("xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx")

#Strings sind in Python indexiert
print(ausgabe[0] +" "+ ausgabe[7])
print(ausgabe[1] +" "+ ausgabe[8])
print(ausgabe[2] +" "+ ausgabe[9])
print(ausgabe[3] +" "+ ausgabe[10])
print(ausgabe[4] +" "+ ausgabe[11])
print(ausgabe[5] +" "+ ausgabe[12])

# Letztes Zeichen eines Strings bestimmen mit len()
letztes_zeichen = len(ausgabe)-1
print(ausgabe[letztes_zeichen])
print("xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx")

# String mit while durchlaufen

i=0
s=""
while i <= int(letztes_zeichen):
  s = s + ausgabe[i]
  print(s)
  i=i+1
print ("xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx")
