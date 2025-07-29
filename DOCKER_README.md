# Docker Setup for Asara Beach Cottages

This guide explains how to run the Asara Beach Cottages project using Docker.

## 🐳 Quick Start

### Development Environment

1. **Clone the repository and navigate to the project directory:**
   ```bash
   cd Asara_Web
   ```

2. **Copy the environment file:**
   ```bash
   cp .env.example .env
   ```

3. **Update the .env file with your database credentials:**
   ```env
   DB_HOST=db
   DB_DATABASE=asara_web
   DB_USERNAME=asara_user
   DB_PASSWORD=asara_password
   ```

4. **Start the development environment:**
   ```bash
   docker-compose up -d
   ```

5. **Run database migrations:**
   ```bash
   docker-compose exec app php artisan migrate
   ```

6. **Seed the database (optional):**
   ```bash
   docker-compose exec app php artisan db:seed
   ```

7. **Access the application:**
   - Main application: http://localhost:8000
   - phpMyAdmin: http://localhost:8080
   - Database credentials: asara_user / asara_password

### Production Environment

1. **Build and start production containers:**
   ```bash
   docker-compose -f docker-compose.prod.yml up -d --build
   ```

2. **Run production setup:**
   ```bash
   docker-compose -f docker-compose.prod.yml exec app php artisan migrate --force
   docker-compose -f docker-compose.prod.yml exec app php artisan config:cache
   docker-compose -f docker-compose.prod.yml exec app php artisan route:cache
   docker-compose -f docker-compose.prod.yml exec app php artisan view:cache
   ```

## 📁 Docker Files Structure

```
Asara_Web/
├── Dockerfile                 # Development Dockerfile
├── Dockerfile.prod           # Production Dockerfile
├── docker-compose.yml        # Development environment
├── docker-compose.prod.yml   # Production environment
├── .dockerignore             # Files to exclude from build
└── docker/
    ├── apache.conf           # Apache configuration
    └── nginx.conf            # Nginx configuration (optional)
```

## 🔧 Available Commands

### Development Commands

```bash
# Start all services
docker-compose up -d

# Stop all services
docker-compose down

# View logs
docker-compose logs -f app

# Access Laravel container
docker-compose exec app bash

# Run Laravel commands
docker-compose exec app php artisan migrate
docker-compose exec app php artisan make:controller ExampleController
docker-compose exec app composer install

# Access database
docker-compose exec db mysql -u asara_user -p asara_web
```

### Production Commands

```bash
# Start production environment
docker-compose -f docker-compose.prod.yml up -d --build

# Stop production environment
docker-compose -f docker-compose.prod.yml down

# View production logs
docker-compose -f docker-compose.prod.yml logs -f app

# Run production maintenance
docker-compose -f docker-compose.prod.yml exec app php artisan down
docker-compose -f docker-compose.prod.yml exec app php artisan up
```

## 🌐 Services and Ports

| Service | Port | Description |
|---------|------|-------------|
| Laravel App | 8000 | Main application |
| MySQL | 3306 | Database |
| phpMyAdmin | 8080 | Database management |
| Redis | 6379 | Caching and sessions |

## 🔒 Security Considerations

### Environment Variables

1. **Never commit .env files** - They contain sensitive information
2. **Use strong passwords** for database and admin accounts
3. **Update default credentials** in production

### Production Security

1. **Use HTTPS** - Configure SSL certificates
2. **Set APP_DEBUG=false** in production
3. **Use strong database passwords**
4. **Regular security updates**

## 📊 Monitoring and Logs

### View Application Logs

```bash
# Laravel logs
docker-compose exec app tail -f storage/logs/laravel.log

# Apache logs
docker-compose logs -f app

# Database logs
docker-compose logs -f db
```

### Performance Monitoring

```bash
# Check container resource usage
docker stats

# View container details
docker-compose ps
```

## 🚀 Deployment

### Local Development

1. Ensure Docker and Docker Compose are installed
2. Follow the Quick Start guide above
3. Make changes to your code
4. Changes are automatically reflected (volume mounting)

### Production Deployment

1. **Prepare your server:**
   ```bash
   # Install Docker and Docker Compose
   curl -fsSL https://get.docker.com -o get-docker.sh
   sudo sh get-docker.sh
   sudo curl -L "https://github.com/docker/compose/releases/download/v2.20.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
   sudo chmod +x /usr/local/bin/docker-compose
   ```

2. **Deploy the application:**
   ```bash
   git clone https://github.com/yasmen-khaled/Asara-web.git
   cd Asara-web
   cp .env.example .env
   # Edit .env with production values
   docker-compose -f docker-compose.prod.yml up -d --build
   ```

3. **Set up SSL (optional):**
   ```bash
   # Generate SSL certificates
   mkdir -p docker/ssl
   # Add your SSL certificates to docker/ssl/
   ```

## 🛠️ Troubleshooting

### Common Issues

1. **Port already in use:**
   ```bash
   # Check what's using the port
   netstat -tulpn | grep :8000
   # Stop conflicting services or change ports in docker-compose.yml
   ```

2. **Permission issues:**
   ```bash
   # Fix storage permissions
   docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
   ```

3. **Database connection issues:**
   ```bash
   # Check if database is running
   docker-compose ps
   # Restart database
   docker-compose restart db
   ```

4. **Composer issues:**
   ```bash
   # Clear composer cache
   docker-compose exec app composer clear-cache
   # Reinstall dependencies
   docker-compose exec app composer install --no-dev
   ```

### Performance Optimization

1. **Enable OPcache:**
   ```dockerfile
   # Add to Dockerfile
   RUN docker-php-ext-install opcache
   ```

2. **Use Redis for sessions:**
   ```env
   SESSION_DRIVER=redis
   CACHE_DRIVER=redis
   ```

3. **Optimize images:**
   ```bash
   # Use multi-stage builds
   # Compress images before deployment
   ```

## 📞 Support

For issues related to Docker setup:

1. Check the troubleshooting section above
2. Review Docker and Laravel logs
3. Ensure all environment variables are properly set
4. Verify network connectivity between containers

## 🔄 Updates and Maintenance

### Updating the Application

```bash
# Pull latest changes
git pull origin main

# Rebuild containers
docker-compose down
docker-compose up -d --build

# Run migrations
docker-compose exec app php artisan migrate
```

### Backup and Restore

```bash
# Backup database
docker-compose exec db mysqldump -u asara_user -p asara_web > backup.sql

# Restore database
docker-compose exec -T db mysql -u asara_user -p asara_web < backup.sql
```

---

**Note:** Always test changes in development before deploying to production! 