FROM alpine:3.7
MAINTAINER M.H Mamoru Hashimot <you@example.com>

# timezone
RUN apk add --no-cache tzdata \
  && cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime \
  && apk del --purge tzdata

EXPOSE 9000

ENV PHPIZE_DEPS autoconf dpkg-dev dpkg file g++ gcc libc-dev make pkgconf re2c

RUN apk add --no-cache --virtual .persistent-deps ca-certificates curl tar xz libressl
RUN set -x \
  && addgroup -g 82 -S www-data && adduser -u 82 -D -S -G www-data www-data

ENV PHP_INI_DIR /usr/local/etc/php

RUN mkdir -p $PHP_INI_DIR/conf.d

ENV PHP_EXTRA_CONFIGURE_ARGS --enable-fpm --with-fpm-user=www-data --with-fpm-group=www-data \
  --disable-cgi
ENV PHP_CFLAGS="-fstack-protector-strong -fpic -fpie -O2"
ENV PHP_CPPFLAGS="$PHP_CFLAGS"
ENV PHP_LDFLAGS="-Wl,-O1 -Wl,--hash-style=both -pie"
ENV GPG_KEYS 1729F83938DA44E27BA0F4D3DBDB397470D12172 B1B44D8F021E4E2D6021E995DC9FF8D3EE5AF27F

ENV PHP_VERSION 7.2.6
ENV PHP_URL="https://secure.php.net/get/php-7.2.6.tar.xz/from/this/mirror" \
  PHP_ASC_URL="https://secure.php.net/get/php-7.2.6.tar.xz.asc/from/this/mirror"
ENV PHP_SHA256="1f004e049788a3effc89ef417f06a6cf704c95ae2a718b2175185f2983381ae7" PHP_MD5=""

RUN set -xe; \
  apk add --no-cache --virtual .fetch-deps gnupg wget ; \
  mkdir -p /usr/src; cd /usr/src; wget -O php.tar.xz "$PHP_URL"; \
  if [ -n "$PHP_SHA256" ]; then \
    echo "$PHP_SHA256 *php.tar.xz" | sha256sum -c -; \
  fi; \
  if [ -n "$PHP_MD5" ]; then \
    echo "$PHP_MD5 *php.tar.xz" | md5sum -c -; \
  fi; \
  if [ -n "$PHP_ASC_URL" ]; then \
    wget -O php.tar.xz.asc "$PHP_ASC_URL"; export GNUPGHOME="$(mktemp -d)"; \

    for key in $GPG_KEYS; do \
      gpg --keyserver hkp://ipv4.pool.sks-keyservers.net --recv-keys "$key" \
      || gpg --keyserver ha.pool.sks-keyservers.net --recv-keys "$key" \
      || gpg --keyserver keyserver.pgp.com --recv-keys "$key" \
      || gpg --keyserver pool.sks-keyservers.net --recv-keys "$key" \
      || gpg --keyserver pgp.mit.edu --recv-keys "$key" \
      || gpg --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys "$key" \
    ; done; \

    gpg --batch --verify php.tar.xz.asc php.tar.xz; rm -rf "$GNUPGHOME"; \
  fi; \
  apk del .fetch-deps

COPY docker-php-source /usr/local/bin/

RUN set -xe \
  && chmod +x /usr/local/bin/docker-php-source \
  && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS coreutils curl-dev \
    libedit-dev libressl-dev libsodium-dev libxml2-dev sqlite-dev \
  && export CFLAGS="$PHP_CFLAGS" CPPFLAGS="$PHP_CPPFLAGS" LDFLAGS="$PHP_LDFLAGS" \
  && docker-php-source extract \
  && cd /usr/src/php \
  && gnuArch="$(dpkg-architecture --query DEB_BUILD_GNU_TYPE)" \
  && ./configure --build="$gnuArch" --with-config-file-path="$PHP_INI_DIR" \
    --with-config-file-scan-dir="$PHP_INI_DIR/conf.d" \
    --enable-option-checking=fatal --with-mhash --enable-ftp --enable-mbstring \
    --enable-mysqlnd --with-sodium=shared --with-curl --with-libedit --with-openssl \
    --with-zlib $(test "$gnuArch" = 's390x-linux-gnu' && echo '--without-pcre-jit') \
    $PHP_EXTRA_CONFIGURE_ARGS \
  && make -j "$(nproc)" && make install \
  && { find /usr/local/bin /usr/local/sbin -type f -perm +0111 -exec strip --strip-all \
    '{}' + || true; } && make clean \
  && cd / \
  && docker-php-source delete \
  && runDeps="$( \
    scanelf --needed --nobanner --format '%n#p' --recursive /usr/local \
      | tr ',' '\n' | sort -u \
      | awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
    )" \
  && apk add --no-cache --virtual .php-rundeps $runDeps \
  && apk del .build-deps \
  && pecl update-channels \
  && rm -rf /tmp/pear ~/.pearrc

COPY docker-php-ext-* docker-php-entrypoint /usr/local/bin/

RUN chmod +x /usr/local/bin/docker-php-ext-* /usr/local/bin/docker-php-entrypoint \
  && docker-php-ext-enable sodium

ENTRYPOINT ["docker-php-entrypoint"]

WORKDIR /var/www/html

RUN set -ex \
  && cd /usr/local/etc \
  && if [ -d php-fpm.d ]; then \
      sed 's!=NONE/!=!g' php-fpm.conf.default | tee php-fpm.conf > /dev/null; \
      cp php-fpm.d/www.conf.default php-fpm.d/www.conf; \
    else \
      mkdir php-fpm.d; cp php-fpm.conf.default php-fpm.d/www.conf; \
      { echo '[global]'; echo 'include=etc/php-fpm.d/*.conf'; } | tee php-fpm.conf; \
    fi \
  && { \
    echo '[global]'; \
    echo 'error_log = /proc/self/fd/2'; \
    echo; \
    echo '[www]'; \
    echo '; if we send this to /proc/self/fd/1, it never appears'; \
    echo 'access.log = /proc/self/fd/2'; \
    echo; \
    echo 'clear_env = no'; \
    echo; \
    echo '; Ensure worker stdout and stderr are sent to the main error log.'; \
    echo 'catch_workers_output = yes'; \
  } | tee php-fpm.d/docker.conf \
  && { \
    echo '[global]'; \
    echo 'daemonize = no'; \
    echo; \
    echo '[www]'; \
    echo 'listen = 9000'; \
  } | tee php-fpm.d/zz-docker.conf

CMD ["php-fpm"]
