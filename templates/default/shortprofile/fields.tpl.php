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
                        $icon = 'fab fa-twitter';
                        break;
                    case 'github.com':
                        $icon = 'fab fa-github';
                        break;
                    case 'fb.com':
                    case 'facebook.com':
                        $icon = 'fab fa-facebook';
                        break;
                    case 'plus.google.com':
                        $icon = 'fab fa-google-plus';
                        $url_filtered = preg_replace('/plus.google.com\//','',$url_display);
                        $url_filtered = preg_replace('/\/about$/','',$url_filtered);
                        $url_filtered = preg_replace('/^\+/','', $url_filtered);
                        break;
                    case 'linkedin.com':
                        $icon = 'fab fa-linkedin';
                        break;
                    case 'instagram.com':
                        $icon = 'fab fa-instagram';
                        break;
                    case 'untappd.com':
                        $icon = 'fas fa-beer';
                        break;
                    case 'xing.com':
                        $icon = 'fab fa-xing';
                        break;
                    case 'last.fm':
                        $icon = 'fab fa-lastfm';
                        break;
                    case 'keybase.io':
                        $icon = 'fas fa-key';
                        break;
                    case 'about.me':
                        $icon = 'fas fa-user';
                        break;
                    case 'paypal.me':
                        $icon = 'fab fa-paypal';
                        $url_filtered = preg_replace('/www.paypal.me\/(\w*).*/','$1',$url_display);
                        break;
                    case 'pinboard.in':
                        $icon = 'fas fa-bookmark';
                        $url_filtered = str_replace('pinboard.in/u:','',$url_display);
                        $url_filtered = preg_replace('/\/public$/','',$url_filtered);
                        break;
                    case (preg_match('/.*foursquare\.com/', $host) ? true : false):
                        $icon = 'fab fa-foursquare';
                        break;
                    case (preg_match('/.*newsblur\.com/', $host) ? true : false):
                        $icon = 'far fa-newspaper';
                        $url_filtered = str_replace('.newsblur.com','',$url_display);
                        break;
                    case 'flickr.com':
                        $icon = 'fab fa-flickr';
                        $url_filtered = preg_replace('/www.flickr.com\/photos\/(\w*).*/','$1',$url_display);
                        $url_filtered = preg_replace('/www.flickr.com\/people\/(\w*).*/','$1',$url_display);
                        break;
                    case 'unsplash.com':
                        $icon = 'fas fa-image';
                        break;
                    case 'strava.com':
                        $icon = 'fab fa-strava';
                        $url_filtered = preg_replace('/www.strava.com\/athletes\/(\w*).*/','$1',$url_display);
                        break;
                    case 'leanpub.com':
                        $icon = 'fab fa-leanpub';
                        $url_filtered = preg_replace('/leanpub.com\/u\/(\w*).*/','$1',$url_display);
                        break;
                    case 'goodreads.com':
                        $icon = 'fas fa-book';
                        break;
                    case 'telegram.me':
                        $icon = 'fab fa-telegram';
                        break;
                    case 'zotero.org':
                        $icon = 'fas fa-bookmark';
                        break;
                    case 'reddit.com':
                        $icon = 'fab fa-reddit';
                        $url_filtered = preg_replace('/www.reddit.com\/user\/(\w*).*/','$1',$url_display);
                        break;
                    case 'soundcloud.com':
                        $icon = 'fab fa-soundcloud';
                        break;
                    case 'medium.com':
                        $icon = 'fab fa-medium';
                        break;
                    case 'vimeo.com':
                        $icon = 'fab fa-vimeo';
                        break;
                    case '500px.com':
                        $icon = 'fab fa-500px';
                        break;
                    case 'youtube.com':
                        $icon = 'fab fa-youtube';
                        $url_filtered = preg_replace('/www.youtube.com\/user\/(\w*).*/','$1',$url_display);
                        break;
                    case 'snapchat.com':
                        $icon = 'fab fa-snapchat';
                        $url_filtered = preg_replace('/www.snapchat.com\/add\/(\w*).*/','$1',$url_display);
                        break;
                    case 'bible.com':
                        $icon = 'fas fa-bible';
                        $url_filtered = preg_replace('/www.bible.com\/users\/(\w*).*/','$1',$url_display);
                        break;
                    case 'anchor.fm':
                        $icon = 'fas fa-anchor';
                        break;
                    case 'pinterest.com':
                        $icon = 'fab fa-pinterest';
                        break;
                    case (preg_match('/.*wordpress\.com/', $host) ? true : false):
                        $icon = 'fab fa-wordpress';
                        $url_filtered = str_replace('.wordpress.com','',$url_display);
                        break;
                    case (preg_match('/.*tumblr\.com/', $host) ? true : false):
                        $icon = 'fab fa-tumblr';
                        $url_filtered = str_replace('.tumblr.com','',$url_display);
                        break;
                    case 'gitshowcase.com':
                        $icon = 'fab fa-github';
                        break;
                    case 'behance.net':
                        $icon = 'fab fa-behance';
                        break;
                    case 'micro.blog':
                        $icon = 'fas fa-rss';
                        break;
                    case 'cash.me':
                        $icon = 'fas fa-money-bill';
                        break;
                    case 'venmo.com':
                        $icon = 'fas fa-money-bill';
                        break;
                    case 'upcoming.org':
                        $icon = 'fas fa-calendar-day';
                        break;
                    case 'periscope.tv':
                        $icon = 'fab fa-periscope';
                        break;
                    case 'ello.co':
                        $icon = 'fab fa-ello';
                        break;
                    case 'vine.co':
                        $icon = 'fab fa-vine';
                        break;
                    case 'producthunt.com':
                        $icon = 'fab fa-product-hunt';
                        break;
                    case 'del.icio.us':
                        $icon = 'fab fa-delicious';
                        break;
                    case 'codepen.io':
                        $icon = 'fab fa-codepen';
                        break;
                    case 'mixcloud.com':
                        $icon = 'fab fa-mixcloud';
                        break;
                    case 'stackoverflow.com':
                        $icon = 'fab fa-stack-overflow';
                        break;
                    case 'twitch.tv':
                        $icon = 'fab fa-twitch';
                        break;


                    default:
                        $icon = 'fas fa-link';
                        $url_filtered = $url_display;
                        break;
                }

                $url_display = $url_filtered;

                $scheme = parse_url($url, PHP_URL_SCHEME);
                switch ($scheme) {
                    case 'mailto' :
                        $icon = 'fas fa-envelope'; $url_display = str_replace('mailto:', '', $url_display); $h_card = 'u-email';
                        break;
                    case 'sms' :
                        $icon = 'fas fa-mobile'; $url_display = str_replace('sms:', '', $url_display); $h_card = 'p-tel';
                        break;
                    case 'sip' :
                    case 'tel' :
                        $icon = 'fas fa-phone'; $url_display = str_replace('tel:', '', $url_display); $h_card = 'p-tel';
                        break;
                    case 'skype' :
                        $icon = 'fab fa-skype'; $url_display = str_replace('skype:', '', $url_display); $h_card = 'p-skype';
                        break;
                    case 'bitcoin':
                        $icon = 'fab fa-btc'; $url_display = str_replace('bitcoin:', '', $url_display); $h_card = 'p-bitcoin';
                        break;
                    case 'facetime' :
                        $icon = 'fas fa-video'; $url_display = str_replace('facetime:', '', $url_display); $h_card = 'p-facetime';
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
