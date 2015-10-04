<?php
	
    var_dump($_SERVER);
    var_dump($_POST);
    die;


$tmp = $_FILES['file']['tmp_name']; 
$emri = $_FILES['file']['name'];
$madhesia= $_FILES['file']['size'];
$file_src = dirname(__FILE__)."/uploads/";

if (move_uploaded_file($tmp, $file_src.$emri)) {
    echo 'ok';
} else {
    echo 'not ok';
}
 
    $destination = "http://magnolia/freedomnow/cms/wp-json/media";

    $eol = "\r\n";
    $data = '';

    $mime_boundary=md5(time());

    $data .= '--' . $mime_boundary . $eol;
    $data .= 'Content-Disposition: form-data; name="ConvertTo"' . $eol . $eol;
    $data .= "txt" . $eol;
    $data .= '--' . $mime_boundary . $eol;
    $data .= 'Content-Disposition: form-data; name="Converter"' . $eol . $eol;
    $data .= "pc" . $eol;
    $data .= '--' . $mime_boundary . $eol;
    $data .= 'Content-Disposition: form-data; name="filename"; filename='.$emri . $eol;
    $data .= 'Content-Type: application/pdf' . $eol;
    $data .= 'Content-Transfer-Encoding: binary' . $eol . $eol;
    $data .= file_get_contents($file_src.$emri) . $eol;
    $data .= "--" . $mime_boundary . "--" . $eol . $eol; 

    $para = array('http' => array(
        'method' => 'POST',
        'header' => 'Content-Type: multipart/form-data; boundary=' . $mime_boundary . $eol,
        'length' => 'Content-Length: '.$madhesia,
        'content' => $data
    ));

    $ctx = stream_context_create($para);

    $response = file_get_contents($destination, FILE_USE_INCLUDE_PATH, $ctx);

    /**
     * Debug
     */         
    var_dump($response);
 