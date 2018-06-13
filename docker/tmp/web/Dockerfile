FROM alpine:3.7
MAINTAINER M.H Mamoru Hashimoto <you@example.com>

# timezone
RUN apk add --no-cache tzdata \
  && cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime \
  && apk del --purge tzdata

EXPOSE 80

RUN set -x && addgroup -g 82 -S www-data && adduser -u 82 -D -S -G www-data www-data

ENV HTTPD_PREFIX /usr/local/apache2
ENV PATH $HTTPD_PREFIX/bin:$PATH
RUN mkdir -p "$HTTPD_PREFIX" && chown www-data:www-data "$HTTPD_PREFIX"
WORKDIR $HTTPD_PREFIX

ENV HTTPD_VERSION 2.4.33
ENV HTTPD_SHA256 de02511859b00d17845b9abdd1f975d5ccb5d0b280c567da5bf2ad4b70846f05

ENV HTTPD_PATCHES=""

ENV APACHE_DIST_URLS \
  https://www.apache.org/dyn/closer.cgi?action=download&filename= \
  https://www-us.apache.org/dist/ \
  https://www.apache.org/dist/ \
  https://archive.apache.org/dist/

RUN set -eux; runDeps='apr-dev apr-util-dev apr-util-ldap perl'; \
  apk add --no-cache --virtual .build-deps $runDeps ca-certificates coreutils dpkg-dev dpkg \
  gcc gnupg libc-dev libressl libressl-dev libxml2-dev lua-dev make nghttp2-dev pcre-dev tar \
  zlib-dev ; \

  ddist() { \
    local f="$1"; shift; local distFile="$1"; shift; local success=; local distUrl=; \
    for distUrl in $APACHE_DIST_URLS; do \
      if wget -O "$f" "$distUrl$distFile" && [ -s "$f" ]; then \
        success=1; break; \
      fi; \
    done; \
    [ -n "$success" ]; \
  }; \

  ddist 'httpd.tar.bz2' "httpd/httpd-$HTTPD_VERSION.tar.bz2"; \

  echo "$HTTPD_SHA256 *httpd.tar.bz2" | sha256sum -c -; \
  ddist 'httpd.tar.bz2.asc' "httpd/httpd-$HTTPD_VERSION.tar.bz2.asc"; \
  export GNUPGHOME="$(mktemp -d)"; \

  for key in \
    A93D62ECC3C8EA12DB220EC934EA76E6791485A8 \
    B9E8213AEFB861AF35A41F2C995E35221AD84DFF \
  ; do \
     gpg --keyserver hkp://ipv4.pool.sks-keyservers.net --recv-keys "$key" \
    || gpg --keyserver ha.pool.sks-keyservers.net --recv-keys "$key" \
    || gpg --keyserver keyserver.pgp.com --recv-keys "$key" \
    || gpg --keyserver pool.sks-keyservers.net --recv-keys "$key" \
    || gpg --keyserver pgp.mit.edu --recv-keys "$key" \
    || gpg --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys "$key" \
  ; done; \

  gpg --batch --verify httpd.tar.bz2.asc httpd.tar.bz2; \
  rm -rf "$GNUPGHOME" httpd.tar.bz2.asc; \
  mkdir -p src; tar -xf httpd.tar.bz2 -C src --strip-components=1; rm httpd.tar.bz2; cd src; \

  patches() { \
    while [ "$#" -gt 0 ]; do \
      local patchFile="$1"; shift; local patchSha256="$1"; shift; \
      ddist "$patchFile" "httpd/patches/apply_to_$HTTPD_VERSION/$patchFile"; \
      echo "$patchSha256 *$patchFile" | sha256sum -c -; \
      patch -p0 < "$patchFile"; \
      rm -f "$patchFile"; \
    done; \
  }; \

  patches $HTTPD_PATCHES; gnuArch="$(dpkg-architecture --query DEB_BUILD_GNU_TYPE)"; \
  ./configure --build="$gnuArch" --prefix="$HTTPD_PREFIX" --enable-mods-shared=reallyall \
    --enable-mpms-shared=all; make -j "$(nproc)"; make install; cd ..; rm -r src man manual; \
  sed -ri \
    -e 's!^(\s*CustomLog)\s+\S+!\1 /proc/self/fd/1!g' \
    -e 's!^(\s*ErrorLog)\s+\S+!\1 /proc/self/fd/2!g' \
  "$HTTPD_PREFIX/conf/httpd.conf"; \

  runDeps="$runDeps $( \
    scanelf --needed --nobanner --format '%n#p' --recursive /usr/local \
      | tr ',' '\n' | sort -u \
      | awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
  )"; \

  apk add --virtual .httpd-rundeps $runDeps; apk del .build-deps

COPY httpd-foreground /usr/local/bin/
RUN chmod +x /usr/local/bin/httpd-foreground

CMD ["httpd-foreground"]
