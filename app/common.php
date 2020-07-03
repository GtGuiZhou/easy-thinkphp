<?php
// 应用公共文件

if (!function_exists('output_warp')){
    function output_warp($data = null,$message = 'success',$code = 200){
        return json([
            'data' => $data,
            'msg' => $message,
        ],$code);
    }
}


if (!function_exists('default_date')){
    function default_date(){
        return date('Y-m-d H:i:s');
    }
}