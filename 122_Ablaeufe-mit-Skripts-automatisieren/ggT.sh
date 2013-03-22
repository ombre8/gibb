  #!/bin/bash
  #ggT-berechnung mit dem Euklidischen Allgorithmus
  #geschrieben von Lukas Grimm (ombre@ombre.ch)

  if [ $1 -lt $2 ]; then
      p=$2
      q=$1
      echo "Da $1 kleiner als $2 ist tauschen wir die kur für die Berechnung, keinen Grund zur Sorge, das Resultat wird das selbe bleiben..."
    else 
      p=$1
      q=$2
  fi
  echo "Es wird der ggT von $p und $q berechnet:"
  while [ $q -gt 0 ]
  do
    r=$(($p%$q))
    p=$q
    q=$r
  done
  echo "ggT($1,$2) = $p"