#!/bin/bash
# Skript M122_Scripts/myNameCase.sh
case "$1" in
  Tux)
  echo "Hallo Pinguin $1";;
  Veronica)
  echo "Hallo veronica";;
  *)
  echo "Hast du keinen Namen oder was?";;
 esac
 exit 0