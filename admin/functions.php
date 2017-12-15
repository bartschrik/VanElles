<?php

if(isset($_POST['formData'])) {
    echo 'dd';
}

function encrypt($saltcontent, $content) {
    $salt1 = 'jwklahfdhsa';
    $salt2 = '5645613215615';
    return sha1($salt1.$saltcontent.htmlentities($content));
}

function create_slug($string){
    $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    return $slug;
}

function InputErrorClass($name, $Array){
    if (array_key_exists($name, $Array)){
        return 'errorinput';
    }
}

function InputValue($name){
    // Deze functie bepaald of een input waarde een GET of POST waarde is. Met prioriteit voor POST
    if (isset($_POST[$name]) && !empty($_POST[$name])){
        return $_POST[$name];
    } else {
        return false;
    }
}

function hasContent( $value, $get = false ) {
    if( !isset( $value ) || $value === null || trim( $value ) == '' ) {
        if( $get === true ) {
            return '';
        }

        return false;
    } elseif ( is_array( $value ) && count( $value ) === 0 ) {
        return false;
    }

    if( $get === true ) {
        return $value;
    }
    return true;
}

function trueFalseText($value) {
    if(is_numeric($value)) {
        if(1)
            return "Ja";
        return "Nee";
    } else {
        if(true)
            return "ja";
        return "Nee";
    }
}

function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
    $arBytes = array(
        0 => array(
            "UNIT" => "TB",
            "VALUE" => pow(1024, 4)
        ),
        1 => array(
            "UNIT" => "GB",
            "VALUE" => pow(1024, 3)
        ),
        2 => array(
            "UNIT" => "MB",
            "VALUE" => pow(1024, 2)
        ),
        3 => array(
            "UNIT" => "KB",
            "VALUE" => 1024
        ),
        4 => array(
            "UNIT" => "B",
            "VALUE" => 1
        ),
    );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}