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
                $exploded_url = explode('/', $url_display);
                $url_filtered = end($exploded_url);

                // Pick appropriate icon
                $host = parse_url($url, PHP_URL_HOST);
                $host = str_replace('www.','',$host);
                switch($host) {

                    case 'twitter.com':
                        $icon = 'fa-twitter';
                        break;
                    case 'github.com':
                        $icon = 'fa-github';
                        break;
                    case 'fb.com':
                    case 'facebook.com':
                        $icon = 'fa-facebook-square';
                        break;
                    case 'plus.google.com':
                        $icon = 'fa-google-plus-square';
                        $url_filtered = preg_replace('/plus.google.com\//','',$url_display);
                        $url_filtered = preg_replace('/\/about$/','',$url_filtered);
                        $url_filtered = preg_replace('/^\+/','', $url_filtered);
                        break;
                    case 'linkedin.com':
                        $icon = 'fa-linkedin-square';
                        break;
                    case 'instagram.com':
                        $icon = 'fa-instagram';
                        break;
                    case 'untappd.com':
                        $icon = 'fa-beer';
                        break;
                    case 'xing.com':
                        $icon = 'fa-xing-square';
                        break;
                    case 'last.fm':
                        $icon = 'fa-lastfm-square';
                        break;
                    case 'keybase.io':
                        $icon = 'fa-keybase';
                        break;
                    case 'about.me':
                        $icon = 'fa-user-circle';
                        break;
                    case 'paypal.me':
                        $icon = 'fa-paypal';
                        $url_filtered = preg_replace('/www.paypal.me\/(\w*).*/','$1',$url_display);
                        break;
                    case 'pinboard.in':
                        $icon = 'fa-bookmark';
                        $url_filtered = str_replace('pinboard.in/u:','',$url_display);
                        $url_filtered = preg_replace('/\/public$/','',$url_filtered);
                        break;
                    case (preg_match('/.*foursquare\.com/', $host) ? true : false):
                        $icon = 'fa-foursquare';
                        break;
                    case (preg_match('/.*newsblur\.com/', $host) ? true : false):
                        $icon = 'fa-newspaper-o';
                        $url_filtered = str_replace('.newsblur.com','',$url_display);
                        break;
                    case 'flickr.com':
                        $icon = 'fa-flickr';
                        $url_filtered = preg_replace('/www.flickr.com\/photos\/(\w*).*/','$1',$url_display);
                        $url_filtered = preg_replace('/www.flickr.com\/people\/(\w*).*/','$1',$url_display);
                        break;
                    case 'unsplash.com':
                        $icon = 'fa-unsplash';
                        break;
                    case 'strava.com':
                        $icon = 'fa-bicycle';
                        $url_filtered = preg_replace('/www.strava.com\/athletes\/(\w*).*/','$1',$url_display);
                        break;
                    case 'leanpub.com':
                        $icon = 'fa-leanpub';
                        $url_filtered = preg_replace('/leanpub.com\/u\/(\w*).*/','$1',$url_display);
                        break;
                    case 'goodreads.com':
                        $icon = 'fa-book';
                        break;
                    case 'telegram.me':
                        $icon = 'fa-telegram';
                        break;
                    case 'zotero.org':
                        $icon = 'fa-zotero';
                        break;
                    case 'reddit.com':
                        $icon = 'fa-reddit';
                        $url_filtered = preg_replace('/www.reddit.com\/user\/(\w*).*/','$1',$url_display);
                        break;
                    case 'soundcloud.com':
                        $icon = 'fa-soundcloud';
                        break;
                    case 'medium.com':
                        $icon = 'fa-medium';
                        break;
                    case 'vimeo.com':
                        $icon = 'fa-vimeo';
                        break;
                    case '500px.com':
                        $icon = 'fa-500px';
                        break;
                    case 'youtube.com':
                        $icon = 'fa-youtube-square';
                        $url_filtered = preg_replace('/www.youtube.com\/user\/(\w*).*/','$1',$url_display);
                        break;
                    case 'snapchat.com':
                        $icon = 'fa-snapchat-square';
                        $url_filtered = preg_replace('/www.snapchat.com\/add\/(\w*).*/','$1',$url_display);
                        break;
                    case 'bible.com':
                        $icon = 'fa-bible';
                        $url_filtered = preg_replace('/www.bible.com\/users\/(\w*).*/','$1',$url_display);
                        break;
                    case 'anchor.fm':
                        $icon = 'fa-anchor';
                        break;
                    case 'pinterest.com':
                        $icon = 'fa-pinterest-square';
                        break;
                    case (preg_match('/.*wordpress\.com/', $host) ? true : false):
                        $icon = 'fa-wordpress';
                        $url_filtered = str_replace('.wordpress.com','',$url_display);
                        break;
                    case (preg_match('/.*tumblr\.com/', $host) ? true : false):
                        $icon = 'fa-tumblr-square';
                        $url_filtered = str_replace('.tumblr.com','',$url_display);
                        break;
                    case 'gitshowcase.com':
                        $icon = 'fa-git-square';
                        break;
                    case 'behance.net':
                        $icon = 'fa-behance-square';
                        break;
                    case 'micro.blog':
                        $icon = 'fa-rss-square';
                        break;
                    case 'cash.me':
                    case 'venmo.com':
                        $icon = 'fa-money';
                        break;
                    case 'upcoming.org':
                        $icon = 'fa-calendar';
                        break;
                    case 'periscope.tv':
                        $icon = 'fa-map-marker';
                        break;
                    case 'ello.co':
                        $icon = 'fa-circle';
                        break;
                    case 'vine.co':
                        $icon = 'fa-vine';
                        break;
                    case 'producthunt.com':
                        $icon = 'fa-product-hunt';
                        break;
                    case 'del.icio.us':
                        $icon = 'fa-delicious';
                        break;
                    case 'codepen.io':
                        $icon = 'fa-codepen';
                        break;
                    case 'mixcloud.com':
                        $icon = 'fa-mixcloud';
                        break;
                    case 'stackoverflow.com':
                        $icon = 'fa-stack-overflow';
                        break;
                    case 'twitch.tv':
                        $icon = 'fa-twitch';
                        break;

                    default:
                        $icon = 'fa-external-link';
                        $url_filtered = $url_display;
                        break;
                }

                $url_display = $url_filtered;

                $scheme = parse_url($url, PHP_URL_SCHEME);
                switch ($scheme) {
                    case 'mailto' :
                        $icon = 'fa-envelope-square'; $url_display = str_replace('mailto:', '', $url_display); $h_card = 'u-email';
                        break;
                    case 'sms' :
                        $icon = 'fa-mobile'; $url_display = str_replace('sms:', '', $url_display); $h_card = 'p-tel';
                        break;
                    case 'sip' :
                    case 'tel' :
                        $icon = 'fa-phone-square'; $url_display = str_replace('tel:', '', $url_display); $h_card = 'p-tel';
                        break;
                    case 'skype' :
                        $icon = 'fa-skype'; $url_display = str_replace('skype:', '', $url_display); $h_card = 'p-skype';
                        break;
                    case 'bitcoin':
                        $icon = 'fa-btc'; $url_display = str_replace('bitcoin:', '', $url_display); $h_card = 'p-bitcoin';
                        break;
                    case 'facetime' :
                        $icon = 'fa-video-camera'; $url_display = str_replace('facetime:', '', $url_display); $h_card = 'p-facetime';
                        break;
                }

?>
        <p class="url-container">
          <i class="fa <?=$icon?> fa-fw" aria-hidden="true"></i>
          <a href="<?=htmlspecialchars($url)?>" rel="me" class="<?=$h_card; ?>"><?=str_replace('http://','',str_replace('https://','', strip_tags($url_display)))?></a>
        </p>
<?php
            }
        }
    }
?>
