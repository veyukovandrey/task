FROM ubuntu


ENV TZ=Europe/Kiev

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get install -qq -y \
	git \
	wget \
	php7.4-fpm \
	php7.4-curl \
	php7.4-cli \
	php-memcache \ 
	php-memcached \
	php7.4-mysql \ 
	php7.4-pgsql \
	php7.4-gd \
	php-imagick \
	php7.4-intl \
	php-xml \
	php-mbstring
	
RUN wget https://get.symfony.com/cli/installer -O - | bash	

VOLUME /home/symfony4.4_console

WORKDIR /home/symfony4.4_console

COPY ./ /home/symfony4.4_console/

EXPOSE 8000
