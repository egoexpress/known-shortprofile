<?php
    if (!empty($vars['user']->profile['url']) && is_array($vars['user']->profile['url'])) {
        foreach($vars['user']->profile['url'] as $url) {
            if (!empty($url)) {
                
                $h_card = 'u-url';

                // Quick shim for Twitter usernames
                if ($url[0] == '@') {
                    if (preg_match("/\@[a-z0-9_]+/i", $url)) {
                        $url = str_replace('@','',$url);
                        $url = 'https://twitter.com/' . $url;
                    }
                }

                $url = $this->fixURL($url);
                $url_display = rtrim($url, '/');
                $url_filtered = end(explode('/', $url_display));
                
                // Pick appropriate icon
                $host = parse_url($url, PHP_URL_HOST);
                $host = str_replace('www.','',$host);
                switch($host) {

                    case 'twitter.com':         
                        $icon = 'fa fa-twitter'; 
                        break;
                    case 'github.com':          
                        $icon = 'fa fa-github-square'; 
                        break;
                    case 'fb.com':
                    case 'facebook.com':        
                        $icon = 'fa fa-facebook'; 
                        break;
                    case 'plus.google.com':     
                        $icon = 'fa fa-google-plus'; 
                        $url_filtered = preg_replace('/plus.google.com\//','',$url_display);
                        $url_filtered = preg_replace('/\/about$/','',$url_filtered);
                        $url_filtered = preg_replace('/^\+/','', $url_filtered);
                        break;
                    case 'linkedin.com':        
                        $icon = 'fa fa-linkedin'; 
                        break;
                    case 'instagram.com':       
                        $icon = 'fa fa-instagram'; 
                        break;
                    case 'untappd.com':         
                        $icon = 'fa fa-beer'; 
                        break;
                    case 'xing.com':            
                        $icon = 'fa fa-xing'; 
                        break;
                    case 'last.fm':             
                        $icon = 'fa fa-lastfm'; 
                        break;
                    case 'keybase.io':
                        $icon = 'fa fa-key';
                        break;
                    case 'about.me':
                        $icon = 'fa fa-user';
                        break;
                    case 'paypal.me':
                        $icon = 'fa fa-paypal';
                        $url_filtered = preg_replace('/www.paypal.me\/(\w*).*/','$1',$url_display);
                        break;
                    case 'pinboard.in':         
                        $icon = 'fa fa-bookmark'; 
                        $url_filtered = str_replace('pinboard.in/u:','',$url_display);
                        $url_filtered = preg_replace('/\/public$/','',$url_filtered);
                        break;
                    case (preg_match('/.*foursquare\.com/', $host) ? true : false): 
                        $icon = 'fa fa-foursquare'; 
                        break;
                    case (preg_match('/.*newsblur\.com/', $host) ? true : false): 
                        $icon = 'fa fa-newspaper-o'; 
                        $url_filtered = str_replace('.newsblur.com','',$url_display);
                        break;
                    case 'flickr.com':         
                        $icon = 'fa fa-flickr'; 
                        $url_filtered = preg_replace('/www.flickr.com\/photos\/(\w*).*/','$1',$url_display);
                        break;  
                    case 'strava.com':         
                        $icon = 'fa fa-bicycle'; 
                        $url_filtered = preg_replace('/www.strava.com\/athletes\/(\w*).*/','$1',$url_display);
                        break;                    
                    case 'leanpub.com':         
                        $icon = 'fa fa-leanpub'; 
                        $url_filtered = preg_replace('/leanpub.com\/u\/(\w*).*/','$1',$url_display);
                        break; 
                    case 'goodreads.com':          
                        $icon = 'fa fa-book'; 
                        break;               
                    case 'telegram.me':          
                        $icon = 'fa fa-paper-plane'; 
                        break;
                    case 'zotero.org':          
                        $icon = 'fa fa-bookmark'; 
                        break;
                    case 'reddit.com':         
                        $icon = 'fa fa-reddit'; 
                        $url_filtered = preg_replace('/www.reddit.com\/user\/(\w*).*/','$1',$url_display);
                        break;
                    case 'soundcloud.com':         
                        $icon = 'fa fa-soundcloud'; 
                        break;
                    case 'medium.com':         
                        $icon = 'fa fa-medium'; 
                        break;
                    case 'vimeo.com':         
                        $icon = 'fa fa-vimeo'; 
                        break;
                    case '500px.com':         
                        $icon = 'fa fa-500px'; 
                        break;
                    case 'youtube.com':         
                        $icon = 'fa fa-youtube'; 
                        $url_filtered = preg_replace('/www.youtube.com\/user\/(\w*).*/','$1',$url_display);
                        break;
                    case 'snapchat.com':         
                        $icon = 'fa fa-snapchat'; 
                        $url_filtered = preg_replace('/www.snapchat.com\/add\/(\w*).*/','$1',$url_display);
                        break;
                    case 'bible.com':         
                        $icon = 'fa fa-book'; 
                        $url_filtered = preg_replace('/www.bible.com\/users\/(\w*).*/','$1',$url_display);
                        break;
                    case 'anchor.fm':         
                        $icon = 'fa fa-anchor'; 
                        break;
                    case 'pinterest.com':         
                        $icon = 'fa fa-pinterest'; 
                        break;
                    case (preg_match('/.*wordpress\.com/', $host) ? true : false): 
                        $icon = 'fa fa-wordpress'; 
                        $url_filtered = str_replace('.wordpress.com','',$url_display);
                        break;
                    case (preg_match('/.*tumblr\.com/', $host) ? true : false): 
                        $icon = 'fa fa-tumblr'; 
                        $url_filtered = str_replace('.tumblr.com','',$url_display);
                        break;
                    case 'gitshowcase.com':          
                        $icon = 'fa fa-github'; 
                        break;
                    case 'behance.net':          
                        $icon = 'fa fa-behance'; 
                        break;
                    case 'micro.blog':          
                        $icon = 'fa fa-rss-square'; 
                        break;
                    case 'cash.me':         
                        $icon = 'fa fa-money'; 
                        break;
                        
                    default:                    
                        $icon = 'fa fa-link'; 
                        $url_filtered = $url_display;
                        break;
                }

                $url_display = $url_filtered;

                $scheme = parse_url($url, PHP_URL_SCHEME);
                switch ($scheme) {
                    case 'mailto' :
                        $icon = 'fa fa-envelope-o'; $url_display = str_replace('mailto:', '', $url_display); $h_card = 'u-email';
                        break;
                    case 'sms' :
                        $icon = 'fa fa-mobile'; $url_display = str_replace('sms:', '', $url_display); $h_card = 'p-tel';
                        break;
                    case 'sip' :
                    case 'tel' :
                        $icon = 'fa fa-phone'; $url_display = str_replace('tel:', '', $url_display); $h_card = 'p-tel';
                        break;
                    case 'skype' :
                        $icon = 'fa fa-skype'; $url_display = str_replace('skype:', '', $url_display); $h_card = 'p-skype';
                        break;
                    case 'bitcoin':
                        $icon = 'fa fa-btc'; $url_display = str_replace('bitcoin:', '', $url_display); $h_card = 'p-bitcoin';
                        break;
                    case 'facetime' :
                        $icon = 'fa fa-video-camera'; $url_display = str_replace('facetime:', '', $url_display); $h_card = 'p-facetime';
                        break;
                }
                
?>
        <p class="url-container">
            <i class="<?=$icon?>"></i> <a href="<?=htmlspecialchars($url)?>" rel="me" class="<?=$h_card; ?>"><?=str_replace('http://','',str_replace('https://','', strip_tags($url_display)))?></a>
        </p>
<?php
            }
        }
    }
?>
