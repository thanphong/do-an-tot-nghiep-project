     	
					<div class="contain_pro_changepass" id="changepass">
						<div class="tieude tenthongbao transHoa ">Thay đổi mật khẩu </div>
						<form action="/luatvnam/users/changepass/<?php echo $this->Session->read("Userid");?>" method="POST" id="fupdatePass" name="Pass">
		                	<div class="containregis">
			                	<div class="label">Nhập mật khẩu cũ:</div>
								<div class="input"><input type='password' name='oldpass' id='passOld' /></div>
							</div>
		                	<div class="containregis">
			                	<div class="label">Nhập mật khẩu mới:</div>
								<div class="input"><input type='password' name='newpass' id='passNew' /></div>
							</div>
							<div class="containregis">
			                	<div class="label">Xác nhận mật khẩu:</div>
								<div class="input"><input type='password' name='matKhau' id='passConfirm' /></div>
							</div>
							<div class='left clear cachbtn'>
								<input class='button2 sizebutton2' id='' type='submit' value='Lưu' name='btnChange'/>
								<input class='button2' id='' type='reset' value='Nhập lại'/>
							</div></form>
					</div>
				
