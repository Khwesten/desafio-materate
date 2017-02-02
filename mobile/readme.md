## Challenge Materate - Mobile 

### To run

Use command line on 'mobile' folder:

- run: 'npm install'

#### on browser

- run: 'gulp'
- in another command prompt, run: 'ionic serve'

__<sub><sup>*If the second step not run, try 'bower install' or install ionic globally: 'npm install -g ionic' and try 
again.</sup></sub>__

#### on device
Your device must be connected on pc (if your device is an LG, you need install drivers to him).

To communicate with the server, you need of an external ip, to solve this, download ngrokio and use this command: 
'ngrok http portNumberOfService' (the default port of laravel is 8000). After them, you copy an url that show on 
console of ngrok and put on file configuration 'www/js/config/constants-config.js' and change return of method getUrl();

- run: 'gulp'
- run: 'cordova platform add android'
- run: 'ionic run android'

*remind, your device need be enabled to dev mode

## License

Open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
