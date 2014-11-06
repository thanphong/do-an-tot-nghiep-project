<div class="contentmain chitietkhoa">
	<h2>Chi tiết giảng viên</h2>
	<span><b>Mã giảng viên:</b> <?php echo $data['Giangvien']['maGiangvien'];?></span>
	<span><b>Tên giảng viên:</b> <?php echo $data['Giangvien']['ten'];?></span>
	<span><b>Giới tính:</b>
		 <?php if($data['Giangvien']['gioitinh']==1) echo "Nữ";
		 	echo "Nam";		 		
		?></span>
	<span><b>Học hàm:</b> <?php echo $data['Giangvien']['hocham'];?></span>
	<span><b>Học vị:</b> <?php echo $data['Giangvien']['hocvi'];?></span>
	<span><b>Khoa:</b> <?php ?></span>
	<span><b>Chuyên ngành:</b> <?php echo $data['Giangvien']['chuyennganh'];?></span>
	<span><b>Địa chỉ:</b> <?php echo $data['Giangvien']['diachi'];?></span>
	<span><b>Số điện thoại:</b> <?php echo $data['Giangvien']['sodienthoai'];?></span>
	<span><b>Email:</b> <?php echo $data['Giangvien']['email'];?></span>
	<span><b>Ngày sinh:</b> <?php echo $data['Giangvien']['ngaySinh'];?></span>

		
	<div class="left clear divIcon">
		<a class="icback" href="/DoAn/Giaovus/quanlyGiangVien" title="Quay lại"></a>
		<a class="icedit" href="/DoAn/Giaovus/suaGiangvien/<?php echo $data['Giangvien']['id'];?>" title="Sửa"></a>
		<a class="icdelete" href="/DoAn/Giaovus/xoaGiangvien/<?php echo $data['Giangvien']['id'];?>" title="Xóa"></a>
	</div>
</div>