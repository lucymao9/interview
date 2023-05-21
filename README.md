# Discription
--------------
This is an interview project on Symfony framework with Doctrine bundle and it's enviroment is laravel homestead.It impliments a simple user search API in RESTful style.

## More details
--------------
* php version:8.1
* symfony framework version:6.1
* laravel homestead version:9.x
* vagrant version:2.3.5
--------------

ps: I'm new one to symfony world(only viewed symfony3 code before).I'm not sure if i code it at symfony standard.And i just seemingly made the project run correctly.
There is something wrong when i install vargrant, and i found this issue [#13157](https://github.com/hashicorp/vagrant/issues/13157).Luckly,it works.But i met a new problem when i create symfony application using composer.[curl: (60) SSL: no alternative certificate subject name matches target host name](https://stackoverflow.com/questions/63101263/curl-cacert-error-curl-60-ssl-no-alternative-certificate-subject-name-mat)  I downloaded certification, changed host, shut down fire wall and disable composer tls.Didn't work.I can't get full symfony skeleton until i uploaded some of symfony/flex files to my own server and change the endpoint in composer.json. So i have no idea if my application is a complete symfony application. At least it seems running normally.
