## Getting Started
Follow the below instructions to have this project setup locally. You wull have to have Vagrant & Virtualbox setup.

Once complete update your hostfile to point to your vm. The go to VM Private Ip/install.php  

### Vagrant
```
vagrant box add ubuntu/xenial64
vagrant init ubuntu/xenial64
vagrant up
vagrant halt
vagrant plugin install vagrant-vbguest
vagrant reload
```

### add HHVM
```
apt-get update
apt-get install software-properties-common apt-transport-https
apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xB4112585D386EB94

add-apt-repository https://dl.hhvm.com/ubuntu
apt-get update
apt-get install hhvm
```

### install nginx
```
sudo apt-get update
sudo apt-get install nginx
```

### enable Nginx HHVM integration
```
sudo /usr/share/hhvm/install_fastcgi.sh
sudo /etc/init.d/hhvm restart
sudo /etc/init.d/nginx restart
```

### update default server block
```
server {
        listen 80 default_server;
        listen [::]:80 default_server ipv6only=on;

        root /var/www/blog;
        index index.html index.htm index.php;

        # Make site accessible from http://localhost/
        server_name localhost;
        include hhvm.conf;

        # Remove trailing slash
        rewrite ^/(.*)/$ /$1 permanent;

        location / {
                try_files $uri $uri/ @rules;
        }

        location @rules {
                rewrite ^/(.*)$ /index.php?controller=$1;
        }

}
```

### restart nginx
```
sudo service nginx restart
```

### install mysql
```
sudo apt-get install mysql-server -y
```

### create a user that connect from anywhere (devbox only)
```
mysql -u root -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '' WITH GRANT OPTION; FLUSH PRIVILEGES;"
```

### Mysql Local Client Connection Details
```
MySQL Host:127.0.0.1
Username:root
Password:password

SSH Host:192.168.33.10
SSH User:vagrant
SSH Key:/Path/To/Vagrant/Private_Key
```



