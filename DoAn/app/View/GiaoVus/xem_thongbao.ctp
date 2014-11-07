<div class="contentmain chitietkhoa">
	<h2>Chi tiết phòng học</h2>
	<span><b>Tiêu đề:</b> <span><?php echo $data['Thongbao']['tieude'];?></span></span>
	<span><b>Nội dung:</b> <span><?php echo $data['Thongbao']['noidung'];?></span></span>
	<span><b>Người đăng:</b> <span><?php $this->giaovu->convertViewdate($data['Thongbao']['ngaydang']);?></span></span>
	<span><b>Ngày cập nhật:</b> <span><?php echo $this->giaovu->convertViewdate($data['Thongbao']['ngayCapnhap']);
	?></span></span>
		
	<div class="left clear divIcon">
		<a class="icback" href="/DoAn/Giaovus/quanlyThongbao" title="Quay lại"></a>
		<a class="icedit" href="/DoAn/Giaovus/suaThongbao/<?php echo $data['Thongbao']['id'];?>" title="Sửa"></a>
		<a class="icdelete" href="/DoAn/Giaovus/xoaThongbao/<?php echo $data['Thongbao']['id'];?>" title="Xóa"></a>
	</div>
</div>