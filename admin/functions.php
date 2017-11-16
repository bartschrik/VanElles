<?php

if(isset($_POST['formData'])) {
    echo 'dd';
}

function encrypt($saltcontent, $content) {
    $salt1 = 'jwklahfdhsa';
    $salt2 = '5645613215615';
    return sha1($salt1.$saltcontent.htmlentities($content));
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