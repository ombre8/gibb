function wechselkurs(){
	document.getElementById('kurs').value =document.getElementById('wechsel').value;
	document.getElementById('euro').value =document.getElementById('betrag').value / document.getElementById('wechsel').value;
}