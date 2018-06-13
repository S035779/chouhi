FROM debian:stretch-slim
MAINTAINER M.H Mamoru Hashimoto <you@example.com>

EXPOSE 3306

RUN groupadd -r mysql && useradd -r -g mysql mysql

# debconf non-interactive mode
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && apt-get install -y --no-install-recommends gnupg dirmngr \
  && rm -rf /var/lib/apt/lists/*

# timezone
RUN apt-get install -y tzdata \
  && cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime \
  && dpkg-reconfigure --frontend noninteractive tzdata

ENV GOSU_VERSION 1.7

RUN set -x \
  && apt-get update && apt-get install -y --no-install-recommends ca-certificates wget \
  && rm -rf /var/lib/apt/lists/* \
  && wget -O /usr/local/bin/gosu "https://github.com/tianon/gosu/releases/download/$GOSU_VERSION/gosu-$(dpkg --print-architecture)" \
  && wget -O /usr/local/bin/gosu.asc "https://github.com/tianon/gosu/releases/download/$GOSU_VERSION/gosu-$(dpkg --print-architecture).asc" \
  && export GNUPGHOME="$(mktemp -d)" \
  && for key in \
      B42F6819007F00F88E364FD4036A9C25BF357DD4 \
    ; do \
      gpg --keyserver hkp://ipv4.pool.sks-keyservers.net --recv-keys "$key" \
      || gpg --keyserver ha.pool.sks-keyservers.net --recv-keys "$key" \
      || gpg --keyserver keyserver.pgp.com --recv-keys "$key" \
      || gpg --keyserver pool.sks-keyservers.net --recv-keys "$key" \
      || gpg --keyserver pgp.mit.edu --recv-keys "$key" \
      || gpg --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys "$key" \
    ; done \
  && gpg --batch --verify /usr/local/bin/gosu.asc /usr/local/bin/gosu \
  && rm -rf "$GNUPGHOME" /usr/local/bin/gosu.asc \
  && chmod +x /usr/local/bin/gosu \
  && gosu nobody true \
  && apt-get purge -y --auto-remove ca-certificates wget

RUN mkdir /docker-entrypoint-initdb.d

RUN apt-get update && apt-get install -y --no-install-recommends pwgen openssl perl \
  && rm -rf /var/lib/apt/lists/*

RUN set -ex; \
  key='A4A9406876FCBD3C456770C88C718D3B5072E1F5'; \
  export GNUPGHOME="$(mktemp -d)"; \
  gpg --keyserver hkp://ipv4.pool.sks-keyservers.net --recv-keys "$key" \
    || gpg --keyserver ha.pool.sks-keyservers.net --recv-keys "$key" \
    || gpg --keyserver keyserver.pgp.com --recv-keys "$key" \
    || gpg --keyserver pool.sks-keyservers.net --recv-keys "$key" \
    || gpg --keyserver pgp.mit.edu --recv-keys "$key" \
    || gpg --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys "$key"; \
  gpg --export "$key" > /etc/apt/trusted.gpg.d/mysql.gpg; \
  rm -rf "$GNUPGHOME"; \
  apt-key list > /dev/null

ENV MYSQL_MAJOR 8.0
ENV MYSQL_VERSION 8.0.11-1debian9

RUN echo "deb http://repo.mysql.com/apt/debian/ stretch mysql-${MYSQL_MAJOR}" \
  > /etc/apt/sources.list.d/mysql.list

RUN { \
    echo mysql-community-server mysql-community-server/data-dir select ''; \
    echo mysql-community-server mysql-community-server/root-pass password ''; \
    echo mysql-community-server mysql-community-server/re-root-pass password ''; \
    echo mysql-community-server mysql-community-server/remove-test-db select false; \
  } | debconf-set-selections \
  && apt-get update && apt-get install -y mysql-community-client-core="${MYSQL_VERSION}" \
    mysql-community-server-core="${MYSQL_VERSION}" && rm -rf /var/lib/apt/lists/* \
  && rm -rf /var/lib/mysql && mkdir -p /var/lib/mysql /var/run/mysqld \
  && chown -R mysql:mysql /var/lib/mysql /var/run/mysqld \
  && chmod 775 /var/run/mysqld

VOLUME /var/lib/mysql

COPY config/ /etc/mysql/
COPY docker-entrypoint /usr/local/bin/

RUN chmod 644 /etc/mysql/my.cnf /etc/mysql/conf.d/docker.cnf \
  && chmod +x /usr/local/bin/docker-entrypoint \
  && ln -s usr/local/bin/docker-entrypoint /entrypoint.sh

ENTRYPOINT ["docker-entrypoint"]

CMD ["mysqld"]
