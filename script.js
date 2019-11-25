
function f() {
   
	
	var email = document.getElementById("email").value;
	var nume =document.getElementById("nume").value;
	var tel  =document.getElementById("tel").value;
	var cnp  =document.getElementById("CNP").value;
	var tara =document.getElementById("tara").vale;
	
        if (nume == "") {
            alert('Campul "Nume" trebuie completat!');
            document.getElementById("nume").focus();
            return false;
          }
		
		if (!/^[a-zA-Z]+$/.test(nume)) {
            alert("Numele trebuie sa contina doar litere!");
            document.getElementById("nume").focus();
            return false;
          }
		  
		  
		  if (tel == "") {
            alert('Campul "Telefon" trebuie completat!');
            document.getElementById("tel").focus();
            return false;
          }
	
			
        if (isNaN(tel)) {
            alert("Numarul de telefon trebuie sa contina doar cifre!");
            document.getElementById("phone").focus();
            return false;
          }
		  
		 if (tel.length>10 || tel.length<10){
			 alert("Numarul de telefon trebuie sa contina 10 cifre!")
			 document.getElementById("phone").focus();
		 }
		 
		 
		 if (email == "") {
        alert('Campul "E-mail" trebuie completat!');
        document.getElementById("email").focus();
        return false;
          }
		  
		  
		  index=-1;
		  k=parseInt(email.length);
		  for(i=email.length;i>=0;i--)
			  if(email[i]=='@')
			  {index=i;
			  break;}
		  
		  if(index==-1 || index==0 || index==k){
		alert('Campul "E-mail" trebuie completat corespunzator!');
        document.getElementById("email").focus();
        return false;
		  }
		 
		 
		 if (cnp == "") {
            alert('Campul "CNP" trebuie completat!');
            document.getElementById("cnp").focus();
            return false;
          }
		  
		  if (isNaN(cnp)) {
            alert("CNP-ul trebuie sa fie format doar din cifre!");
            document.getElementById("cnp").focus();
            return false;
          }
		 
		  
		 if (cnp.length > 13 || cnp.length<13) {
            alert("CNP-ul trebuie sa contina exact 13 cifre!");
            document.getElementById("CNP").focus();
            return false;
          }
		  
		 if(cnp[0]!=1 && cnp[0]!=2 && cnp[0]!=6 && cnp[0]!=5)
		 {
			alert("Introduceti un CNP valid! (Numar sex gresit!)");
            document.getElementById("CNP").focus();
            return false;
		 }
		 
		 if(cnp.slice(3,5)<=0 || cnp.slice(3,5)>12)
		 {
			alert("Introduceti un CNP valid!(Numar luna nastere gresita!)");
            document.getElementById("CNP").focus();
            return false;
		 }
		 
		 if(cnp.slice(5,7)<=0 || cnp.slice(5,7)>31)
		 {
			alert("Introduceti un CNP valid!(Numar ziua nastere gresita!)");
            document.getElementById("CNP").focus();
            return false;
		 }
		 
		 

		if('selir'==nume.toLowerCase())
			 location.href = 'helloselir.html';
		 else location.href='helloworld.html';
		
	return false;
}



function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if(!(/[0-9]/.test(ch))){
        evt.preventDefault();
    }

}



