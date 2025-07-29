# استخدم صورة PHP مع Apache جاهزة (نسخة 8.2)
FROM php:8.2-apache

# تحديث الحزم وتثبيت الأدوات المطلوبة
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring xml

# نسخ ملفات المشروع لمجلد سيرفر الويب
COPY . /var/www/html

# تحديد مجلد العمل داخل الحاوية
WORKDIR /var/www/html

# تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# تثبيت مكتبات PHP بواسطة Composer
RUN composer install --no-dev --optimize-autoloader

# تعديل صلاحيات المجلدات اللازمة للتخزين والذاكرة المؤقتة
RUN chown -R www-data:www-data storage bootstrap/cache

RUN php artisan config:cache && php artisan key:generate && apache2-foreground

# تشغيل Apache في المقدمة
CMD ["apache2-foreground"]
