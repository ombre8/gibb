#!/usr/bin/python3.2
# Skript: fib_rek.py
# Erstellt durch Lukas Grimm (ombre@ombre.ch)
# Im Modul 122 an der Gibb

end = input("Anzahl Elemente = ")
a,b,counter = 0,1,1

def fib(n):
    if n == 0:
        return 0
    elif n == 1:
        return 1
    else:
        return fib(n-1) + fib(n-2)

for i in range (1,int(end)+1):
    print("fib(" + str(i) +") = " + str(fib(i)))
