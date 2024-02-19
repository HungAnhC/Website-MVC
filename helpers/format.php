<?php
/**
* Format Class
*/
class Format{
// Hàm dùng để định dạng ngày giờ
 public function formatDate($date){
    return date('F j, Y, g:i a', strtotime($date));
 }
// Hàm dùng để rút ngắn một đoạn văn bản với một giới hạn nhất định
 public function textShorten($text, $limit = 400){
    $text = $text. " ";
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text.".....";
    return $text;
 }
// Hàm xử lý dữ liệu đầu vào và thực hiện một số thao tác làm sạch ngăn chặn tấn công XSS
 public function validation($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }
// Hàm xác định tiêu đề của trang web dựa trên tên của tệp script
 public function title(){
    $path = $_SERVER['SCRIPT_FILENAME'];
    $title = basename($path, '.php');
    //$title = str_replace('_', ' ', $title);
    if ($title == 'index') {
     $title = 'home';
    }elseif ($title == 'contact') {
     $title = 'contact';
    }
    return $title = ucfirst($title);
   }
}
?>
