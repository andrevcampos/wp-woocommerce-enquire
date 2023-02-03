// JavaScript Document



function closeinquirebox() {

    document.getElementById("loginScreen").style.display = "none";

}

function openinquirebox(name) {

    document.getElementById("loginScreen").style.display = "block";

    document.getElementById("inquireproductid").innerHTML = name;

}



function bminquiresendemail(url, loadingimg) {

    

    console.log(loadingimg);

    var butaosend = document.getElementById("butaosend").innerHTML;

    //butaosend = '<img src="'+loadingimg+'" alt="loading">';

    console.log(butaosend);

    document.getElementById("butaosend").innerHTML = '<div style="margin-top:3px;float:left" ><img src="'+loadingimg+'" alt="loading" width="20px" height="20px" ></div> <div style="float:left;margin-left:5px;" >Please wait</div>';

    

    

    var userproduct = document.getElementById("inquireproductid").innerHTML;

    var username = document.getElementById("emailname").value;

    var userphone = document.getElementById("emailphone").value;

    var useremail = document.getElementById("emailemail").value;

    var usercomment = document.getElementById("emailcomment").value;

    var newurl = url + "?userproduct=" + userproduct + "&username=" + username + "&userphone=" + userphone + "&useremail=" + useremail + "&usercomment=" + usercomment;
    //console.log(newurl);

    var xhttp;

	xhttp=new XMLHttpRequest();

	xhttp.onreadystatechange = function() {

	if (this.readyState == 4 && this.status == 200) {

	//document.getElementById('texterror').innerHTML = "aqui";

	myFunctionbminquiresendemail(this);

	}

	};

	xhttp.open("GET", newurl, true);

	xhttp.send();

}



function myFunctionbminquiresendemail(xml){

    var response = xml.responseText;
    document.getElementById('divformenquirediv').style.display = "none";
    document.getElementById('divformenquiremessagediv').innerHTML = "Inquire sent successfully.";

    console.log(response);

}



function myFunction() {

var x = document.getElementById("status").checked;

if (x == true){

    document.getElementById("announcementplugininformation").style.display = "block";

}else{

    document.getElementById("announcementplugininformation").style.display = "none";

}

console.log(x);

}



function buttonsave(url) {

    
    var status = document.getElementById("status").checked;

    var from = document.getElementById("apifrom").value;

    var replyto = document.getElementById("apireplyto").value;

    var to = document.getElementById("apito").value;

    var color2 = document.getElementById("apicolor").value;
    var color = color2.substring(1);

    var replaymessage = document.getElementById("replymessagetext").value;

    var replaymessagebox = document.getElementById("replymessage").checked;

    var buttonproducts = document.getElementById("buttonproducts").checked;

    var buttonproductssingle = document.getElementById("buttonproductssingle").checked;

    

    var newurl = url + "?status=" + status + "&from=" + from + "&replyto=" + replyto + "&to=" + to + "&color=" + color + "&replymessage=" + replaymessage + "&replymessagebox=" + replaymessagebox + "&buttonproducts=" + buttonproducts + "&buttonproductssingle=" + buttonproductssingle ;
    console.log(newurl);
    
    var xhttp;

	xhttp=new XMLHttpRequest();

	xhttp.onreadystatechange = function() {

	if (this.readyState == 4 && this.status == 200) {

	//document.getElementById('texterror').innerHTML = "aqui";

	window.location.href='?page=my-menu-enquire';

	}

	};

	xhttp.open("GET", newurl, true);

	xhttp.send();


}

