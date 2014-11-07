<div class="contentmain chitietkhoa">
	<h2>Chi tiết phòng học</h2>
	<span><b>Mã phòng học:</b> <?php echo $data['Phong']['maPhong'];?></span>
	<span><b>Tên phòng học:</b> <?php echo $data['Phong']['tenPhong'];?></span>
	<span><b>Số lượng ghế:</b> <?php echo $data['Phong']['soLuongGhe'];?></span>
	<span><b>Trạng thái:</b> <?php echo $data['Phong']['trangThai'];?></span>
	<span><b>Khu vực:</b> <?php echo $data['Phong']['khuVuc'];?></span>
	<span><b>Ngày cập nhật:</b> <?php echo $this->giaovu->convertViewdate($data['Phong']['ngayCapNhap']);?></span>
		
	<div class="left clear divIcon">
		<a class="icback" href="/DoAn/Giaovus/quanlyphong" title="Quay lại"></a>
		<a class="icedit" href="/DoAn/Giaovus/suaPhonghoc/<?php echo $data['Phong']['id'];?>" title="Sửa"></a>
		<a class="icdelete" href="/DoAn/Giaovus/xoaPhonghoc/<?php echo $data['Phong']['id'];?>" title="Xóa"></a>
	</div>
</div>