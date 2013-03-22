#!/bin/bash
# Skript: M122_Scripts/myNameParameter.sh
Name=$1
if [ "$Name" = "Tux" ];
then echo "Hallo Pinguin"
else echo "Hallo $Name"
fi
exit 0
