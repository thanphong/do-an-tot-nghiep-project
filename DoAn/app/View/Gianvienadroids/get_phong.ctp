<?php
	header('Content-type: application/json');
    echo json_encode( $phongs,JSON_UNESCAPED_UNICODE);
?>