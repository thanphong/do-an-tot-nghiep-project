<div class="contentmain chitietkhoa">
	<h2>Chi tiết học phần</h2>
	<span><b>Mã học phần:</b> <?php echo $data['Hocphan']['maHocPhan'];?></span>
	<span><b>Tên học phần:</b> <?php echo $data['Hocphan']['tenhocphan'];?></span>
	<span><b>Kỳ học:</b> <?php echo $data['Hocphan']['kyhoc'];?></span>
	<span><b>Số tín chỉ:</b> <?php echo $data['Hocphan']['sotinchi'];?></span>
	<span><b>Ngành:</b> <?php echo $data['Nganh']['TenNganh'];?></span>
	<span><b>Mô tả:</b> <?php echo $data['Hocphan']['mota'];?></span>
	<span><b>Trạng thái:</b> <?php  
			if($data['Hocphan']['trangthai']==1)echo 'Chưa học';
			if($data['Hocphan']['trangthai']==2)echo 'Đang học';
			if($data['Hocphan']['trangthai']==3)echo 'Kết thúc';?></span>
	<span><b>Ngày cập nhật:</b> <?php echo $this->giaovu->convertViewdate($data['Hocphan']['updatDate']);?></span>
		
	<div class="left clear divIcon">
		<a class="icback" href="/DoAn/Giaovus/quanlyHocphan" title="Quay lại"></a>
		<a class="icedit" href="/DoAn/Giaovus/suaHocphan/<?php echo $data['Hocphan']['id'];?>" title="Sửa"></a>
		<a class="icdelete" href="/DoAn/Giaovus/xoaHocphan/<?php echo $data['Hocphan']['id'];?>" title="Xóa"></a>
	</div>
</div>