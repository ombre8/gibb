#!/usr/bin/pythons3.2
# Skript: listcpuinfo.py

def getcpuinfo():
  cpuinfo = open('/proc/cpuinfo', 'r')
  liste = cpuinfo.readlines()
  return liste
