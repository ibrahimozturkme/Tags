# Tag and File Management
- - -
[![Tag and File Management - Tanıtım Konusu](http://ibrahimozturk.me/assets/img/article/cover_1509916262.jpg)](http://ibrahimozturk.me/yazi/11-tag-ve-dosya-yonetimi)

[Tags and Files Management - Tanıtım Konusu](http://ibrahimozturk.me/yazi/11-tag-ve-dosya-yonetimi)

### Set

- `$type` : String.
- `$args` : String - Array.

### Export

- `$order` : String - Array.
- `$array` : Bool.
- `$append_code` : Bool.

### Examples

     $tags     = new Tags();

__Set Title Tag__

     $tags->set('title', 'Website Title');

__Set Meta Tags__

     $tags->set('meta', ['charset' => 'UTF-8'])
          ->set('link', ['rel' => 'stylesheet', 'href' => '/styles/app1.css'])
          ->set('script', ['type' => 'text/javascript', 'src' => '/javascripts/app1.js']);

     $tags->set('meta', [
          ['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'],
          ['http-equiv' => 'X-UA-Compatible', 'content' => 'ie=edge']
     ]);


__Set Link Tags__

     $tags->set('link',[
          ['rel' => 'stylesheet', 'href' => '/styles/app2.css'],
          ['rel' => 'stylesheet', 'href' => '/styles/app3.css']
     ]);

__Set Style Tags__

     $tags->set('style', ['type' => 'text/css', '<>' => 'body{background:#333;}']);

__Set Script Tags__

     $tags->set('script',[
          ['type' => 'text/javascript', 'src' => '/javascripts/app2.js'],
          ['type' => 'text/javascript', 'src' => '/javascripts/app3.js']
     ]);

__Schema__

     $schema['@context']      = 'https://schema.org';
     $schema['@type']         = 'Person';
     $schema['colleague'][]   = 'https://www.anadolu.edu.tr/';
     $schema['colleague'][]   = 'http://www.akdeniz.edu.tr/';
     $schema['email']         = 'mailto:work@ibrahimozturk.me';
     $schema['image']         = 'http://ibrahimozturk.me/assets/img/website/android-chrome-512x512.png';
     $schema['jobTitle']      = 'Full Stack Developer';
     $schema['name']          = 'İbrahim ÖZTÜRK';
     $schema['alumniOf']      = 'Anadolu Üniversitesi';
     $schema['gender']        = 'male';
     $schema['nationality']   = 'Türkiye';
     $schema['url']           = 'http://www.ibrahimozturk.me/';
     $schema['sameAs'][]      = 'https://www.facebook.com/ibrahimozturk.me';
     $schema['sameAs'][]      = 'https://www.twitter.com/ibrahmozturkme';
     $schema['sameAs'][]      = 'https://plus.google.com/+İbrahimÖZTÜRK01';
     $schema['sameAs'][]      = 'https://www.instagram.com/ibrahimozturk.me/';
     $schema['sameAs'][]      = 'https://www.youtube.com/channel/UCZOKJ9K5BBk5vW83GQHbEvg';
     $schema['sameAs'][]      = 'https://www.linkedin.com/in/ibrahimozturkme';
     $schema['sameAs'][]      = 'https://tr.pinterest.com/ibrahimozturkme/';

     $tags->set('script', ['type' => 'application/ld+json', '{}' => json_encode($schema)]);


#### __Export__

__String__

     echo $tags->export('title');

     /*
          ## Output ##
          <title>Website Title</title>
     */

__Array__

     echo $tags->export(['meta']);

     /*
          ## Output ##
          <meta charset="UTF-8"/>
          <meta name="viewport" content="width=device-width, initial-scale=1"/>
          <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
     */

__Array Order__

     echo $tags->export(['link', 'style', 'script']);

     /*
          ## Output ##

     	<link rel="stylesheet" href="/styles/app1.css"/>
     	<link rel="stylesheet" href="/styles/app2.css"/>
     	<link rel="stylesheet" href="/styles/app3.css"/>

     	<style type="text/css">body{background:#333;}</style>

     	<script type="text/javascript" src="/javascripts/app1.js"></script>
     	<script type="text/javascript" src="/javascripts/app2.js"></script>
     	<script type="text/javascript" src="/javascripts/app3.js"></script>
     	<script type="application/ld+json">{"@context":"https:\/\/schema.org","@type":"Person","colleague":["https:\/\/www.anadolu.edu.tr\/","http:\/\/www.akdeniz.edu.tr\/"],"email":"mailto:work@ibrahimozturk.me","image":"http:\/\/ibrahimozturk.me\/assets\/img\/website\/android-chrome-512x512.png","jobTitle":"Full Stack Developer","name":"\u0130brahim \u00d6ZT\u00dcRK","alumniOf":"Anadolu \u00dcniversitesi","gender":"male","nationality":"T\u00fcrkiye","url":"http:\/\/www.ibrahimozturk.me\/","sameAs":["https:\/\/www.facebook.com\/ibrahimozturk.me","https:\/\/www.twitter.com\/ibrahmozturkme","https:\/\/plus.google.com\/+\u0130brahim\u00d6ZT\u00dcRK01","https:\/\/www.instagram.com\/ibrahimozturk.me\/","https:\/\/www.youtube.com\/channel\/UCZOKJ9K5BBk5vW83GQHbEvg","https:\/\/www.linkedin.com\/in\/ibrahimozturkme","https:\/\/tr.pinterest.com\/ibrahimozturkme\/"]}</script>
     */


__Export Files__

     $scripts  = $tags->export('script', true);
     print_r($scripts);

     /*
          Array
          (
              [0] => /javascripts/app1.js
              [1] => /javascripts/app2.js
              [2] => /javascripts/app3.js
          )
     */

__Export Files and Code__

     $fnc_array    = $tags->export(['link', 'style', 'script'], true, true);
     print_r($fnc_array);
     /*
     Array
     (
         [0] => /styles/app1.css
         [1] => /styles/app2.css
         [2] => /styles/app3.css
         [3] => body{background:#333;}
         [4] => /javascripts/app1.js
         [5] => /javascripts/app2.js
         [6] => /javascripts/app3.js
         [7] => {"@context":"https:\/\/schema.org","@type":"Person","colleague":["https:\/\/www.anadolu.edu.tr\/","http:\/\/www.akdeniz.edu.tr\/"],"email":"mailto:work@ibrahimozturk.me","image":"http:\/\/ibrahimozturk.me\/assets\/img\/website\/android-chrome-512x512.png","jobTitle":"Full Stack Developer","name":"\u0130brahim \u00d6ZT\u00dcRK","alumniOf":"Anadolu \u00dcniversitesi","gender":"male","nationality":"T\u00fcrkiye","url":"http:\/\/www.ibrahimozturk.me\/","sameAs":["https:\/\/www.facebook.com\/ibrahimozturk.me","https:\/\/www.twitter.com\/ibrahmozturkme","https:\/\/plus.google.com\/+\u0130brahim\u00d6ZT\u00dcRK01","https:\/\/www.instagram.com\/ibrahimozturk.me\/","https:\/\/www.youtube.com\/channel\/UCZOKJ9K5BBk5vW83GQHbEvg","https:\/\/www.linkedin.com\/in\/ibrahimozturkme","https:\/\/tr.pinterest.com\/ibrahimozturkme\/"]}
     )     */
