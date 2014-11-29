$(document)
		.ready(
				function() {
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
										for ( var i = 0; i < divsdate.length; i++) {
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
																.createTextNode(tds[2]
																		.getElementsByTagName("input")[0].value));
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
												phong.setAttribute("id",
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
										if (j != 0)
											popup('popupBaoBu');
										else {
											alert("Bạn phải chọn lớp báo nghỉ!");
										}
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
					$("#luudkbu")
							.click(
									function() {
										var number = document
												.getElementsByName("numberLopbaobu")[0];
										var stt = 0;
										var ngaybu;
										var now = new Date();
										var tutiet;
										var dentiet;
										var phong;
										for ( var i = 0; i < number.value; i++) {
//											ngaybu = new Date($("#ngaybu" + i)
//													.getSelectedDate());
//											if (ngaybu.getTime() < now
//													.getTime()) {
//												stt = 1;
//											}
											tutiet = $("#tutiet" + i).val();
											dentiet = $("#dentiet" + i).val();
											phong=$("#phong-"+i).val();
											if (tutiet > dentiet) {
												stt = 1;
											}
											if(phong==""){
												stt=1;
											}

										}
										if (stt = 1) {
											alert("Sai thông tin, kiểm tra lại thông tin!");
										} else {
											var divdialog = document
													.getElementById("dialogbox");
											var divdialogPoup = document
													.getElementById("popupBaoBu");
											divdialogPoup
													.appendChild(divdialog);
											Confirm
													.render(
															'Chọn xác nhận thì sẽ không thể thay đổi, chọn Hủy sẽ hoàn tác tác vụ! Xác nhận/Hủy?',
															'Dkbu', 'post_2');
										}
									});
					//
					$("#btnhuybaobu")
							.click(
									function() {

										var tables = document
												.getElementById("danhsachbaongi");

										var tablebaongi = document
												.getElementById("danhsachlopbaobu");
										for ( var i = tablebaongi.rows.length - 1; i > 1; i--) {
											tablebaongi.deleteRow(i);
										}
										var trs = tables
												.getElementsByTagName("tr");
										var tds;
										var classname;
										var j = 0;
										var inputs1;
										var inputstutiet;

										for ( var i = 0; i < trs.length; i++) {
											tds = trs[i]
													.getElementsByTagName("td");
											classname = tds[0].className;
											if (classname
													.indexOf("checkLhpBaobu") > -1) {
												inputs1 = tds[0]
														.getElementsByTagName("input");
												inputstutiet = tds[4]
														.getElementsByTagName("input")[0].value
														.split("-");

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

												var malhp = document
														.createElement("td");
												malhp
														.appendChild(document
																.createTextNode(inputs1[1].value));
												malhp.className = "GridCellC";
												malhp.align = 'center';

												var ngayday = document
														.createElement("td");
												ngayday
														.appendChild(document
																.createTextNode(tds[2].innerHTML));
												ngayday.className = "GridCellC";
												ngayday.align = 'center';
												var tutiet = document
														.createElement("td");
												tutiet
														.appendChild(document
																.createTextNode(inputstutiet[0]));
												tutiet.className = "GridCellC";
												tutiet.align = 'center';

												var dentiet = document
														.createElement("td");
												dentiet
														.appendChild(document
																.createTextNode(inputstutiet[1]));
												dentiet.className = "GridCellC";
												dentiet.align = 'center';

												var inputIdMabaobu = document
														.createElement("input");
												inputIdMabaobu.setAttribute(
														"type", "hidden");
												inputIdMabaobu.setAttribute(
														"name", "mabaobu" + j);
												inputIdMabaobu.setAttribute(
														"value",
														inputs1[0].value);
												dentiet
														.appendChild(inputIdMabaobu);

												tr.appendChild(stt);
												tr.appendChild(malhp);
												tr.appendChild(ngayday);
												tr.appendChild(tutiet);
												tr.appendChild(dentiet);
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
										popup('popUphuybaobu');
									});
					// end
					//
					$("#huybaobu")
							.click(
									function() {
										var divdialog = document
												.getElementById("dialogbox");
										var divdialogPoup = document
												.getElementById("popUphuybaobu");
										divdialogPoup.appendChild(divdialog);
										Confirm
												.render(
														'Chọn xác nhận thì sẽ không thể thay đổi, chọn Hủy sẽ hoàn tác tác vụ! Xác nhận/Hủy?',
														'huyDkbu', 'post_2');
									});
					//

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
									url : "/DoAn/GiangViens/timphonghoc",
									type : "POST",
									data : {
										tutiet : tutiet,
										ngay : ngay,
										hocky : $("#hocky").val(),
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
														datphong(this, id);
													});
											tr.className = "GridRow";
											var stt = document
													.createElement("td");
											stt.appendChild(document
													.createTextNode(i));
											stt.className = "GridCellC";
											stt.align = 'center';
											var inputMaphong = document
													.createElement("input");
											inputMaphong.setAttribute("type",
													"hidden");
											inputMaphong.setAttribute("name",
													"idphong" + i);
											inputMaphong
													.setAttribute(
															"value",
															jsonStr[iterable_element].phongs.id);

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
											tr.appendChild(stt);
											tr.appendChild(tenphong);
											tr.appendChild(socho);
											tablephong.appendChild(tr);
										}
									}
								});
					}
					//
					function datphong(e, index) {
						var tds = e.getElementsByTagName("td");
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
				});