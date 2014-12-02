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
												var inputMalp=document.createElement("input");
												inputMalp.setAttribute("type","hidden");
												inputMalp.setAttribute("name", "malhp"+j);
												inputMalp.setAttribute("value",malhp);
												Malhp.appendChild(inputMalp);
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
										for ( var t = 1; t <= j; t++) {
											var options = {
												index : t,
												dateInputNode : $("#ngaybu" + t)
											}
											var instance = new BeatPicker(
													options);
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
//										var divs = tablebaongi
//												.getElementsByTagName("div");
//										for ( var i = 0; i < divs.length; i++) {
//											divs[i]
//													.removeChild(divs[i].childNodes[1]);
//										}
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
										for ( var i = 1; i <= number.value; i++) {
											ngaybu = new Date($("#ngaybu" + i)
													.val());
											if (ngaybu.getTime() < now
													.getTime()) {
												stt = 1;
												alert("ngày dạy bù không phù hợp!")
												break;
											}
											if (!kiemtrahople(ngaybu)) {
												stt = 1;
												alert("Bạn phải liên hệ với phòng đạo tạo để đăng ký bù vào ngày thứ 7 và chủ nhật!");
												break;
											}
											tutiet = $("#tutiet" + i).val();
											dentiet = $("#dentiet" + i).val();
											
											
											if (tutiet > dentiet) {
												stt = 1;
												alert("Tiết học không phù hợp!");
												break;
											}
											try{
												phong = parseInt($("#maphong" + i).val());
											}
											catch(err) {
												stt = 1;
												alert("Bạn chưa chọn phòng!");
												break;
											}

										}
										
										if (stt == 0) {
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
										var tablesnot = document
												.getElementById("baobuNotdelete");

										var tablebaongi = document
												.getElementById("danhsachlopbaobu");
										for ( var i = tablebaongi.rows.length - 1; i > 1; i--) {
											tablebaongi.deleteRow(i);
										}
										for ( var i = tablesnot.rows.length - 1; i > 1; i--) {
											tablesnot.deleteRow(i);
										}
										var trs = tables
												.getElementsByTagName("tr");
										var tds;
										var classname;
										var j = 0;
										var inputs1;
										var inputstutiet;
										var notindex = 0;
										var ngaybu;
										var now = new Date();
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

												var tr = document
														.createElement("tr");
												tr.className = "GridRow";

												var stt = document
														.createElement("td");

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

												ngaybu = new Date(
														tds[2].textContent);
												if (ngaybu.getTime() > now
														.getTime()) {
													j++;
													stt.appendChild(document
															.createTextNode(j));
													tr.appendChild(stt);
													tr.appendChild(malhp);
													tr.appendChild(ngayday);
													tr.appendChild(tutiet);
													tr.appendChild(dentiet);
													tablebaongi.appendChild(tr);
												} else {
													notindex++;
													stt
															.appendChild(document
																	.createTextNode(notindex));
													tr.appendChild(stt);
													tr.appendChild(malhp);
													tr.appendChild(ngayday);
													tr.appendChild(tutiet);
													tr.appendChild(dentiet);
													tablesnot.appendChild(tr);
												}

											}
										}
										if (notindex != 0) {
											var divdanhsachphong = document
													.getElementById("divbaobuNotdelete");
											divdanhsachphong.style.display = "block";
										}
										if (j != 0 || notindex != 0) {
											var numberlohp = document
													.createElement("input");
											numberlohp.setAttribute("type",
													"hidden");
											numberlohp.setAttribute("name",
													"numberLopbaobu");
											numberlohp.setAttribute("value", j);
											tablebaongi.appendChild(numberlohp);
											popup('popUphuybaobu');
										} else {
											alert("Bạn phải chọn lớp học phần!");
										}
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
						ipidphong.setAttribute("id", "maphong" + index);
						ipidphong.setAttribute("value", inputmaphong[0].value);
						var iputmaphong=document.createElement("input");
						iputmaphong.setAttribute("type", "hidden");
						iputmaphong.setAttribute("name", "tenphong" + index);
						iputmaphong.setAttribute("value", tds[1].textContent);
						td.append(ipidphong);
					}
					//
					function getWeek(date) {
						var onejan = new Date(date.getFullYear(), 0, 1);
						return Math.ceil((((date - onejan) / 86400000)
								+ onejan.getDay() + 1) / 7);
					}
					function kiemtrahople(date) {
						var now = new Date();
						var nowWeek = getWeek(now);
						var dateWeek = getWeek(date);
						var ngaybu = date.getDay() + 1;
						if (ngaybu == 1)
							return false;
						if (nowWeek == dateWeek) {
							if (ngaybu == 7) {
								var nowdate = now.getDay() + 1;
								var howdate = now.getHours() + 1;
								if ((nowdate == 5 && howdate < 15)
										|| nowdate < 5)
									return true;
							}
						}
						return true;
					}
				});