 $(document).ready(function(){

	 $("#login").click(function(){
			loading(); // loading
			setTimeout(function(){ // then show popup, delay in .001 second
			loadPopup(); // function show popup
			}, 1); //  second (500 =0.5s)
	return false;
	});

	$("a.close").click(function() {
		disablePopup();  // function close pop up
	});

	$(this).keyup(function(event) {
		if (event.which == 27) { // 27 is 'Ecs' in the keyboard
			disablePopup();  // function close pop up
		}
	});

     $("div#backgroundPopup").click(function() {
		disablePopup();  // function close pop up
	});
     
	 /************** start: functions. **************/
	function loading() {
		$(".login.loader").show();
	}
	function closeloading() {
		$(".login.loader").fadeOut('normal');
	}

	var popupStatus = 0; // set value

	function loadPopup() {
		if(popupStatus == 0) { // if value is 0, show popup
			closeloading(); // fadeout loading
			$(".login").fadeIn(0500); // fadein popup div
			$("#backgroundPopup").css("opacity", "0"); // css opacity, supports IE7, IE8
			$("#backgroundPopup").fadeIn(0001);
			popupStatus = 1; // and set value to 1
		}
	}

	function disablePopup() {
		if(popupStatus == 1) { // if value is 1, close popup
			$(".login").fadeOut("normal");
			$("#backgroundPopup").fadeOut("normal");
			popupStatus = 0;  // and set value to 0
		}
	}
	
 });