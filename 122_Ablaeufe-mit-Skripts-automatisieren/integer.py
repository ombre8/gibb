#!/usr/bin/python3.2
# Skript: integer.py

from math import sqrt

# String ausgeben
print("-----------------------")
print("Hello Python")
print("-----------------------")

# Integer: Pythagoras
print("Integer:")
print("Pythagoras a²+b²=c²")
a = 5
b = 6
quadratsumme = a**2 + b**2
c = float (sqrt(quadratsumme))
print ("a=5, b=6, c="+str(c))
print (a,b,c)
#Divisionen
print ("Division mit / und // Operator")
print (100-36 / 10)
print (100-36 // 10)
