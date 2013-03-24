#!/usr/bin/python3.2
# Skript: ggT_python.py
# Erstellt durch Lukas Grimm (ombre@ombre.ch)
# Im Modul 122 an der Gibb

print("Dieses Programm berechnet den ggT(a,b)")

a = input("a = ")
b = input("b = ")

# Tauschen falls a kleiner ist
if (a < b):
  x = a
  a = b
  b = x

def ggt(a,b):
  while True:
    yield int(a),int(b)
    a, b = int(a) % int(b), a

g = ggt(a,b)

counter = 1

for x in g:
  print("Schritt nach Euklid: " + str(counter) + " = " + str(x))
  counter += 1
# ValueError: invalid literal for int() with base 10: ''
 # if  int(str(x[2:str(x).find(",")])) <= 0 : break
print
