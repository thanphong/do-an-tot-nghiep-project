$(document)
		.ready(
				function() {

					getLichdagnkyngi();
					function getLichdagnkyngi() {
						$
								.ajax({
									url : "/DoAn/GiangViens/lichbaonghi",
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
										var index = 0;
										for ( var iterable_element in jsonStr) {
											i++;
											index++;
											// header lop hoc phan
											var trlophp = document
													.createElement("tr");
											trlophp.className = "GridRowLhp";
											var image = document
													.createElement("IMG");
											image.src = "../img/image/baobu.png";
											var headertenlhp = document
													.createElement("td");
											headertenlhp.colSpan = 3;
											headertenlhp.className = "GridCellC";
											headertenlhp.style.textAlign = 'left';
											headertenlhp.appendChild(image);
											var textb = document
													.createElement("b");
											textb
													.appendChild(document
															.createTextNode("["
																	+ jsonStr[iterable_element].lophocphans.maLopHocPhan
																	+ "]"
																	+ jsonStr[iterable_element].lophocphans.tenLopHocPhan));
											headertenlhp.appendChild(textb);
											var headersotietnghi = document
													.createElement("td");
											headersotietnghi.className = "GridCellC";
											headersotietnghi
													.appendChild(document
															.createTextNode(jsonStr[iterable_element].sotietnghi));
											var headersotietbu = document
													.createElement("td");
											headersotietbu.className = "GridCellC";
											if (jsonStr[iterable_element].sotietbu != 0)
												headersotietbu
														.appendChild(document
																.createTextNode(jsonStr[iterable_element].sotietbu));
											trlophp.appendChild(headertenlhp);
											trlophp
													.appendChild(headersotietnghi);
											trlophp.appendChild(headersotietbu);
											table.appendChild(trlophp);
											//
											// bao nghi
											var lichnghi = jsonStr[iterable_element].lichnghi;
											for ( var iterable in lichnghi) {

												var tr = document
														.createElement("tr");
												tr
														.addEventListener(
																"click",
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
												var inputIdBaongi = document
														.createElement("input");
												inputIdBaongi.setAttribute(
														"type", "hidden");
												inputIdBaongi.setAttribute(
														"name", "malichday"
																+ index);
												inputIdBaongi
														.setAttribute(
																"value",
																lichnghi[iterable].Lichnghi.id);
												var inputmalhp = document
														.createElement("input");
												inputmalhp.setAttribute("type",
														"hidden");
												inputmalhp.setAttribute("name",
														"malhp" + index);
												inputmalhp
														.setAttribute(
																"value",
																jsonStr[iterable_element].lophocphans.maLopHocPhan);
												var inputtenlhp = document
														.createElement("input");
												inputtenlhp.setAttribute(
														"type", "hidden");
												inputtenlhp.setAttribute(
														"name", "tenlhp"
																+ index);
												inputtenlhp
														.setAttribute(
																"value",
																jsonStr[iterable_element].lophocphans.tenLopHocPhan);

												var inputTkb = document
														.createElement("input");
												inputTkb.setAttribute("type",
														"hidden");
												inputTkb
														.setAttribute(
																"value",
																jsonStr[iterable_element].lichgiangdays.thu
																		+ ","
																		+ jsonStr[iterable_element].lichgiangdays.tutiet
																		+ "-"
																		+ jsonStr[iterable_element].lichgiangdays.dentiet);

												stt.appendChild(inputIdBaongi);
												stt.appendChild(inputmalhp);
												stt.appendChild(inputtenlhp);
												stt.appendChild(inputTkb);

												var ngaybao = document
														.createElement("td");
												ngaybao.className = "GridCellC";
												ngaybao.style.textAlign = 'left';
												ngaybao
														.appendChild(document
																.createTextNode(lichnghi[iterable].Lichnghi.ngaybaongi));
												var tenlophp = document
														.createElement("input");
												tenlophp.setAttribute("type",
														"hidden");
												tenlophp.setAttribute("name",
														"tenlhp" + index);
												tenlophp
														.setAttribute(
																"value",
																jsonStr[iterable_element].lophocphans.tenLopHocPhan);
												var ngaygni = document
														.createElement("td");
												ngaygni.className = "GridCellC";
												ngaygni.style.textAlign = 'left';
												ngaygni
														.appendChild(document
																.createTextNode(lichnghi[iterable].Lichnghi.ngaynghi));
												ngaygni.appendChild(tenlophp);
												var sotiet = document
														.createElement("td");
												sotiet.className = "GridCellC";
												sotiet
														.appendChild(document
																.createTextNode(lichnghi[iterable].Lichnghi.soTiet));
												var tietbu = document
														.createElement("td");
												tietbu.className = "GridCellC";
												tietbu.style.textAlign = 'left';
												tr.appendChild(stt);
												tr.appendChild(ngaybao);
												tr.appendChild(ngaygni);
												tr.appendChild(sotiet);
												tr.appendChild(tietbu);
												table.appendChild(tr);

												// baobu
												var lichbaobu = lichnghi[iterable].Lichdaybu;
												for ( var t = 0; t < lichbaobu.length; t++) {
													var trbaobu = document
															.createElement("tr");
													trbaobu
															.addEventListener(
																	"click",
																	function() {
																		chonLhpBaobu(this);
																	});
													trbaobu.className = "GridRow";
													i++;
													var sttbaobu = document
															.createElement("td");
													sttbaobu.className = "GridCellBu";
													sttbaobu
															.appendChild(document
																	.createTextNode(i));

													var inputidbaobu = document
															.createElement("input");
													inputidbaobu.setAttribute(
															"type", "hidden");
													inputidbaobu.setAttribute(
															"value",
															lichbaobu[t].id);
													var tenlhp = document
															.createElement("input");
													tenlhp.setAttribute("type",
															"hidden");
													tenlhp
															.setAttribute(
																	"value",
																	jsonStr[iterable_element].lophocphans.tenLopHocPhan);
													sttbaobu
															.appendChild(inputidbaobu);
													sttbaobu
															.appendChild(tenlhp);
													trbaobu
															.appendChild(sttbaobu);
													var ngaybaobu = document
															.createElement("td");
													ngaybaobu.className = "GridCellBu";
													ngaybaobu.style.textAlign = 'left';
													ngaybaobu
															.appendChild(document
																	.createTextNode(lichbaobu[t].ngaybao));
													trbaobu
															.appendChild(ngaybaobu);

													var ngaydaybu = document
															.createElement("td");
													ngaydaybu.className = "GridCellBu";
													ngaydaybu.style.textAlign = 'left';
													ngaydaybu
															.appendChild(document
																	.createTextNode(lichbaobu[t].ngaydaybu));
													trbaobu
															.appendChild(ngaydaybu);

													var sotietnghi = document
															.createElement("td");
													sotietnghi.className = "GridCellBu";
													trbaobu
															.appendChild(sotietnghi);

													var sotietbu = document
															.createElement("td");
													sotietbu.className = "GridCellBu";
													sotietbu
															.appendChild(document
																	.createTextNode(lichbaobu[t].dentiet
																			- lichbaobu[t].tutiet
																			+ 1));
													var tutiet = document
															.createElement("input");
													tutiet.setAttribute("type",
															"hidden");
													tutiet
															.setAttribute(
																	"value",
																	lichbaobu[t].tutiet
																			+ "-"
																			+ lichbaobu[t].dentiet);
													sotietbu
															.appendChild(tutiet);
													trbaobu
															.appendChild(sotietbu);
													table.appendChild(trbaobu);
												}
												i++;
											}
											i = 0;
											//
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
										var trs = tables
												.getElementsByTagName("tr");
										var tds;
										var classname;
										var j = 0;
										var idtkb;
										var thunghi;
										for ( var i = 0; i < trs.length; i++) {
											tds = trs[i]
													.getElementsByTagName("td");
											classname = tds[0].className;
											if (classname
													.indexOf("checkLhpBaongi") > -1) {
												idtkb = tds[0]
														.getElementsByTagName("input")[0].value;
												thunghi = tds[2].textContent
														.split(",")[0][1];
												j++;
												var comb = getDateByNumOfWeek(
														thunghi, j,tds[2]);

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
																.createTextNode(tds[2].textContent));

												var ngayngi = document
														.createElement("td");
												ngayngi.className = "GridCellC";
												ngayngi.appendChild(comb);

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
										if (j != 0)
											popup('popUpDiv');
										else
											alert("Phải chọn lớp học phần!");
									});
					// end
					$("#btnhuybaonghi")
							.click(
									function() {
										var tablesnot = document
												.getElementById("baonghiNotdelete");
										var tables = document
												.getElementById("danhsachbaongi");
										var tablebaongi = document
												.getElementById("danhsachhuybaonghi");
										for ( var i = tablebaongi.rows.length - 1; i > 1; i--) {
											tablebaongi.deleteRow(i);
										}
										for ( var i = tablesnot.rows.length - 1; i > 1; i--) {
											tablesnot.deleteRow(i);
										}
										var trs = tables
												.getElementsByTagName("tr");
										var tds;
										var idtkb;
										var j = 0;
										var indexnotdelete = 0;
										var ngaynbaoghi;
										var now = new Date();
										for ( var i = 0; i < trs.length; i++) {

											tds = trs[i]
													.getElementsByTagName("td");
											classname = tds[0].className;
											if (classname
													.indexOf("checkLhpBaongi") > -1) {

												idtkb = tds[0]
														.getElementsByTagName("input")[0].value;
												var tr = document
														.createElement("tr");
												tr.className = "GridRow";

												var stt = document
														.createElement("td");
												stt.className = "GridCellC";
												stt.align = 'center';
												var inputIdMabaonghi = document
														.createElement("input");
												inputIdMabaonghi.setAttribute(
														"type", "hidden");
												inputIdMabaonghi
														.setAttribute("name",
																"mabaonghi" + j);
												inputIdMabaonghi.setAttribute(
														"value", idtkb);
												stt
														.appendChild(inputIdMabaonghi);
												var tenlhp = document
														.createElement("td");
												tenlhp
														.appendChild(document
																.createTextNode(tds[0]
																		.getElementsByTagName("input")[2].value));
												tenlhp.className = "GridCellC";
												tenlhp.align = 'center';
												var TKB = document
														.createElement("td");
												TKB
														.appendChild(document
																.createTextNode(tds[0]
																		.getElementsByTagName("input")[3].value));
												TKB.className = "GridCellC";
												TKB.align = 'center';

												var ngaynghi = document
														.createElement("td");
												ngaynghi
														.appendChild(document
																.createTextNode(tds[2].textContent));
												ngaynghi.className = "GridCellC";
												ngaynghi.align = 'center';

												var sotiet = document
														.createElement("td");
												sotiet
														.appendChild(document
																.createTextNode(tds[3].textContent));
												sotiet.className = "GridCellC";
												sotiet.align = 'center';

												ngaynbaoghi = new Date(
														tds[2].textContent);
												if (ngaynbaoghi.getTime() > now
														.getTime()) {
													j++;
													
													stt.appendChild(document
															.createTextNode(j));
													tr.appendChild(stt);
													tr.appendChild(tenlhp);
													tr.appendChild(TKB);
													tr.appendChild(ngaynghi);
													tr.appendChild(sotiet);
													tablebaongi.appendChild(tr);

												} else {
													indexnotdelete++;
													
													stt
															.appendChild(document
																	.createTextNode(indexnotdelete));
													tr.appendChild(stt);
													tr.appendChild(tenlhp);
													tr.appendChild(TKB);
													tr.appendChild(ngaynghi);
													tr.appendChild(sotiet);
													tablesnot.appendChild(tr);

												}
											}
										}
										
										if (indexnotdelete != 0) {
											var divdanhsachphong = document
													.getElementById("divnothuynghi");
											divdanhsachphong.style.display = "block";
										}
										if (j != 0 || indexnotdelete != 0) {
											var numberlohp = document
													.createElement("input");
											numberlohp.setAttribute("type",
													"hidden");
											numberlohp.setAttribute("name",
													"numberLopbaobu");
											numberlohp.setAttribute("value", j);
											tablebaongi.appendChild(numberlohp);
											popup('popUphuybaonghi');

										} else {
											alert("Bạn chưa chọn lớp hủy báo nghỉ!");
										}
									});
					//
					$("#luudknghi")
							.click(
									function() {
										var lydo = document
												.getElementsByName("lydo")[0];
										if (lydo.value == "") {
											alert("Bạn phải nhập lý do!");
										} else {
											var divdialog = document
													.getElementById("dialogbox");
											var divdialogPoup = document
													.getElementById("popUpDiv");
											divdialogPoup
													.appendChild(divdialog);
											Confirm
													.render(
															'Chọn xác nhận thì sẽ không thể thay đổi, chọn Hủy sẽ hoàn tác tác vụ! Xác nhận/Hủy?',
															'Dknghi', 'post_2');
										}
									});
					// /
					$("#huybaonghi")
							.click(
									function() {
										var divdialog = document
												.getElementById("dialogbox");
										var divdialogPoup = document
												.getElementById("popUphuybaonghi");
										divdialogPoup.appendChild(divdialog);
										Confirm
												.render(
														'Chọn xác nhận thì sẽ không thể thay đổi, chọn Hủy sẽ hoàn tác tác vụ! Xác nhận/Hủy?',
														'huyDknghi', 'post_2');
									});
					//
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
					//
					function chonLhpBaobu(e) {
						if (chekthoigian()) {
							var tds = e.getElementsByTagName('td');
							var classname = tds[0].className;
							if (classname.indexOf("checkLhpBaobu") > -1) {
								tds[0].className = tds[0].className.replace(
										" checkLhpBaobu", "");
							} else {

								tds[0].className += " checkLhpBaobu";
							}
						} else {
							alert("Không phải là thời gian báo bù!");
						}
					}
					//
					function chonLhpBaoNgi(e) {
						if (chekthoigian()) {
							var tds = e.getElementsByTagName('td');
							var classname = tds[0].className;
							if (classname.indexOf("checkLhpBaongi") > -1) {
								tds[0].className = tds[0].className.replace(
										" checkLhpBaongi", "");
							} else {

								tds[0].className += " checkLhpBaongi";
							}
						} else {
							alert("không phải là thời gian để báo nghỉ!");
						}
					}
					function chekthoigian() {
						var thoigian = $("#thoigianhoc").val().split(";");
						var ngend = new Date(thoigian[0].split(" ")[1]);
						var now = new Date();
						if (now.getTime() > ngend.getTime())
							return false;
						return true;
					}

					function getDateByNumOfWeek(thu, index,e) {
						var select = document.createElement("select");
						select.setAttribute("name", "ngayngi" + index);
						var thoigian = e.getElementsByTagName('input')[0].value.split(";");
						//var thoigian = $("#thoigianhoc").val().split(";");
						var ngend = new Date(thoigian[1].split(" ")[0]);

						var d = new Date();
						var now = new Date();
						var n = d.getDay() + 1;
						var delta = thu - n;

						d.setDate(d.getDate() + delta);
						if (d.getTime() < now.getTime()) {
							d.setDate(d.getDate() + 7);
						}

						while (d.getTime() >= now.getTime()
								&& d.getTime() < ngend.getTime()) {
							var option = document.createElement("option");
							option.setAttribute("value", d.getFullYear() + "-"
									+ (d.getMonth() + 1) + "-" + d.getDate());
							option.appendChild(document.createTextNode("Thứ "
									+ (d.getDay() + 1) + ":" + d.getDate()
									+ "-" + (d.getMonth() + 1) + "-"
									+ d.getFullYear()));
							select.appendChild(option);

							d.setDate(d.getDate() + 7);
						}
						return select;
					}
				});