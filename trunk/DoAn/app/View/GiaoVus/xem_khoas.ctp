<div class="contentmain chitietkhoa">
	<h2>Chi tiết khoa</h2>
	<span><b>Mã khoa:</b> <?php echo $data['Khoa']['maKhoa'];?></span>
	<span><b>Tên khoa:</b> <?php echo $data['Khoa']['tenKhoa'];?></span>
	<span><b>Mô tả:</b> <?php echo $data['Khoa']['mota'];?></span>
	<div class="left clear divIcon">
		<a class="icback" href="/DoAn/GiaoVus/quanlyKhoa" title="Quay lại"></a>
		<a class="icedit" href="/DoAn/GiaoVus/suaKhoa/<?php echo $data['Khoa']['id'];?>" title="Sửa"></a>
		<a class="icdelete" href="/DoAn/GiaoVus/xoaKhoa/<?php echo $data['Khoa']['id'];?>" title="Xóa"></a>
	</div>
</div>