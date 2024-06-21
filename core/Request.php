<?php
namespace core;

class Request
{

    public static function capture()
    {
        return new self();
    }

    public function input($key, $default = null)
    {
        return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
    }

    public static function send_response($http_status, $response)
    {
        header('Content-Type: application/json');
        http_response_code($http_status);
        echo json_encode($response);
    }

    public static function send_pdf_response($http_status, $fileContent, $fileName = 'document.pdf') {
        http_response_code($http_status);
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        echo $fileContent;
    }

    public static function send_file_response($http_status, $filePath, $fileName) {
        http_response_code($http_status);
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
    }
}

?>