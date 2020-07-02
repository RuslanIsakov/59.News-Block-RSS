<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" href="css/style.css">
<title> News </title>
<?php
header('Content-Type: text/html; charset=utf-8');
/**********************************************************
 * Parse XML data into an array structure                 *
 * Usage: array parse_rss ( string data )                 *
 **********************************************************/
function parse_rss($reg_exp, $xml_data) {
    preg_match_all($reg_exp, $xml_data, $temp);
    return array(
 'count'=>count($temp[0]),
        'title'=>$temp[1],
        'link'=>$temp[2],
        'desc'=>$temp[3]
    );
}
 
/**********************************************************
 * Parse Array data into an HTML structure                *
 * Usage: string parse_rss ( array data )                 *
 **********************************************************/
function output_rss($pattern, $rss_data, $count_latest) {
    $temp = null;
for($i = 0; $i < $count_latest; $i++) {
        $temp .= sprintf($pattern,
$rss_data['link'][$i],
            html_entity_decode($rss_data['title'][$i]),
            html_entity_decode($rss_data['desc'][$i])
        );
 }
    return $temp;
}
/**********************************************************
 * Settings                                               *
 **********************************************************/
$url = 'https://ru.sputnik.kg/export/rss2/archive';
$reg_exp  = '#<item>.*?<title>(.*?)<\/title>.*?';
$reg_exp .='<link>(.*?)<\/link>.*?<description>';
$reg_exp .='(.*?)<\/description>.*?<\/item>#si';
$pattern = '<div class="wrap-login100"><a href="%s" target="_blank"><hr>%s</a><br>%s</div>';
/**********************************************************
 * Main script                                            *
 **********************************************************/
if ( $xml_data = file_get_contents($url) ) {
 $rss_data = parse_rss($reg_exp, $xml_data);
