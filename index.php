<?php

define('DATA_URL', 'http://'. $_SERVER['HTTP_HOST'] .'/data');
define('DATA_DIR', '/data/');

$pingresult = \exec('/bin/ping -c 1 192.168.1.2', $outcome, $status);
define('DATA_ACCESSIBLE', is_dir(DATA_DIR) && $dh = opendir(DATA_DIR));
if ($status === 0 && DATA_ACCESSIBLE) {
	header('Location: '. DATA_URL);
	exit;
}

include '/var/www/html/_header.php';

if (DATA_ACCESSIBLE) {
	print 'The media service is currently unavailable, <em>it may be turning on</em>. Please wait about 3 minutes.<span id="dots"></span>';
} else {
    print 'The media service is currently offline, but it will now turn on. <em>Please wait about 3 minutes</em>.<span id="dots"></span>';
}

print '<meta http-equiv="refresh" content="20; url='. $_SERVER['REQUEST_URI'] .'" />';
print '<script>var c=0; var e=document.getElementById("dots"); function incdots(){ if(c==2) {c=0;e.innerHTML="";} else {c++;e.innerHTML+="."}}; setInterval(incdots, 1000);</script>';
include '/var/www/html/_footer.php';
