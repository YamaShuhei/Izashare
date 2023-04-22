FROM mysql/mysql-server:5.7

ENV MYSQL_DATABASE=laravel \
  MYSQL_USER=admin \
  MYSQL_PASSWORD=LMjfmygv9bZ80kR5TBF8 \
  MYSQL_ROOT_PASSWORD=LMjfmygv9bZ80kR5TBF8 \
  TZ=Asia/Tokyo

COPY ./my.cnf /etc/my.cnf
RUN chmod 644 /etc/my.cnf