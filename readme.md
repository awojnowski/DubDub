DubDub
======

WWDC tickets are hard to come by.  DubDub sends you a push notification whenever the SHA1 hash of the http://developer.apple.com/wwdc page changes.  Although there will be some false positives, you will probably receive a notification as soon as the page changes.

Requirements
------------

* $99 Apple iOS Developer account.
* Xcode
* iPhone/iPod Touch/iPad
* Something (preferably a computer) that can run PHP.

Installation
------------

1. Download DubDub.
2. Visit http://developer.apple.com/devcenter/ios/index.action.
3. Open the iOS Provisioning Portal.
4. Open the App IDs section.
5. Click "New App ID" and create a non-wildcard App ID.
6. Open the "Provisioning" section.
7. Under the "Development" tab, click "New Profile".
8. Create a new provisioning profile.  Make sure that your device is selected in the Devices section.  If not, add it to the Provisioning Portal and start again at step 7.
9. Go back to App IDs"and click "Configure" next to the App ID you created in step 5.
10. Next to Development Push SSL Certificate, click "Configure".
11. Follow the instructions and ultimately download the Development Push SSL Certificate.
12. Install this certificate in Keychain Access, by double clicking it.
13. Create the `apns-dev.pem` file by following the instructions below (thanks to http://blog.serverdensity.com/how-to-build-an-apple-push-notification-provider-server-tutorial/):
> 1. Launch Keychain Assistant from your local Mac and from the login keychain, filter by the Certificates category. You will see an expandable option called “Apple Development Push Services”
> 2. Expand this option then right click on “Apple Development Push Services” > Export “Apple Development Push Services ID123″. Save this as apns-dev-cert.p12 file somewhere you can access it.
> 3. Do the same again for the “Private Key” that was revealed when you expanded “Apple Development Push Services” ensuring you save it as apns-dev-key.p12 file.
> 4. These files now need to be converted to the PEM format by executing this command from the terminal:
>     openssl pkcs12 -clcerts -nokeys -out apns-dev-cert.pem -in apns-dev-cert.p12
>     openssl pkcs12 -nocerts -out apns-dev-key.pem -in apns-dev-key.p12
> If you wish to remove the passphrase, either do not set one when exporting/converting or execute:
>     openssl rsa -in apns-dev-key.pem -out apns-dev-key-noenc.pem
> 5. Finally, you need to combine the key and cert files into a apns-dev.pem file we will use when connecting to APNS:
>     cat apns-dev-cert.pem apns-dev-key-noenc.pem > apns-dev.pem
14. Move the newly created `apns-dev.pem` file into the `Web/certs` folder of DubDub.