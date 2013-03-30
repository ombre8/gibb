// JavaScript Document
function chkName(text) {
	    var re ="/^[a-zA-Z]*$/";
	    if (re.test(text)) return true;
  		return false; 
	}
	
function chkPassword(text) {
	    var nur_das ="/^[0-9]{6}$/";
	    if (text.match(nur_das)) return true;
  		return false; 
	}
	
function chkMail(text) {
	    var nur_das ="/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
	    if (text.match(nur_das)) return true;
  		return false; 
	}
		
function check(){
		if (chkName(window.document.umfrage.name) == false){
			alert("Der Benutzername darf nur aus den Buchstaben a-z resp. A-Z bestehen");
		}
		else if (chkPassword(window.document.umfrage.passwort) == false){
			alert("Das Passwort darf nur aus Zahlen bestehen und muss genau 6 (Sechs) Zeichen lang sein");
		}
		else if (chkMail(window.document.umfrage.password) == false){
			alert("Bitte eine gültige EMail-Adresse oder keine angeben");
		}
		else{
		window.document.umfrage.action = "auswertung.php";
		}
}