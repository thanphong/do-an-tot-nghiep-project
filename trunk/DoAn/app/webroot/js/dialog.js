function CustomAlert(){
	this.render = function(dialog){
		var winW = window.innerWidth;
	    var winH = window.innerHeight;
		var dialogoverlay = document.getElementById('dialogoverlay');
	    var dialogbox = document.getElementById('dialogbox');
		dialogoverlay.style.display = "block";
	    dialogoverlay.style.height = winH+"px";
		dialogbox.style.left = (winW/2) - (550 * .5)+"px";
	    dialogbox.style.top = "100px";
	    dialogbox.style.display = "block";
		document.getElementById('dialogboxhead').innerHTML = "Acknowledge This Message";
	    document.getElementById('dialogboxbody').innerHTML = dialog;
		document.getElementById('dialogboxfoot').innerHTML = '<button onclick="Alert.ok()">OK</button>';
	}
	this.ok = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
	}
}
var Alert = new CustomAlert();
function dangkynghi(id){
	document.getElementById("formDangkyngi").submit();
}
function dangkybu(id){
	document.getElementById("formDangkybu").submit();
}
function huydangkybu(id){
	document.getElementById("formhuybaobu").submit();
}
function huydankynghi(id){
	document.getElementById("formhuybaonghi").submit();
}
function CustomConfirm(){
	this.render = function(dialog,op,id){
		var winW = window.innerWidth;
	    var winH = window.innerHeight;
		var dialogoverlay = document.getElementById('dialogoverlay');
	    var dialogbox = document.getElementById('dialogbox');
		dialogoverlay.style.display = "block";
	    dialogoverlay.style.height = winH+"px";
		dialogbox.style.left = (winW/2) - (550 * .5)+"px";
	    dialogbox.style.top = "100px";
	    dialogbox.style.display = "block";
		
		document.getElementById('dialogboxhead').innerHTML = "Xác nhận";
	    document.getElementById('dialogboxbody').innerHTML = dialog;
		document.getElementById('dialogboxfoot').innerHTML = '<button class="button2" onclick="Confirm.yes(\''+op+'\',\''+id+'\')">xác nhận</button> <button class="button2" onclick="Confirm.no()">Hủy</button>';
	}
	this.no = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
	}
	this.yes = function(op,id){
		
		if(op == "Dkbu"){
			dangkybu(id);
		}
		if(op == "Dknghi"){
			dangkynghi(id);
		}
		if(op == "huyDkbu"){
			huydangkybu(id);
		}
		if(op == "huyDknghi"){
			huydankynghi(id);
		}
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
	}
}
var Confirm = new CustomConfirm();