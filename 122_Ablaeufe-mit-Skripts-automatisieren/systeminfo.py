#!/usr/bin/python
# systeminfo.py
# Skript zum ausgeben von Systeminformationen
# Erstellt durch Lukas Grimm (ombre@ombre.ch)
# Im Modul 122 an der Gibb

# Import
import listcpuinfo
import listmeminfo
import sys

# Get List
cpu = listcpuinfo.getcpuinfo()
mem = listmeminfo.getmeminfo()

# Set Variables
vendor = cpu[1]
model = cpu[4]
mhz = cpu[7]
cache = cpu[8]

totalmemory = mem[0]
freememory = mem[1]
buffers = mem[2]
cached = mem[3]

# Check if there are Arguments -> Standard or just requested Arguments
if len(sys.argv) == 1:
  print('++++++++++++++++++++++')
  print('Basic cpu information:')
  print('++++++++++++++++++++++')
  print(vendor+model+mhz+cache)

  print('+++++++++++++++++++++++++')
  print('Basic memory information:')
  print('+++++++++++++++++++++++++')
  print(totalmemory+freememory+buffers+cached)
  print('supported Args are:')
  print('vendor, model, mhz, cache')
  print('totalmemory, freememory, buffers, cached')

else:
  print('++++++++++++++++++++++')
  print('  System Information')
  print('++++++++++++++++++++++')
  del sys.argv[0]
  for arg in sys.argv:
    # mit eval wird das Argument ausgewertet und das Komma unterdrückt den zusätzlichen Zeilenumbruch
    print eval(arg),
