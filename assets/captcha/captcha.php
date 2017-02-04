<?php
$acceptedTypes = explode(',', $_SERVER['HTTP_ACCEPT']);
if (strpos($acceptedTypes[0], 'image/') === 0) {
    define('DS', DIRECTORY_SEPARATOR);
    define('imgpath', realpath(dirname(__FILE__) . DS) . DS . 'img' . DS);

    function generateСode()
    {
        $chars = 'abdefhknrstyz23456789';
        $length = rand(4, 7);
        $numChars = strlen($chars);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, rand(1, $numChars) - 1, 1);
        }

        $array_mix = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
        srand((float)microtime() * 1000000);
        shuffle($array_mix);

        return implode("", $array_mix);
    }

    $captcha = generateСode();
    session_start();
    $_SESSION['captcha'] = password_hash($captcha, PASSWORD_DEFAULT);

    function imgCode($code) // $code - код нашей капчи, который мы укажем при вызове функции
    {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Content-Type:image/png");
        $linenum = rand(5, 10);
        $img_arr = ["1.png"];
        $font_arr = [];
        $font_arr[0]["fname"] = "DroidSans.ttf";
        $font_arr[0]["size"] = rand(20, 30);
        $n = rand(0, sizeof($font_arr) - 1);
        $img_fn = $img_arr[rand(0, sizeof($img_arr) - 1)];
        $im = imagecreatefrompng(imgpath . $img_fn);
        for ($i = 0; $i < $linenum; $i++) {
            $color = imagecolorallocate($im, rand(0, 150), rand(0, 100), rand(0, 150)); // Случайный цвет c изображения
            imageline($im, rand(0, 15), rand(20, 50), rand(150, 160), rand(30, 60), $color);
        }
        $color = imagecolorallocate($im, rand(0, 200), 0, rand(0, 200)); // Опять случайный цвет. Уже для текста.

        $x = rand(0, 10);
        for ($i = 0; $i < strlen($code); $i++) {
            $x += 15;
            $letter = substr($code, $i, 1);
            imagettftext($im, $font_arr[$n]["size"], rand(2, 4), $x, rand(50, 55), $color, imgpath . $font_arr[$n]["fname"], $letter);
        }

        for ($i = 0; $i < $linenum; $i++) {
            $color = imagecolorallocate($im, rand(0, 255), rand(0, 200), rand(0, 255));
            imageline($im, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
        }
        imagepng($im);
        imagedestroy($im);
    }

    imgCode($captcha);
} else {
    echo 'Ошибка доступа!';
}
?>