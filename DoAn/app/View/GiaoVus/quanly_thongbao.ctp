<?php
echo $this->Common->script("//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js");
echo $this->Common->script("ckeditor/ckeditor.js");
echo $this->Common->script("ckeditor/adapters/jquery.js");
echo $this->Common->script("/js/news.js");
echo $this->giaovu->form_thongbao();
echo $this->giaovu->listThongbao($listThongbao);
?>