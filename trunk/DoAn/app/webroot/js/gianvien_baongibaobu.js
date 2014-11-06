var color = new Array("#f9864e", "#e3f8a1", "#dda8f8", "#b6f4df", "#94d4ea");
var oldcolor=0,newcolor=0;
$(document)
		.ready(
				function() {
					getLichgiangday();
					$("#hocky").change(function() {
						// alert($(this).val()+""+$("#ngayxem").val());
						getLichgiangday();
					});
					function getLichgiangday() {
						$
								.ajax({
									url : "/DoAn/Giangviens/thoikhoabieu",
									type : "POST",
									data : {
										hocky : $("#hocky").val()
									},
									dataType : "JSON",
									success : function(jsonStr) {
										table = document
												.getElementById("thoikhoabieu");
										for ( var i = table.rows.length - 1; i > 1; i--) {
											table.deleteRow(i);
										}
										var i=0;
										for ( var iterable_element in jsonStr) {
											i++;
											var tr = document
													.createElement("tr");
											tr.className = "GridRow";
											var stt = document
											.createElement("td");
											stt.appendChild(document.createTextNode(i));
											stt.className = "GridCellC";
											stt.align = 'center';
											
											var tenLophocphan = document
													.createElement("td");
											tenLophocphan
													.appendChild(document
															.createTextNode(jsonStr[iterable_element].Lophocphan.Lophocphan.tenLopHocPhan));
											tenLophocphan.className = "GridCellC";
											tenLophocphan.style.textAlign= 'left';
											//console.log(jsonStr[iterable_element].Lophocphan.Lophocphan.tenLopHocPhan);
											var tkb = document.createElement("td");
											tkb
											.appendChild(document
													.createTextNode("T"+jsonStr[iterable_element].Lichgiangday.thu+","+jsonStr[iterable_element].Lichgiangday.tutiet+"-"+jsonStr[iterable_element].Lichgiangday.dentiet+","+jsonStr[iterable_element].phong.Phong.tenPhong));
											tkb.className = "GridCellC";
											tkb.style.textAlign= 'left';
											var chonbaongi = document.createElement("td");
											chonbaongi.className = "GridCellC";
											chonbaongi.align = 'center';
											
											tr.appendChild(stt);
											tr.appendChild(tenLophocphan);
											tr.appendChild(tkb);
											tr.appendChild(chonbaongi);
											table.appendChild(tr);
										}
									},
									error : function(e) {
										alert('Error: ' + e);
									}
								});

					}
					function chonLichgiangday(e) {
						alert(e.className);
					}
					function thaydoimauchon(e){
						if(e.className!='busy'){
							e.className+=" changecolorinhover";
						}
					}
					function trolaimau(e){
						if(e.className!='busy'){
							 e.className = e.className.replace(" changecolorinhover" , "");
						}
					}
				});