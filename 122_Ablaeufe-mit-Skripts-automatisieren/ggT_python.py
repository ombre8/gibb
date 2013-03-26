#!/usr/bin/python3.2
# Skript: ggT_python.py
# Erstellt durch Lukas Grimm (ombre@ombre.ch)
# Im Modul 122 an der Gibb

print("Dieses Programm berechnet den ggT(a,b)")

a = input("a = ")
b = input("b = ")

# Tauschen falls a kleiner ist
if (a > b):
  x = a
  a = b
  b = x

def ggt(a,b):
  while True:
    a, b = b, int(a) % int(b)
    yield int(a),int(b)
    if b == 0 : break

g = ggt(a,b)

counter = 1

for x in g:
  print("Schritt nach Euklid: " + str(counter) + " = " + str(x))
  counter += 1
print
