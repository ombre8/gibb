<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
   
<html>	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		
         <title>Uebergabe der Informationen</title>
        
	     <script type="text/javascript">
         <!--

	//Beschreibung: Pr�ft ob Benutzername nur aus Buchstaben besteht
	function chkBuchstaben(text) {
	      var nur_das ="/^[a-zA-Z]*$/";
	      for (var i = 0; i < text.length; i++)
		if (nur_das.indexOf(text.charAt(i))<0 ) return false;
  		return true; 
	}
		 

		   //Beschreibung: Ueberpr�fen ob Benutzername leer ist oder Zahlen enth�lt
        function chkBenutzername () {
           document.getElementByID.txtBenutzername.value.replace("@","[at]");
           document.getElementByID.txtBenutzername.value.replace(" ","");
           document.getElementByID.txtBenutzername.value.replace([\x00-\x1F],"");
           chkBuchstaben(document.getElementByID.txtBenutzername.value)
        }
     
	   
  		   function chkPasswort () {
  		   var nur_das ="/^[1-9]*$/";
  		   for (var i = 0; i < document.getElementByID.txtPasswort.lenght; i++)
		      if (nur_das.indexOf(document.getElementByID.txtPasswort.value.charAt(i))<0) return false;
  		     return true;		   
  		   }
  		
  		   function codeWortErstellen() {}  
           

        -->        	
	    </script>

   </head>
   
  <body>
  
        <form name="frmLogin"  action="umfrage.php"   method="post"  ID=Form1>
		<div id="range1">

			<p>Benutzername und Passwort werden nicht &uuml;bertragen, die Befragung findet anonym statt</p>
			<p>Benutzernamen darf nur Buchstaben enthalten</p>
			<p>Benutzername: <input type="text" size="20" name="txtBenutzername" id="txtBenutzername" onblur="chkBenutzername()"></p>
			<p>Passwort darf nur Zahlen enthalten<p>
			<p>Passwort: <input type="password" size="20" name="txtPasswort" id="txtPasswort" onblur="chkPasswort()"></p>


			<input type="BUTTON" name="" value="Code" onclick="codeWortErstellen()" ID="cmdCodeWort"> 
			
			<input type="Submit" name="" value="abschicken" ID="cmdSubmit">
			
		</div>
	    </form>
	    
  </body>
  
</html>	