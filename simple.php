<?php
header("Cache-Control: public, max-age=3600");

$num = 5;
if($result = get_cache("calculate" . $num) === null) {
    $result = calculate($num);
    set_cache("calculate".$num, $result);
}
echo $result;

function calculate($num) {
    sleep(5);
    return $num*2;
}

// issues
// - cache never expires
// - null is a legitimate value sometimes
function get_cache($key) {
    $content = @file_get_contents("cache/$key");
    return $content !== false ? $content : null;
}

function set_cache($key, $value) {
    return file_put_contents("cache/$key", $value);
}