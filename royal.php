<?php
//HARDCODEBYGHAZIMUHARAM
//NORECODEANDNOTFORSALE
//KANG SNIFF MANGGALA FEBRI VALENTINO
echo "Masukkan UserID : ";
$uid 	    = trim(fgets(STDIN));
if(empty($uid)){
    $uid = '3069618603';
}
echo "Masukkan Token : ";
$track 	    = trim(fgets(STDIN));
if(empty($track)){
    $track = '646f737c2363688a1e2b9c0a4160eca68e75d9db544d617e39fffa5da7f0c76b';
}
//
function request($url,$headers,$post = 0){
        $ch =   curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        	if($post !== 0) {
        		curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
        		curl_setopt ($ch, CURLOPT_POST, 1); 
        	}
        
        	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        	curl_setopt ($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
        	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
    
    	$result = curl_exec($ch);
    	    curl_close($ch);
	return $result;
}
$url        =   "http://instalike.socialmarkets.info/user/$uid/trackAction/$track";
$urltoken   =   "http://instalike.socialmarkets.info/user/$uid/getBoard/0/$track";
$headers    =   array();
$headers[]  =   'systemVersion: royallikesandroid/  (Redmi 3S/23/6.0.1)';
$headers[]  =   'User-Agent: royallikes 7 (Redmi 3S/23/6.0.1)';
$headers[]  =   'Content-Type: application/json; charset=utf-8';
function orderid($urltoken,$headers){
    $page   =   json_decode(request($urltoken,$headers));
    return $page->data->boardList;
}
function runner($url, $urltoken,$headers){
    $counter    =   orderid($urltoken,$headers);
    print("Looping For ".count($counter)."\n");
    for ($i = 0; $i < count($counter); $i++) {
         $orderid       =   $counter[$i]->orderId;
         $postdata      =   '{"action":0,"actionToken":"127812DFA43492D9058B8D6B7F1B0307","orderId":'.$orderid.'}';
         echo request($url, $headers, $postdata).'-'.$orderid;
         echo "\n";
    }
    echo $orderid;
}
echo runner($url, $urltoken,$headers);
            echo "Masukkan Jumlah: ";
            $counter	= trim(fgets(STDIN));
            while(true){
                $orderid       =   $counter++;
                $postdata      =   '{"action":0,"actionToken":"127812DFA43492D9058B8D6B7F1B0307","orderId":'.$orderid.'}';
                echo request($url, $headers, $postdata).'-'.$orderid;
                echo "\n";
            }
            echo $orderid;
?>
