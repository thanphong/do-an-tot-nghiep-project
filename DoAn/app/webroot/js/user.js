var color = new Array("#f9864e", "#e3f8a1", "#dda8f8", "#b6f4df", "#94d4ea");
var oldcolor=0,newcolor=0;
$(document)
		.ready(
				function() {
					date = new Date();
					$("#ngayxem").val(
							date.getFullYear()
									+ "-"
									+ ((date.getMonth() + 1) > 10 ? (date
											.getMonth() + 1) : ("0" + (date
											.getMonth() + 1)))
									+ "-"
									+ (date.getDate() > 10 ? date.getDate()
											: ("0" + date.getDate())));
					getPhong();
					$("#giangduong").change(function() {
						// alert($(this).val()+""+$("#ngayxem").val());
						getPhong();
					});
					myDatePicker.on("change", function(data) {
						getPhong();
					});
					function getPhong() {
						$
								.ajax({
									url : "/DoAn/Users/danhsachphong",
									type : "POST",
									data : {
										khu : $("#giangduong").val(),
										ngay : $("#ngayxem").val()
									},
									dataType : "JSON",
									success : function(jsonStr) {
										table = document
												.getElementById("danhsachphong");
										for ( var i = table.rows.length - 1; i > 1; i--) {
											table.deleteRow(i);
										}
										for ( var iterable_element in jsonStr) {
											var tr = document
													.createElement("tr");
											tr.className = "GridRow";
											var tenphong = document
													.createElement("td");
											tenphong
													.appendChild(document
															.createTextNode(jsonStr[iterable_element].Phong.tenPhong));
											tenphong.className = "GridCellC";
											tenphong.align = 'center';
											tr.appendChild(tenphong);
											lichday = jsonStr[iterable_element].lichday;

											for ( var i = 1; i <= 12; i++) {
												var td1 = document
														.createElement("td");
												td1.style.width = '100px';
												td1.className = "GridCellC";
												td1.addEventListener("click", function() {
													chonphong(this);
												});
												td1.addEventListener("mouseover", function() {
													thaydoimauchon(this);
												});
												td1.addEventListener("mouseout", function() {
													trolaimau(this);
												});
												for ( var j = 0; j < lichday.length; j++) {
													tutiet = lichday[j].tutiet;
													dentiet = lichday[j].dentiet;
													// console.log();
													if (i == tutiet) {
														while(oldcolor==newcolor){
															newcolor=Math.floor(Math.random()* (color.length - 1)+ 1);
														}
														td1.style.backgroundColor = color[newcolor];
														oldcolor=newcolor;
														td1.style.border = "none";
														td1.colSpan = dentiet
																- tutiet + 1;
														td1.className = "busy";
														i = dentiet;
													}
												}
												tr.appendChild(td1);
											}
											table.appendChild(tr);
										}
									},
									error : function(e) {
										alert('Error: ' + e);
									}
								});

					}
					function chonphong(e) {
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