FROM ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive TZ=Etc/UTC

# تثبيت الحزم المطلوبة
RUN apt-get update && apt-get install -y \
    nginx \
    php-fpm \
    php-mysql \
    openssl \
    curl \
    nano \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# نسخ ملفات الموقع
COPY . /var/www/AhmedZain.com

# نسخ إعدادات Nginx
COPY ahmedzain.com.conf /etc/nginx/sites-available/ahmedzain.com.conf

# حذف الديفولت و تفعيل الموقع بتاعك
RUN rm -f /etc/nginx/sites-enabled/default \
    && ln -s /etc/nginx/sites-available/ahmedzain.com.conf /etc/nginx/sites-enabled/

# نسخ الشهادات
COPY certs/selfsigned.crt /etc/ssl/certs/selfsigned.crt
COPY certs/selfsigned.key /etc/ssl/private/selfsigned.key

# صلاحيات المجلدات
RUN chown -R www-data:www-data /var/www/AhmedZain.com \
    && chmod -R 755 /var/www/AhmedZain.com

# عمل Volume لملف users.txt
VOLUME ["/var/www/AhmedZain.com/users.txt"]

# تشغيل PHP-FPM و Nginx
CMD service php8.1-fpm start && nginx -g 'daemon off;'

EXPOSE 80 443

