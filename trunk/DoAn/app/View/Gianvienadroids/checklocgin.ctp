<?php
	header('Content-type: application/json');
    echo json_encode( $user,JSON_UNESCAPED_UNICODE);
?>