<?php
$browser = getenv('HTTP_USER_AGENT');

if (preg_match("/^Mozilla\/.*?Firefox\/\d\.\d/", $browser)) {
    $browser = 'mozilla';
} elseif (preg_match("/^Mozilla\/.*?Gecko\/\d{8}/", $browser)) {
    $browser = 'mozilla';
} elseif (preg_match("/^Mozilla\/.*?\(compatible; MSIE/", $browser)) {
    $browser = 'ie';
} elseif (preg_match("/^Mozilla\/.*?\(compatible; Konqueror/", $browser)) {
    $browser = 'konqueror';
} elseif (preg_match("/^Opera\/\d\.\d/", $browser)) {
    $browser = 'opera';
} elseif (preg_match("/^Mozilla\/.*?Safari/", $browser)) {
    $browser = 'safari';
} else {
    $browser = 'ka';
}

/*
 Mozilla Firefox
 Mozilla/5.0 (Windows; U; Windows NT5.1;de-DE;rv;:1.7.12) Gecko/20050919 Firefox/1.07
 Mozilla/5.0 (X11; U; Linux i686; de-DE; rv:1.7.10) Gecko/20050925 Firefox/1.0.4 (Debian package 1.0.4-2sarge5)
 
 Mozilla
 Mozilla/5.0 (X11; U; Linux i686; rv:1.7.8) Gecko/20050831 Debian/1.7.8-1sarge2
 
 IE
 Mozilla/4.0 (compatible;MSIE 6.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)
 
 Konquerer
 Mozilla/5.0 (compatible; Konqueror/3.3; Linux) KHTML/3.3.2 (like Gecko)
 
 Epiphany
 Mozilla/5.0 (X11; U; Linux i686; rv:1.7.8) Gecko/20050831 Epiphany/1.4.8 (Debian)

 Opera
 Opera/9.00 (Windows NT 5.1; U; de)
 Opera/9.02 (Windows NT 5.1; U; de)

 Safari
 Mozilla/5.0 (Macintosh; U; Intel Mac OS X; de-de) AppleWebKit/419 (KHTML, like Gecko) Safari/419.3
*/
