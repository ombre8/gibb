#!/usr/bin/pythons3.2
# Skript: listmeminfo.py

def getmeminfo():
  meminfo = open('/proc/meminfo', 'r')
  liste = meminfo.readlines()
  return liste
