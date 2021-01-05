<?php
function assets_part($partfile){

    return base_url('Assets'.'/'.$partfile);
}
function sitetype(){
    return 'movie';
}
function dd(...$args)
{


        echo "<pre style='background: chocolate;'>";
        print_r($args);
        echo "</pre>";


    exit();
}
function isset_not_empty(&$value, $default = null)
{
    try {
        return isset($value) && !empty($value) ? $value : $default;
    } catch (\Exception $e) {
        return $default;
    }


}
function dateFormat($format,$data){

    $newDate = date($format, strtotime($data));
    return $newDate;
}
function images_part($partfile){

    return base_url('cdn-cgi/image/q=75,f=auto/upmovies/upload'.'/'.$partfile);

}

function converLinkGoogleDrive($data){

    $strSearch=strpos($data,'id=');

        $newdata =substr($data,$strSearch+3,strlen($data)-1);

        return  'https://drive.google.com/file/d/'.$newdata.'/preview';

}

function dateNow($format=""){
    date_default_timezone_set('Asia/Karachi'); # add your city to set local time zone
    if($format==""){
        return date("Y-m-d H:i:s");
    }else{
        return date($format);
    }

}
function converEmbedYoutube($data){

    $strSearch=strpos($data,'?v=');

        $newdata =substr($data,$strSearch+3,strlen($data)-1);

        return  'https://youtube.com/embed/'.$newdata ;

}
function convertNametoLinkSEO($con1){
    $con2="";
    $con2 = str_replace(' ', '-', $con1);
    $con2 = str_replace('/', '-', $con2);
    $con2 = str_replace('\'', '-', $con2);
    $con2 = str_replace(',', '-', $con2);
    $con2 = str_replace('"', '-', $con2);
    return $con2;
}


?>
