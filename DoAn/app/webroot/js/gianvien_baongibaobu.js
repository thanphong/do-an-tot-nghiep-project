var color = new Array("#f9864e", "#e3f8a1", "#dda8f8", "#b6f4df", "#94d4ea");
var oldcolor = 0, newcolor = 0;
$(document)
		.ready(
				function() {
					getLichgiangday();
					gethocky();
					// kiemtrahople("2014-11-24");
					$("#hocky").change(function() {
						// alert($(this).val()+""+$("#ngayxem").val());
						gethocky();
						getLichgiangday();
						getLichdagnkyngi();
					});
					function getLichgiangday() {
						$
								.ajax({
									url : "/DoAn/GiangViens/thoikhoabieu",
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
										var i = 0;
										for ( var iterable_element in jsonStr) {
											i++;
											var tr = document
													.createElement("tr");
											tr.addEventListener("click",
													function() {
														chonlophocphan(this);
													});
											tr.className = "GridRow";
											var stt = document
													.createElement("td");
											stt.appendChild(document
													.createTextNode(i));
											stt.className = "GridCellC";
											stt.align = 'center';
											var inputMTkb = document
													.createElement("input");
											inputMTkb.setAttribute("type",
													"hidden");
											inputMTkb.setAttribute("name",
													"idTkb" + i);
											inputMTkb
													.setAttribute(
															"value",
															jsonStr[iterable_element].Lichgiangday.id);
											stt.appendChild(inputMTkb);
											var tenLophocphan = document
													.createElement("td");
											tenLophocphan
													.appendChild(document
															.createTextNode(jsonStr[iterable_element].Lophocphan.tenLopHocPhan));
											tenLophocphan.className = "GridCellC";
											tenLophocphan.style.textAlign = 'left';

											var tkb = document
													.createElement("td");
											tkb
													.appendChild(document
															.createTextNode("T"
																	+ jsonStr[iterable_element].Lichgiangday.thu
																	+ ","
																	+ jsonStr[iterable_element].Lichgiangday.tutiet
																	+ "-"
																	+ jsonStr[iterable_element].Lichgiangday.dentiet
																	+ ","
																	+ jsonStr[iterable_element].Phong.tenPhong));
											tkb.className = "GridCellC";
											tkb.style.textAlign = 'left';
											var daybeginend = document
													.createElement("input");
											daybeginend.setAttribute("type",
													"hidden");
											daybeginend.setAttribute("name",
													"daybeginend");
											daybeginend
													.setAttribute(
															"value",
															jsonStr[iterable_element].Tuanhoc.ngaybatdau
																	+ ";"
																	+ jsonStr[iterable_element].Tuanhoc1.ngaykethuc);
											tkb.appendChild(daybeginend);
											var chonbaongi = document
													.createElement("td");
											chonbaongi.className = "GridCellC";
											chonbaongi.align = 'center';
											if (jsonStr[iterable_element].Lichnghi.length > 0) {
												chonbaongi.className += " cobaonghi";
											}
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
					function gethocky() {
						$.ajax({
							url : "/DoAn/GiangViens/gethocky",
							type : "POST",
							data : {
								hocky : $("#hocky").val()
							},
							dataType : "JSON",
							success : function(jsonStr) {
								$("#thoigianhoc").val(
										jsonStr.Hocki.batdau + ";"
												+ jsonStr.Hocki.kethuc);
							},
							error : function(e) {
								alert('Error: ' + e);
							}
						});

					}
					function chekthoigian(e) {
						var tds = e.getElementsByTagName('td');
						var thu = tds[2].textContent.split(",")[0][1];
						var thoigian=tds[2].getElementsByTagName('input')[0].value.split(";");
						var ngend = new Date(thoigian[1]);
						var now = new Date();
						if (now.getTime() > ngend.getTime())
							return false;
						
						var d = new Date();
						var now = new Date();
						var n = d.getDay() + 1;
						var delta = thu - n;
						d.setDate(d.getDate() + delta);
						if (d.getTime() < now.getTime()) {
							d.setDate(d.getDate() + 7);
						}
						if(!(d.getTime() >= now.getTime()
								&& d.getTime() < ngend.getTime())) {
							return false;
						}
						return true;
					}
					function chonlophocphan(e) {
						
						if (chekthoigian(e)) {
							var tds = e.getElementsByTagName('td');
							var classname = tds[0].className;
							if (classname.indexOf("checkLhpBaongi") > -1) {
								tds[0].className = tds[0].className.replace(
										" checkLhpBaongi", "");
							} else {

								tds[0].className += " checkLhpBaongi";
							}
						} else {
							alert("Lớp học phần đã hết thời gian học!");
						}
					}
					//
				});