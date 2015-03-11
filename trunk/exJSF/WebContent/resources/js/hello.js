/**
 * 
 */
$(document).ready(function() {
	alert("ready!");
	$.ajax({
		url : "viewJson.xhtml?a=2&b=3",
		type : "GET",
//		data : {
//			tutiet : tutiet,
//			ngay : ngay,
//			hocky : $("#hocky").val(),
//			dentien : dentien
//		},
//		dataType : "JSON",
		success : function(jsonStr) {
			alert("sfsf");
			var table=document.getElementById("ntable");
			for ( var iterable_element in jsonStr){
				tr=document.createElement("tr");
				td=document.createElement("td");
				td.appendChild(document.createTextNode(jsonStr[iterable_element].name));
				tr.appendChild(td);
				table.appendChild(tr);
				
			}
		}
	});
});