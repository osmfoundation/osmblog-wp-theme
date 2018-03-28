# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "bento/ubuntu-16.04"

  config.vm.network "forwarded_port", guest: 80, host: 8080 # apache

  $script = <<-SCRIPT
    set -o verbose
    set -e

    sudo apt-get update

    sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password MySuperPassword'
    sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password MySuperPassword'
    sudo apt-get update
    sudo apt-get install -y mysql-server

    sudo apt-get install -y mysql-client mysql-server

    sudo apt-get install -y apache2 apache2-utils
    sudo apt-get install -y php7.0 php7.0-mysql libapache2-mod-php7.0 php7.0-cli php7.0-cgi php7.0-gd

    sudo systemctl enable apache2
    sudo systemctl start apache2

    wget -c http://wordpress.org/latest.tar.gz
    tar -xzvf latest.tar.gz
    sudo mkdir /var/www/html/wp
    sudo rsync -av wordpress/* /var/www/html/wp

    sudo chown -R www-data:www-data /var/www/html/
    sudo chmod -R 755 /var/www/html/

    echo "CREATE DATABASE wp_myblog; \
          GRANT ALL PRIVILEGES ON wp_myblog.* TO 'root'@'localhost' IDENTIFIED BY 'MySuperPassword';
          FLUSH PRIVILEGES;\
    " | mysql --user=root --password=MySuperPassword --host=localhost

    sudo mv /var/www/html/wp/wp-config-sample.php /var/www/html/wp/wp-config.php

    sudo sed -i 's/database_name_here/wp_myblog/g' /var/www/html/wp/wp-config.php
    sudo sed -i 's/username_here/root/g' /var/www/html/wp/wp-config.php
    sudo sed -i 's/password_here/MySuperPassword/g' /var/www/html/wp/wp-config.php

    
    sudo mkdir /var/www/html/wp/wp-content/themes/osmblog-wp-theme
    echo "Should do symlink and configure apache accordingly, but for now... copy"
    sudo cp -r /vagrant/* /var/www/html/wp/wp-content/themes/osmblog-wp-theme
    
    sudo systemctl restart apache2.service
    sudo systemctl restart mysql.service

    
    echo "OK. Check out http://0.0.0.0:8080/wp/"
    echo "Do the wordpress set-up, then activate the osmf theme (TODO:automate that bit too)"
    
    
    # end of bash script
  SCRIPT
  config.vm.provision "shell", inline: $script, privileged: false
end
