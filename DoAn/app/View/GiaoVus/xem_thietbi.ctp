<div class="contentmain chitietkhoa">
	<h2>Chi tiết thiết bị</h2>
	<span><b>Mã thiết bị:</b> <?php echo $data['Thietbi']['mathietbi'];?></span>
	<span><b>Tên thiết bị:</b> <?php echo $data['Thietbi']['tenThietbi'];?></span>
	<span><b>Loại thiết bị:</b> <?php echo $data['Loaithietbi']['tenLoai'];?></span>
	<span><b>Trạng thái:</b> <?php echo $data['Thietbi']['trangThai'];?></span>
	<span><b>Ngày cập nhật:</b> <?php echo $this->giaovu->convertViewdate($data['Thietbi']['ngayCapNhap']);
	?>
	</span>
	<div class="left clear divIcon">
		<a class="icback" href="/DoAn/Giaovus/quanlyThietbi" title="Quay lại"></a>
		<a class="icedit" href="/DoAn/Giaovus/suaThietbi/<?php echo $data['Thietbi']['id'];?>" title="Sửa"></a>
		<a class="icdelete" href="/DoAn/Giaovus/xoaThietbi/<?php echo $data['Thietbi']['id'];?>" title="Xóa"></a>
	</div>
</div>