FROM debian:stretch-slim
MAINTAINER M.H Mamoru Hashimoto <you@example.com>

# timezone
ENV TZ=Asia/Tokyo
RUN ln -fs /usr/share/zoneinfo/Asia/Tokyo /etc/localtime \
&& dpkg-reconfigure --frontend noninteractive tzdata

# initialize
EXPOSE 80
WORKDIR /app
RUN groupadd --gid 1000 app \
  && useradd --uid 1000 --gid app --shell /bin/bash --create-home app

RUN set -eux; \
	{ \
		echo 'Package: php*'; \
		echo 'Pin: release *'; \
		echo 'Pin-Priority: -1'; \
	} > /etc/apt/preferences.d/no-debian-php

ENV PHPIZE_DEPS autoconf dpkg-dev file g++ gcc libc-dev make pkg-config re2c
RUN apt-get update \
  && apt-get install -y $PHPIZE_DEPS ca-certificates curl xz-utils --no-install-recommends \
  && rm -r /var/lib/apt/lists/*

ENV PHP_INI_DIR /usr/local/etc/php
RUN mkdir -p $PHP_INI_DIR/conf.d

# install Apache
RUN apt-get update \
	&& apt-get install -y --no-install-recommends apache2 \
	&& rm -rf /var/lib/apt/lists/*

ENV APACHE_CONFDIR /etc/apache2
ENV APACHE_ENVVARS $APACHE_CONFDIR/envvars

RUN set -ex \
	&& sed -ri 's/^export ([^=]+)=(.*)$/: ${\1:=\2}\nexport \1/' "$APACHE_ENVVARS" \
	&& . "$APACHE_ENVVARS" \
	&& for dir in \
		"$APACHE_LOCK_DIR" \
		"$APACHE_RUN_DIR" \
		"$APACHE_LOG_DIR" \
		/var/www/html \
	; do \
		rm -rvf "$dir" && mkdir -p "$dir" \
      && chown -R "$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$dir"; \
	done

RUN a2dismod mpm_event && a2enmod mpm_prefork && a2enmod rewrite

RUN set -ex \
	&& . "$APACHE_ENVVARS" \
	&& ln -sfT /dev/stderr "$APACHE_LOG_DIR/error.log" \
	&& ln -sfT /dev/stdout "$APACHE_LOG_DIR/access.log" \
	&& ln -sfT /dev/stdout "$APACHE_LOG_DIR/other_vhosts_access.log"

RUN { \
		echo '<FilesMatch \.php$>'; \
		echo '\tSetHandler application/x-httpd-php'; \
		echo '</FilesMatch>'; \
		echo; \
		echo 'DirectoryIndex disabled'; \
		echo 'DirectoryIndex index.php index.html'; \
		echo; \
		echo '<Directory /var/www/>'; \
		echo '\tOptions FollowSymLinks'; \
		echo '\tAllowOverride All'; \
		echo '</Directory>'; \
	} | tee "$APACHE_CONFDIR/conf-available/docker-php.conf" \
	&& a2enconf docker-php

ENV PHP_EXTRA_BUILD_DEPS apache2-dev
ENV PHP_EXTRA_CONFIGURE_ARGS --with-apxs2

# install PHP
ENV PHP_CFLAGS="-fstack-protector-strong -fpic -fpie -O2"
ENV PHP_CPPFLAGS="$PHP_CFLAGS"
ENV PHP_LDFLAGS="-Wl,-O1 -Wl,--hash-style=both -pie"

ENV PHP_VERSION 7.2.6
ENV PHP_URL="https://secure.php.net/get/php-7.2.6.tar.xz/from/this/mirror" \
  PHP_ASC_URL="https://secure.php.net/get/php-7.2.6.tar.xz.asc/from/this/mirror"
ENV PHP_SHA256="1f004e049788a3effc89ef417f06a6cf704c95ae2a718b2175185f2983381ae7" PHP_MD5=""

RUN set -xe; \
	fetchDeps='wget'; \
	if ! command -v gpg > /dev/null; then \
		fetchDeps="$fetchDeps dirmngr gnupg"; \
	fi; \
	apt-get update; \
	apt-get install -y --no-install-recommends $fetchDeps; \
	rm -rf /var/lib/apt/lists/*; \
	mkdir -p /usr/src; \
	cd /usr/src; \
	wget -O php.tar.xz "$PHP_URL"; \
	if [ -n "$PHP_SHA256" ]; then \
		echo "$PHP_SHA256 *php.tar.xz" | sha256sum -c -; \
	fi; \
	if [ -n "$PHP_MD5" ]; then \
		echo "$PHP_MD5 *php.tar.xz" | md5sum -c -; \
	fi; \
	if [ -n "$PHP_ASC_URL" ]; then \
		wget -O php.tar.xz.asc "$PHP_ASC_URL"; \
    export GNUPGHOME="$(mktemp -d)"; \
		for key in \
      1729F83938DA44E27BA0F4D3DBDB397470D12172 \
      B1B44D8F021E4E2D6021E995DC9FF8D3EE5AF27F \
    ; do \
      gpg --keyserver hkp://ipv4.pool.sks-keyservers.net --recv-keys "$key" \
      || gpg --keyserver ha.pool.sks-keyservers.net --recv-keys "$key" \
      || gpg --keyserver keyserver.pgp.com --recv-keys "$key" \
      || gpg --keyserver pool.sks-keyservers.net --recv-keys "$key" \
      || gpg --keyserver pgp.mit.edu --recv-keys "$key" \
      || gpg --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys "$key" \
    ; done; \
    gpg --batch --verify php.tar.xz.asc php.tar.xz; \
    rm -rf "$GNUPGHOME"; \
	fi; \
	apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false $fetchDeps

COPY docker-php-source /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-php-source

RUN set -eux; \
	savedAptMark="$(apt-mark showmanual)"; \
	apt-get update; \
	apt-get install -y --no-install-recommends libargon2-0-dev libcurl4-openssl-dev \
		libedit-dev libsodium-dev libsqlite3-dev libssl-dev libxml2-dev zlib1g-dev \
		${PHP_EXTRA_BUILD_DEPS:-}; \
	rm -rf /var/lib/apt/lists/*; \
	export CFLAGS="$PHP_CFLAGS" CPPFLAGS="$PHP_CPPFLAGS" LDFLAGS="$PHP_LDFLAGS"; \
	docker-php-source extract; \
	cd /usr/src/php; \
	gnuArch="$(dpkg-architecture --query DEB_BUILD_GNU_TYPE)"; \
	debMultiarch="$(dpkg-architecture --query DEB_BUILD_MULTIARCH)"; \
	if [ ! -d /usr/include/curl ]; then \
		ln -sT "/usr/include/$debMultiarch/curl" /usr/local/include/curl; \
	fi; \
	./configure --build="$gnuArch" --with-config-file-path="$PHP_INI_DIR" \
		--with-config-file-scan-dir="$PHP_INI_DIR/conf.d" \
    --enable-option-checking=fatal \
		--disable-cgi \
    --with-mhash \
    --enable-ftp \
    --enable-mbstring \
    --enable-mysqlnd \
    --with-pdo-mysql \
		--with-password-argon2 \
    --with-sodium=shared \
    --with-curl \
    --with-libedit \
    --with-openssl \
		--with-zlib $(test "$gnuArch" = 's390x-linux-gnu' && echo '--without-pcre-jit') \
		--with-libdir="lib/$debMultiarch" ${PHP_EXTRA_CONFIGURE_ARGS:-}; \
	make -j "$(nproc)"; \
	make install; \
	find /usr/local/bin /usr/local/sbin \
    -type f -executable -exec strip --strip-all '{}' + || true; \
	make clean; \
	cd /; \
	docker-php-source delete; \
	apt-mark auto '.*' > /dev/null; \
	[ -z "$savedAptMark" ] || apt-mark manual $savedAptMark; \
	find /usr/local -type f -executable -exec ldd '{}' ';' \
		| awk '/=>/ { print $(NF-1) }' \
		| sort -u \
		| xargs -r dpkg-query --search \
		| cut -d: -f1 \
		| sort -u \
		| xargs -r apt-mark manual; \
	apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false; \
	php --version; \
	pecl update-channels; \
	rm -rf /tmp/pear ~/.pearrc

COPY docker-php-ext-* docker-php-entrypoint /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-php-ext-* /usr/local/bin/docker-php-entrypoint \
  && docker-php-ext-enable sodium

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV BUILD_DEPS="autoconf file g++ gcc libc-dev make pkg-config re2c"
ENV LIB_DEPS="zlib1g-dev"
ENV ICU_RELEASE=61.1
ENV CXXFLAGS "--std=c++0x"

RUN apt-get update && apt-get install -y --no-install-recommends $BUILD_DEPS $LIB_DEPS \
  && rm -rf /var/lib/apt/lists/* \
  && echo "date.timezone=Asia/Tokyo" >> $PHP_INI_DIR/php.ini \
  && docker-php-ext-install zip \
  && cd /tmp && curl -Ls http://download.icu-project.org/files/icu4c/$ICU_RELEASE/icu4c-$(echo $ICU_RELEASE | tr '.' '_')-src.tgz > icu4c-src.tgz \
  && cd /tmp && tar xzf icu4c-src.tgz && cd /tmp/icu/source \
  && sed -i'' 's/define U_USING_ICU_NAMESPACE 0/define U_USING_ICU_NAMESPACE 1/g' common/unicode/uversion.h \
  && ./configure && make && make install \
  && rm -rf /tmp/icu /tmp/icu4c-src.tgz \
  && docker-php-ext-configure intl && docker-php-ext-install intl \
  && curl -Ls https://getcomposer.org/composer.phar > /usr/local/bin/composer \
  && chmod +x /usr/local/bin/composer \
  && apt-get purge -y --auto-remove $BUILD_DEPS

ENTRYPOINT ["docker-php-entrypoint"]

COPY apache2-foreground /usr/local/bin/
RUN chmod +x /usr/local/bin/apache2-foreground

# install nodejs
ENV NODE_VERSION 10.4.1
RUN buildDeps='dirmngr gnupg' \
  && ARCH= && dpkgArch="$(dpkg --print-architecture)" \
  && case "${dpkgArch##*-}" in \
    amd64) ARCH='x64';; \
    ppc64el) ARCH='ppc64le';; \
    s390x) ARCH='s390x';; \
    arm64) ARCH='arm64';; \
    armhf) ARCH='armv7l';; \
    i386) ARCH='x86';; \
    *) echo "unsupported architecture"; exit 1 ;; \
  esac \
  && apt-get update && apt-get install -y $buildDeps --no-install-recommends\
  && rm -rf /var/lib/apt/lists/* \
# gpg keys listed at https://github.com/nodejs/node#release-team
  && set -ex \
  && for key in \
    94AE36675C464D64BAFA68DD7434390BDBE9B9C5 \
    B9AE9905FFD7803F25714661B63B535A4C206CA9 \
    77984A986EBC2AA786BC0F66B01FBB92821C587A \
    56730D5401028683275BD23C23EFEFE93C4CFFFE \
    71DCFD284A79C3B38668286BC97EC7A07EDE3FC1 \
    FD3A5288F042B6850C66B31F09FE44734EB7990E \
    8FCCA13FEF1D0C2E91008E09770F7A9A5AE15600 \
    C4F0DFFF4E8C1A8236409D08E73BC641CC11F4C8 \
    DD8F2338BAE7501E3DD5AC78C273792F7D83545D \
  ; do \
    gpg --keyserver hkp://ipv4.pool.sks-keyservers.net --recv-keys "$key" \
    || gpg --keyserver ha.pool.sks-keyservers.net --recv-keys "$key" \
    || gpg --keyserver keyserver.pgp.com --recv-keys "$key" \
    || gpg --keyserver pool.sks-keyservers.net --recv-keys "$key" \
    || gpg --keyserver pgp.mit.edu --recv-keys "$key" \
    || gpg --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys "$key" \
  ; done \
  && curl -SLO \
    "https://nodejs.org/dist/v$NODE_VERSION/node-v$NODE_VERSION-linux-$ARCH.tar.xz" \
  && curl -SLO --compressed "https://nodejs.org/dist/v$NODE_VERSION/SHASUMS256.txt.asc" \
  && gpg --batch --decrypt --output SHASUMS256.txt SHASUMS256.txt.asc \
  && grep " node-v$NODE_VERSION-linux-$ARCH.tar.xz\$" SHASUMS256.txt | sha256sum -c - \
  && tar -xJf "node-v$NODE_VERSION-linux-$ARCH.tar.xz" -C /usr/local \
    --strip-components=1 --no-same-owner \
  && rm "node-v$NODE_VERSION-linux-$ARCH.tar.xz" SHASUMS256.txt.asc SHASUMS256.txt \
  && ln -s /usr/local/bin/node /usr/local/bin/nodejs \
  && apt-get purge -y --auto-remove $buildDeps

# install yarn
ENV YARN_VERSION 1.8.0
RUN set -ex \
  && buildDeps='dirmngr gnupg' \
  && apt-get update && apt-get install -y $buildDeps --no-install-recommends\
  && rm -rf /var/lib/apt/lists/* \
  && for key in \
    6A010C5166006599AA17F08146C2130DFD2497F5 \
  ; do \
    gpg --keyserver hkp://ipv4.pool.sks-keyservers.net --recv-keys "$key" \
    || gpg --keyserver ha.pool.sks-keyservers.net --recv-keys "$key" \
    || gpg --keyserver keyserver.pgp.com --recv-keys "$key" \
    || gpg --keyserver pool.sks-keyservers.net --recv-keys "$key" \
    || gpg --keyserver pgp.mit.edu --recv-keys "$key" \
    || gpg --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys "$key" \
  ; done \
  && curl -fSLO --compressed \
    "https://yarnpkg.com/downloads/$YARN_VERSION/yarn-v$YARN_VERSION.tar.gz" \
  && curl -fSLO --compressed \
    "https://yarnpkg.com/downloads/$YARN_VERSION/yarn-v$YARN_VERSION.tar.gz.asc" \
  && gpg --batch --verify yarn-v$YARN_VERSION.tar.gz.asc yarn-v$YARN_VERSION.tar.gz \
  && mkdir -p /opt \
  && tar -xzf yarn-v$YARN_VERSION.tar.gz -C /opt/ \
  && ln -s /opt/yarn-v$YARN_VERSION/bin/yarn /usr/local/bin/yarn \
  && ln -s /opt/yarn-v$YARN_VERSION/bin/yarnpkg /usr/local/bin/yarnpkg \
  && rm yarn-v$YARN_VERSION.tar.gz.asc yarn-v$YARN_VERSION.tar.gz \
  && apt-get purge -y --auto-remove $buildDeps

# install apps
RUN apt-get update && apt-get install -y git \
  && rm -rf /var/lib/apt/list/* \
  && cd /app \
  && git clone https://github.com/S035779/chouhi.git

COPY .env /app/chouhi/config

RUN buildDeps='python build-essential' \
  && apt-get update && apt-get install -y $buildDeps \
  && rm -rf /var/lib/apt/list/* \
  && cd /app/chouhi \
  && rm package-lock.json \
  && yarn install \
  && chown -R app:app /app \
  && apt-get purge -y --auto-remove $buildDeps

USER app
RUN cd /app/chouhi && composer install

USER root
WORKDIR /var/www/html
CMD ["apache2-foreground"]
