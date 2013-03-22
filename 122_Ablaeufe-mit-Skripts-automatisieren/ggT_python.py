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
    a, b = int(a) % int(b), a
    yield a
g = ggt(a,b)

counter = 1

for x in g:
  print("Schritt nach Euklid: " + str(counter) + " = " + str(x))
  print(str(a) + " " + str(b))
  counter += 1
  if x == 0 : break
print
