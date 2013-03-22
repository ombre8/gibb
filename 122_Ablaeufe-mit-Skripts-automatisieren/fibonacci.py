#!/usr/bin/python3.2
# Skript: fibonacci.py

print("Unendlicher Fibonacci-Generator")
def fibonacci():
  a, b = 0, 1
  while True:
    yield a
    a, b = b, a + b
f = fibonacci()

counter = 0
for x in f:
  print("fib(" +str(counter) +") = " +str(x))
  counter += 1
  if counter > 25: break
print
