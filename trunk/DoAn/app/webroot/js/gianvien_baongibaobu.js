var color = new Array("#f9864e", "#e3f8a1", "#dda8f8", "#b6f4df", "#94d4ea");
var oldcolor = 0, newcolor = 0;
$(document)
		.ready(
				function() {
					getLichgiangday();
					getLichdagnkyngi();
					$("#hocky").change(function() {
						// alert($(this).val()+""+$("#ngayxem").val());
						getLichgiangday();
						getLichdagnkyngi();
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
															.createTextNode(jsonStr[iterable_element].Lophocphan.Lophocphan.tenLopHocPhan));
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
																	+ jsonStr[iterable_element].phong.Phong.tenPhong));
											tkb.className = "GridCellC";
											tkb.style.textAlign = 'left';
											var chonbaongi = document
													.createElement("td");
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
					// end function
					function getLichdagnkyngi() {
						$
								.ajax({
									url : "/DoAn/Giangviens/lichbaonghi",
									type : "POST",
									data : {
										hocky : $("#hocky").val()
									},
									dataType : "JSON",
									success : function(jsonStr) {
										table = document
												.getElementById("danhsachbaongi");
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
														chonLhpBaoNgi(this);
													});
											tr.className = "GridRow";
											var stt = document
													.createElement("td");
											stt.appendChild(document
													.createTextNode(i));
											stt.className = "GridCellC";
											stt.align = 'center';
											var inputIdMtkb = document
													.createElement("input");
											inputIdMtkb.setAttribute("type",
													"hidden");
											inputIdMtkb.setAttribute("name",
													"malichday" + i);
											inputIdMtkb
													.setAttribute(
															"value",
															jsonStr[iterable_element].lichnghis.id);
											var inputmalhp = document
													.createElement("input");
											inputmalhp.setAttribute("type",
													"hidden");
											inputmalhp.setAttribute("name",
													"malhp" + i);
											inputmalhp
													.setAttribute(
															"value",
															jsonStr[iterable_element].lophocphans.maLopHocPhan);
											stt.appendChild(inputIdMtkb);
											stt.appendChild(inputmalhp);

											var ngaybao = document
													.createElement("td");
											ngaybao.className = "GridCellC";
											ngaybao.style.textAlign = 'left';
											ngaybao
													.appendChild(document
															.createTextNode(jsonStr[iterable_element].lichnghis.ngaybaongi));
											var tenlophp = document
													.createElement("td");
											tenlophp.className = "GridCellC";
											tenlophp.style.textAlign = 'left';
											tenlophp
													.appendChild(document
															.createTextNode(jsonStr[iterable_element].lophocphans.tenLopHocPhan));

											var ngaygni = document
													.createElement("td");
											ngaygni.className = "GridCellC";
											ngaygni.style.textAlign = 'left';
											ngaygni
													.appendChild(document
															.createTextNode(jsonStr[iterable_element].lichnghis.ngaynghi));
											var sotiet = document
													.createElement("td");
											sotiet.className = "GridCellC";
											sotiet.style.textAlign = 'left';
											sotiet
													.appendChild(document
															.createTextNode(jsonStr[iterable_element].lichnghis.soTiet));
											var tietbu = document
													.createElement("td");
											tietbu.className = "GridCellC";
											tietbu.style.textAlign = 'left';
											tr.appendChild(stt);
											tr.appendChild(ngaybao);
											tr.appendChild(tenlophp);
											tr.appendChild(ngaygni);
											tr.appendChild(sotiet);
											tr.appendChild(tietbu);
											table.appendChild(tr);
										}
									}
								});
					}
					// end function
					$("#btnbaonghi")
							.click(
									function() {
										var tables = document
												.getElementById("thoikhoabieu");
										var tablebaongi = document
												.getElementById("danhsachlhp");
										for ( var i = tablebaongi.rows.length - 1; i > 1; i--) {
											tablebaongi.deleteRow(i);
										}
										var divsdate = $(".beatpicker.beatpicker");
										for ( var i = 2; i < divsdate.length; i++) {
											divsdate.slice(i).detach();
										}
										var trs = tables
												.getElementsByTagName("tr");
										var tds;
										var classname;
										var j = 0;
										var idtkb;

										for ( var i = 0; i < trs.length; i++) {
											tds = trs[i]
													.getElementsByTagName("td");
											classname = tds[0].className;
											if (classname
													.indexOf("checkLhpBaongi") > -1) {
												idtkb = tds[0]
														.getElementsByTagName("input")[0].value;

												j++;
												var tr = document
														.createElement("tr");
												tr.className = "GridRow";

												var stt = document
														.createElement("td");
												stt.appendChild(document
														.createTextNode(j));
												stt.className = "GridCellC";
												stt.align = 'center';
												var inputIdMtkb = document
														.createElement("input");
												inputIdMtkb.setAttribute(
														"type", "hidden");
												inputIdMtkb.setAttribute(
														"name", "idTKB" + j);
												inputIdMtkb.setAttribute(
														"value", idtkb);
												stt.appendChild(inputIdMtkb);

												var tenlhp = document
														.createElement("td");
												tenlhp.className = "GridCellC";
												tenlhp.style.textAlign = 'left';
												tenlhp
														.appendChild(document
																.createTextNode(tds[1].innerHTML));

												var TKB = document
														.createElement("td");
												TKB.className = "GridCellC";
												TKB.style.textAlign = 'left';
												TKB
														.appendChild(document
																.createTextNode(tds[2].innerHTML));

												var ngayngi = document
														.createElement("td");
												ngayngi.className = "GridCellC";
												var inputngayngi = document
														.createElement("input");
												inputngayngi.setAttribute(
														"name", "ngayngi" + j);
												inputngayngi.setAttribute("id",
														"ngayngi" + j);
												inputngayngi.setAttribute(
														"type", "text");
												inputngayngi
														.setAttribute(
																"data-beatpicker",
																true);
												inputngayngi.setAttribute(
														"data-beatpicker-id",
														"ngayngi" + j);
												ngayngi
														.appendChild(inputngayngi);

												var sotiet = document
														.createElement("td");
												sotiet.className = "GridCellC";
												var select = document
														.createElement("select");
												select.setAttribute("id",
														"sotiet" + j);
												select.setAttribute("name",
														"sotiet" + j);
												select.style.width = '50px';
												for ( var k = 1; k <= 10; k++) {
													var comp = document
															.createElement("option");
													comp.setAttribute("value",
															k);
													comp.appendChild(document
															.createTextNode(k));
													select.appendChild(comp);
												}
												sotiet.appendChild(select);
												var cabuoi = document
														.createElement("td");
												cabuoi.className = "GridCellC";
												cabuoi.setAttribute("id",
														"cabuoinghi-" + j);
												cabuoi.addEventListener(
														"click", function() {
															choncabuoi(this);
														});

												var dahuy = document
														.createElement("td");
												dahuy.className = "GridCellC";
												tr.appendChild(stt);
												tr.appendChild(tenlhp);
												tr.appendChild(TKB);
												tr.appendChild(ngayngi);
												tr.appendChild(sotiet);
												tr.appendChild(cabuoi);
												tr.appendChild(dahuy);
												tablebaongi.appendChild(tr);
											}

										}
										var numberlohp = document
												.createElement("input");
										numberlohp.setAttribute("type",
												"hidden");
										numberlohp.setAttribute("name",
												"numberLhp");
										numberlohp.setAttribute("value", j);
										tablebaongi.appendChild(numberlohp);
										popup('popUpDiv');
										for ( var t = 1; t <= j; t++) {
											var inputs = document
													.getElementsByName("ngayngi"
															+ t);
											var date = new BeatPicker({
												dateInputNode : $("#"
														+ inputs[0].id),
												selectionRule : {
													single : true,
													range : true
												}
											});
										}
										//						

										var divs = tablebaongi
												.getElementsByTagName("div");
										for ( var i = 0; i < divs.length; i++) {
											divs[i]
													.removeChild(divs[i].childNodes[1]);
										}

									});
					// end
					$("#btnbaobu")
							.click(
									function() {
										var tables = document
												.getElementById("danhsachbaongi");
										var tablebaongi = document
												.getElementById("lhpBaobu");
										for ( var i = tablebaongi.rows.length - 1; i > 1; i--) {
											tablebaongi.deleteRow(i);
										}

										var divsdate = $(".beatpicker.beatpicker");
										for ( var i = 2; i < divsdate.length; i++) {
											divsdate.slice(i).detach();
										}
										var trs = tables
												.getElementsByTagName("tr");
										var tds;
										var classname;
										var j = 0;
										var idtkb;
										var malhp;
										for ( var i = 0; i < trs.length; i++) {
											tds = trs[i]
													.getElementsByTagName("td");
											classname = tds[0].className;
											if (classname
													.indexOf("checkLhpBaongi") > -1) {
												idtkb = tds[0]
														.getElementsByTagName("input")[0].value;
												malhp = tds[0]
														.getElementsByTagName("input")[1].value;
												j++;
												var tr = document
														.createElement("tr");
												tr.className = "GridRow";

												var stt = document
														.createElement("td");
												stt.appendChild(document
														.createTextNode(j));
												stt.className = "GridCellC";
												stt.align = 'center';

												var Malhp = document
														.createElement("td");
												Malhp.className = "GridCellC";
												Malhp.style.textAlign = 'left';
												Malhp.appendChild(document
														.createTextNode(malhp));
												var tenlhp = document
														.createElement("td");
												tenlhp.className = "GridCellC";
												tenlhp.style.textAlign = 'left';
												tenlhp
														.appendChild(document
																.createTextNode(tds[2].innerHTML));
												var inputIdMtkb = document
														.createElement("input");
												inputIdMtkb.setAttribute(
														"type", "hidden");
												inputIdMtkb.setAttribute(
														"name", "mabaobu" + j);
												inputIdMtkb.setAttribute(
														"value", idtkb);
												tenlhp.appendChild(inputIdMtkb);
												var TKB = document
														.createElement("td");
												TKB.className = "GridCellC";
												TKB.style.textAlign = 'left';
												TKB
														.appendChild(document
																.createTextNode(tds[2].innerHTML));

												var ngaybu = document
														.createElement("td");
												ngaybu.className = "GridCellC";
												var inputngaybu = document
														.createElement("input");
												inputngaybu.setAttribute(
														"name", "ngaybu" + j);
												inputngaybu.setAttribute("id",
														"ngaybu" + j);
												inputngaybu.setAttribute(
														"type", "text");
												inputngaybu
														.setAttribute(
																"data-beatpicker",
																true);
												inputngaybu.setAttribute(
														"data-beatpicker-id",
														"ngaybu" + j);
												ngaybu.appendChild(inputngaybu);

												var tutiet = document
														.createElement("td");
												tutiet.className = "GridCellC";
												var select = document
														.createElement("select");
												select.setAttribute("id",
														"tutiet" + j);
												select.setAttribute("name",
														"tutiet" + j);
												select.style.width = '50px';
												for ( var k = 1; k <= 10; k++) {
													var comp = document
															.createElement("option");
													comp.setAttribute("value",
															k);
													comp.appendChild(document
															.createTextNode(k));
													select.appendChild(comp);
												}
												tutiet.appendChild(select);

												var dentiet = document
														.createElement("td");
												dentiet.className = "GridCellC";
												dentiet.setAttribute("id",
														"cabuoinghi-" + j);
												var selectdt = document
														.createElement("select");
												selectdt.setAttribute("id",
														"dentiet" + j);
												selectdt.setAttribute("name",
														"dentiet" + j);
												selectdt.style.width = '50px';
												for ( var k = 1; k <= 10; k++) {
													var comp = document
															.createElement("option");
													comp.setAttribute("value",
															k);
													comp.appendChild(document
															.createTextNode(k));
													selectdt.appendChild(comp);
												}
												dentiet.appendChild(selectdt);
												var phong = document
														.createElement("td");
												phong.setAttribute("name",
														"phong-" + j);
												phong.className = "GridCellC";
												phong.addEventListener("click",
														function() {
															chonphong(this);
														});
												var dahuy = document
														.createElement("td");
												dahuy.className = "GridCellC";
												tr.appendChild(stt);
												tr.appendChild(Malhp);
												tr.appendChild(tenlhp);
												tr.appendChild(ngaybu);
												tr.appendChild(tutiet);
												tr.appendChild(dentiet);
												tr.appendChild(phong);
												tr.appendChild(dahuy);
												tablebaongi.appendChild(tr);
											}

										}
										var numberlohp = document
												.createElement("input");
										numberlohp.setAttribute("type",
												"hidden");
										numberlohp.setAttribute("name",
												"numberLopbaobu");
										numberlohp.setAttribute("value", j);
										tablebaongi.appendChild(numberlohp);
										popup('popupBaoBu');
										for ( var t = 1; t <= j; t++) {
											var inputs = document
													.getElementsByName("ngaybu"
															+ t);
											var date = new BeatPicker({
												dateInputNode : $("#"
														+ inputs[0].id),
												selectionRule : {
													single : true,
													range : true
												}
											});
										}
										var divs = tablebaongi
												.getElementsByTagName("div");
										for ( var i = 0; i < divs.length; i++) {
											divs[i]
													.removeChild(divs[i].childNodes[1]);
										}
									});
					// end
					function chonlophocphan(e) {
						var tds = e.getElementsByTagName('td');
						var classname = tds[0].className;
						if (classname.indexOf("checkLhpBaongi") > -1) {
							tds[0].className = tds[0].className.replace(
									" checkLhpBaongi", "");
						} else {

							tds[0].className += " checkLhpBaongi";
						}
					}
					function chonngayngi() {
						alert("aaa");
					}
					function choncabuoi(e) {
						var classname = e.className;
						var id = e.id;
						var ids = id.split("-")[1];
						if (classname.indexOf("checkLhpBaongi") > -1) {
							e.className = e.className.replace(
									" checkLhpBaongi", "");
							document.getElementById("sotiet" + ids).selectedIndex = 0;
							
						} else {

							document.getElementById("sotiet" + ids).selectedIndex = 4;
						}

					}
					//
					function chonLhpBaoNgi(e) {
						var tds = e.getElementsByTagName('td');
						var classname = tds[0].className;
						if (classname.indexOf("checkLhpBaongi") > -1) {
							tds[0].className = tds[0].className.replace(
									" checkLhpBaongi", "");
						} else {

							tds[0].className += " checkLhpBaongi";
						}
					}
					//
					function chonphong(e) {
						e.innerHTML = "";
						var name = e.getAttribute("name");
						var id = name.split("-")[1];
						var tutiet = $("#tutiet" + id).val();
						var dentien = $("#dentiet" + id).val();
						var ngay = $("#ngaybu" + id).val();
						e.className += " chonphong";
						$
								.ajax({
									url : "/DoAn/Giangviens/timphonghoc",
									type : "POST",
									data : {
										tutiet : tutiet,
										ngay : ngay,
										dentien : dentien
									},
									dataType : "JSON",
									success : function(jsonStr) {

										var divdanhsachphong = document
												.getElementById("danhsachphong");
										var tablephong = divdanhsachphong
										.getElementsByTagName("table")[0];
										for ( var i = tablephong.rows.length - 1; i > 1; i--) {
											tablephong.deleteRow(i);
										}
										divdanhsachphong.style.display = "block";
										
										var i = 0;
										for ( var iterable_element in jsonStr) {
											i++;
											var tr = document
													.createElement("tr");
											tr.addEventListener("click",
													function() {
														datphong(this,id);
													});
											tr.className = "GridRow";
											var stt = document
													.createElement("td");
											stt.appendChild(document
													.createTextNode(i));
											stt.className = "GridCellC";
											stt.align = 'center';
											var inputMaphong = document.createElement("input");
											inputMaphong.setAttribute("type", "hidden");
											inputMaphong.setAttribute("name", "idphong" + i);
											inputMaphong.setAttribute("value",jsonStr[iterable_element].phongs.id );
											
											stt.appendChild(inputMaphong);
											var tenphong = document
													.createElement("td");
											tenphong
													.appendChild(document
															.createTextNode(jsonStr[iterable_element].phongs.maPhong
																	+ ""));
											tenphong.className = "GridCellC";
											tenphong.align = 'left';
											var socho = document
													.createElement("td");
											socho
													.appendChild(document
															.createTextNode(jsonStr[iterable_element].phongs.soLuongGhe
																	+ ""));
											socho.className = "GridCellC";
											socho.align = 'left';
											var maychieu = document
													.createElement("td");
											maychieu
													.appendChild(document
															.createTextNode(jsonStr[iterable_element].phongs.maPhong));
											maychieu.className = "GridCellC";
											maychieu.align = 'left';
											tr.appendChild(stt);
											tr.appendChild(tenphong);
											tr.appendChild(socho);
											tr.appendChild(maychieu);
											tablephong.appendChild(tr);
										}
									}
								});
					}
					//
					function datphong(e,index) {
						var tds=e.getElementsByTagName("td");
						var divdanhsachphong = document
								.getElementById("danhsachphong");
						divdanhsachphong.style.display = "none";
						var inputmaphong = tds[0].getElementsByTagName("input");
						var td = $(".chonphong");
						
						td.html(tds[1].textContent);
						td.removeClass("chonphong");
						var ipidphong = document.createElement("input");
						ipidphong.setAttribute("type", "hidden");
						ipidphong.setAttribute("name", "maphong" + index);
						ipidphong.setAttribute("value", inputmaphong[0].value);
						td.append(ipidphong);
					}
					//
					$("#luudkbu")
							.click(
									function() {
										var divdialog = document
												.getElementById("dialogbox");
										var divdialogPoup = document
												.getElementById("popupBaoBu");
										divdialogPoup.appendChild(divdialog);
										Confirm
												.render(
														'Chọn xác nhận thì sẽ không thể thay đổi, chọn Hủy sẽ hoàn tác tác vụ! Xác nhận/Hủy?',
														'Dkbu', 'post_2');
									});
					$("#luudknghi")
							.click(
									function() {
										var divdialog = document
												.getElementById("dialogbox");
										var divdialogPoup = document
												.getElementById("popUpDiv");
										divdialogPoup.appendChild(divdialog);
										Confirm
												.render(
														'Chọn xác nhận thì sẽ không thể thay đổi, chọn Hủy sẽ hoàn tác tác vụ! Xác nhận/Hủy?',
														'Dknghi', 'post_2');
									});
				});