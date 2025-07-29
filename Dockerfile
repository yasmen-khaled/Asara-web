# 1. نستخدم صورة PHP مع Apache جاهزة (نسخة 8.2)
FROM php:8.2-apache

# 2. تحديث الحزم وتثبيت الأدوات المطلوبة
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring xml

# 3. نسخ ملفات المشروع لمجلد سيرفر الويب
COPY . /var/www/html

# 4. نحدد مجلد العمل داخل الحاوية
WORKDIR /var/www/html

# 5. تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 6. تثبيت مكتبات PHP بواسطة Composer
RUN composer install --no-dev --optimize-autoloader

# 7. توليد مفتاح التطبيق Laravel (لو ما مولد)
RUN php artisan key:generate

# 8. تعديل صلاحيات المجلدات اللازمة للتخزين والذاكرة المؤقتة
RUN chown -R www-data:www-data storage bootstrap/cache

# 9. تشغيل Apache في المقدمة
CMD ["apache2-foreground"] 