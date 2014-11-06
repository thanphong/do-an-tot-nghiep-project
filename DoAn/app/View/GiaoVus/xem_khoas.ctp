<div class="contentmain chitietkhoa">
	<h2>Chi tiết khoa</h2>
	<span><b>Mã khoa:</b> <?php echo $data['Khoa']['maKhoa'];?></span>
	<span><b>Tên khoa:</b> <?php echo $data['Khoa']['tenKhoa'];?></span>
	<span><b>Mô tả:</b> <?php echo $data['Khoa']['mota'];?></span>
	<div class="left clear divIcon">
		<a class="icback" href="/DoAn/Giaovus/quanlyKhoa" title="Quay lại"></a>
		<a class="icedit" href="/DoAn/Giaovus/suaKhoa/<?php echo $data['Khoa']['id'];?>" title="Sửa"></a>
		<a class="icdelete" href="/DoAn/Giaovus/xoaKhoa/<?php echo $data['Khoa']['id'];?>" title="Xóa"></a>
	</div>
</div>