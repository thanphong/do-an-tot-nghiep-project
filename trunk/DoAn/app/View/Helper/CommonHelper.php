<?php
App::import("Model", "Common");
class CommonHelper extends HtmlHelper{

	function creatFooter(){
		$footer="<span>Bản quyền (C) 2013 thuộc Hồ Ngọc Duy</span></br><span>Trường Đại học Bách Khoa - Đại học Đà Nẵng</span></br>";
		$footer.="<span>Email:Thanphong.dct@gmail.com </span></br><span>Điện thoại: 01649568431</span>";
		$header="<div id='logo'>".
				$this->image("image/logo.jpg", array('alt' => 'luatvn', 'class' => 'logoleft')).
				$this->image("image/logo2.png", array('alt' => 'luatvn','style' => 'margin:10px 0 0 10px'))
				."
						<div class='today'>Hôm nay: ". date('d-m-Y')."</div>";
		//		$header="<div id='logo'><image class='logoleft' src='img/image/logo.jpg' alt='luatvn'/></div><div class='today'>Hôm nay :". date('d-m-Y')."</div> <div class='clear'></div>";
		$header.='<form class="right" action="/luatvnam/Searchs/search" method="POST"><input type="text" id="search" name="info" style="width:200px;margin-top:9px;"/><input class="icsearch" id="btnsearch" type="submit" name="search" value=""/></form></div>';
		$data = array(
				"header" => $header,
				"footer" => $footer,
		);

		return $data;
	}
	function create_heaeder(){
		$tt="Học Luật Việt Nam";
		$data= $this->general();
		$header="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'> <html xmlns='http://www.w3.org/1999/xhtml'><head>";
		$header.=$this->charset();
		$header.="<title>".$tt."</title>";
		$header.=$this->css(array("styles.css","tabs.css"));
		$header.= $this->script(array('jquery-1.7.2.min.js','validate.js','lightbox.js','jquery-latest.pack.js','jcarousellite_1.0.1c4.js','jquery.jgfeed.js','news.js','general.js','highlightNav.js'));
		$header.=$this->css(array("themes/1/js-image-slider.css","generic.css"));
		$header.= $this->script(array('themes/1/js-image-slider.js','slideShow.js'));
		$header.="<script type='text/javascript'>
				$(function() {
			 $('.jcarouse').jCarouselLite({
			 vertical: true,
			 hoverPause:true,
			 visible: 3,
			 auto:500,
			 speed:1000
	});
	});
				</script>";

		//$header.="<div id='bttop'>BACK TO TOP</div></head>";
		//$header.="<body>";
		//$header.="<div id='wrapper'><div id='header'>".$data['header']."</div><div class='cach'></div>";
		//$header.="<div id='menu-nav'>".$this->create_menu($username)."</div>";

		return $header;
	}
}
?>