<?php
  namespace IdnoPlugins\ShortProfile {
    class Main extends \Idno\Common\Plugin {
      function registerPages() {
        \Idno\Core\Idno::site()->template()->replaceTemplate('entity/User/profile/fields','shortprofile/fields');
      }    
    } 
  }
