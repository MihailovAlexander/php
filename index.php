<?php
/*3.2.2 http URL (rfc)*/
$contextOptions = array(
        'http' => array(
        'method' => 'GET',
	'user_agent'=>'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko/20100101 Firefox/51.0',//летел пустой юзер в заголовках пришлось указать
//        'proxy' => 'tcp://proxy:6666'
    )
);


$matches_row=array();
$context = stream_context_create($contextOptions);
$url="https://shop.hopburnsblack.co.uk/collections/germany";
//>([A-Z]{1,1}[a-z]{1,}\s[[:word:]]{0,}.*?)<\/[a-z]+>\s+<[a-z]+.+>\s+(£[0-9]+.[0-9]+) --альтернатива без мусора
$pattern_one_row='/[A-Z]{1,1}[a-z]{1,}\s[[:word:]]{0,}.*?<\/[a-z]+>\s+<[a-z]+.+>\s+£[0-9]+.[0-9]+/';
$pattern_mus=array("/<\/[a-z]+>\s+<[a-z].+\s+/");

	$homepage = file_get_contents($url,false, $context);
	preg_match_all($pattern_one_row, $homepage, $matches_row, PREG_SET_ORDER);
	$count_array=(count($matches_row));
	for ($i = 0; $i <$count_array; $i++){
	    $one_row_array[$i]=$matches_row[$i][0]."\n";
	}
	$matches_row=preg_replace($pattern_mus,"\n",$one_row_array);
file_put_contents('germany.csv', $matches_row);
?>
