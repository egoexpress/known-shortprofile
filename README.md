# known-shortprofile

A [Known](http://withknown.com) plugin to clean up the URLs displayed in the profile page. After enabling the plugin,
just the usernames and an appropriate icon from [Font Awesome](https://fontawesome.com/) is shown for the services handled by this plugin.

## How does it look like

When you setup Known, enter some URLs in your profile and then have a look at your profile page. It'll look somewhat like this:

![Without Plugin](https://egoexpress.github.io/known-shortprofile/images/without-plugin.png)

Wow, all those long URLs are kinda messed up.

Here's where this plugin comes in. It shortens the URLs down to the respective usernames (if applicable) and even adds some more icons for the different services.

So, after activating the plugin the profile shown above looks like this:

![With Plugin](https://egoexpress.github.io/known-shortprofile/images/with-plugin.png)

Neat, huh?

## Looks awesome, how do I set it up

### Using composer (preferred)

The plugin is composer-ready. Just go to the directory you're running Known from and execute

    composer require egoexpress/known-shortprofile

Afterwards, activate the plugin in the Web UI (_Site Configuration/Plugins_).

### The old-fashioned way

Switch to the _IdnoPlugins_ directory of your Known installation and clone this repo:

    git clone https://github.com/egoexpress/known-shortprofile.git Shortprofile

Afterwards, activate the plugin as described above.

## Contribution

If you want to add some additional services, feel free to fork the repo and add a pull request afterwards. I'm happy to merge any additional services.
