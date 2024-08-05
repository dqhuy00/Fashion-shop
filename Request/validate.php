<?php
$query = new Query();
// hàm sử lý dùng để sử lý lỗi (hàm chính )
function validate($handle, $messageInput)
{
    // tạo lất ss error mặt định là một arr
    $error = session_get('error');
    // đặt một biết để kiểm tra form có lỗi không nếu có lỗi thì quay lại trang form còn không lỗi thì tiếp tục sử lý đăng nhập
    $isError = false;
    // $handle là một array chủa key(tên của input) value là một mãng tên tên của các được định nghĩa pử dưới 
    // do đó sử dùng vồng lập để lập qua các tên biên input từ các tên đó lấy các các hàm funtion đã định nghĩa
    foreach ($handle as $name => $funNameList) {
        foreach ($funNameList as $fun) {
            // khí lấy ra các hàm đã được định nghĩ niêu hàm có đối số sẽ cách nhâu bằng ":"
            // sử dụng explode để tách các chuổi đằng sâu ký tự : thành mảng vd min:8 = [min,8]
            $funArr = explode(':',  $fun);
            // lấy ra mảng đâu tiên để làm tên hàm 
            $funName = array_shift($funArr);
            // sử dụng tên input nói với tên hàm để lấy ra messages lỗi đã được dịnh nghĩ nếu không có thì lấy một chuoiot ""
            $nameMessageKey = $name . '.' .  $funName;

            // call_user_func là hàm gội tới fuction thông qua tên chuổi  đối số thứ nhất là tên hàm , các đối số thứ 2 trở đi là đối số chuyền vào hàm
            $message = call_user_func($funName, $name, $messageInput[$nameMessageKey] ?? '', ...$funArr);
            // trả về error nếu không có error thì chả về undefined
            if (isset($message)) {
                // nếu có lỗi thì gắn gắn isError = true
                // input đã nhập , thông báo lôi 
                // thoát ra vồng lập
                $isError = true;
                $error[$name] = [
                    'message' => $message,
                    'old' => input($name),
                ];
                break;
            } else {
                // nếu không có lỗi thì chỉ thống là một '' và chỉ gia trị nhập vào
                $error[$name] = [
                    'message' => '',
                    'old' => input($name),
                ];
            }
        }
    }

    if ($isError == true) {
        // sâu khi lập qua sông thì bắc đầu kiểm tra nếu isError == true
        // nó sẽ gắng ss error = mảng $error
        session_push('error', $error);
        // sâu đó sử hàm back quay lại trang trước đó
        back();
        // để chách trường hợp nó sứ lý những phần dưới thì dùng exit để ngừng hoạt động những phần ở dưới
        exit;
    }
    // nếu không có lỗi thì nó lấy ra dử liệu của get || hoạt post
    return $_POST ?? $_GET;
}
// hàm kiểm tra chuổi có phải là chuổi rổng không
function required($name, $message)
{
    if (empty(input($name)) || !empty(input($name)) && trim((string) input($name)) == '') {
        return isset($message) &&  $message != '' ? $message : "trường dữ $name liệu này không được để tróng";
    }
};
// hàm kiểm tra chuổi chuổi nhập ích nhất
function minLength($name,  $message, $min)
{
    if (strlen(input($name)) < $min) {
        return isset($message) &&  $message != '' ? $message : "$name phải lớn hơn $min";
    }
}
// hàm kiểm tra đồi dài ca nhất chuổi có thể nhập
function maxLength($name,  $message, $max)
{
    if (strlen(input($name)) > $max) {
        return isset($message) &&  $message != '' ? $message : "$name phải nhỏ hơn $max";
    }
}
function isNumber($name, $message)
{
    if (!empty(input($name)) && !is_numeric(input($name))) {
        return isset($message) &&  $message != '' ? $message : "$name phải là số";
    }
}
function unique($name, $message, $table, $col)
{
    global $query;
    $data = $query->table($table)->select()->where($col, '=', input($name))->first();
    if (!empty($data) && count($data) > 0) {
        return isset($message) &&  $message != '' ? $message : "$name có tồn tại trong bản $col";
    }
}
