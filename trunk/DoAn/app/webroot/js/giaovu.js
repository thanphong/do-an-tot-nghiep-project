$(document).ready(function() {
	var statusGenerator = function(text) {
		var statusElem = $(".status-box");
		var child = $("<span style='display: block'></span>").text(text);
		statusElem.append(child);
	};
	myDatePicker.on("select", function(data) {
		statusGenerator(data.string + " selected")
	});
	myDatePicker.on("change", function(data) {
		statusGenerator("Date picker changed current date: " + data.string);
	});
	myDatePicker.on("show", function() {
		statusGenerator("Date picker show")
	});
	myDatePicker.on("clear", function(data) {
		statusGenerator("Date picker cleared. cleared date: " + data.string)
	});
	myDatePicker.on("hide", function() {
		statusGenerator("Date picker hide")
	});
	

			$(".khoa").change(function()
			{
			var id=$(this).val();
			var dataString = 'id='+ id;

			$.ajax
			({
			type: "POST",
			url:  "/DoAn/Giaovus/listNganh",
			data: dataString,
			cache: false,
			success: function(html)
			{
			$(".nganh").html(html);
			} 
			});

			});


});