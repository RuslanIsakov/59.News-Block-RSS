<link rel="stylesheet" href="style.css">
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
