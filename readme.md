DubDub
======

WWDC tickets are hard to come by.  DubDub sends you a push notification whenever the SHA1 hash of the http://developer.apple.com/wwdc page changes.  With DubDub, there may be some false positives.  That's alright though.

Requirements
------------

* $99 Apple iOS Developer account.
* Xcode
* iPhone/iPod Touch/iPad
* Something (preferably a computer) that can run PHP.

Installation
------------

The installation instructions are a little long.

TL;DR: Setup provisioning profile, setup push notification, setup something to call `Web/php/dubdub.php` every few minutes.

1. Download DubDub.
2. Visit http://developer.apple.com/devcenter/ios/index.action.
3. Open the iOS Provisioning Portal.
4. Open the App IDs section.
5. Click "New App ID" and create a non-wildcard App ID.
6. Open the "Provisioning" section.
7. Under the "Development" tab, click "New Profile".
8. Create a new provisioning profile.  Make sure that your device is selected in the Devices section.  If not, add it to the Provisioning Portal and start again at step 7.
9. Go back to App IDs"and click "Configure" next to the App ID you created in step 5.
10. Beside "Development Push SSL Certificate", click "Configure".
11. Follow the instructions and ultimately download the Development Push SSL Certificate.
12. Install this certificate in Keychain Access, by double clicking it.
13. Create the `apns-dev.pem` file by following the instructions here: http://blog.serverdensity.com/how-to-build-an-apple-push-notification-provider-server-tutorial
14. Move the newly created `apns-dev.pem` file into the `Web/certs` folder of DubDub.
15. Open the DubDub iOS project which is located in the `iOS` folder of DubDub.
16. Build the project on your device using the provisioning profile that you created in step 8.
17. Copy the quoted NSData which appears in the log after you have enabled push notifications in the application.
18. Open `Web/php/dd_push.php` and add this copied NSData to the tokens array.

Now that everything is setup, we just need to be able to run the `Web/php/dubdub.php` file every few minutes.  For this example, I'll choose every ten minutes and run DubDub using crontab:

1. Open crontab by typing `crontab -e`.
2. Add an entry to run DubDub: `0,10,20,30,40,50 * * * * /usr/local/bin/php /Users/You/pathtodubdub/Web/php/dubdub.php`
3. Verify that DubDub is running by visiting `Web/index.php` and checking the date and hash.

License
-------

There isn't one.  Use everything as you please.