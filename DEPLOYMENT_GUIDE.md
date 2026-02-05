# 🚀 Go Live Guide - बुद्धभुमी मानव सेवा आश्रम Website

## 🎯 FASTEST OPTIONS (5-15 minutes)

### Option 1: Railway (Recommended - Free & Easy)
**Perfect for NGOs, free tier available**

1. **Create account**: https://railway.app/
2. **Connect GitHub**:
   ```bash
   # First, create a GitHub repo
   git init
   git add .
   git commit -m "Initial NGO website"
   git branch -M main
   git remote add origin https://github.com/yourusername/buddhabhoomi-ngo.git
   git push -u origin main
   ```
3. **Deploy on Railway**:
   - Click "New Project" → "Deploy from GitHub repo"
   - Select your repo
   - Railway auto-detects Laravel
   - Add environment variables (see below)
   - Deploy automatically!

**Cost**: Free tier (500 hours/month) - Perfect for NGO

---

### Option 2: Vercel (Static + Serverless)
**Great for fast global delivery**

1. **Account**: https://vercel.com/
2. **Install Vercel CLI**:
   ```bash
   npm i -g vercel
   ```
3. **Deploy**:
   ```bash
   vercel --prod
   ```

---

### Option 3: Netlify (Simple Static)
**Good for basic websites**

1. **Account**: https://netlify.com/
2. **Drag & drop** your `public` folder after building
3. **Or connect GitHub** for auto-deployment

---

## 🏢 PROFESSIONAL OPTIONS (30-60 minutes)

### Option 4: DigitalOcean App Platform
**Professional, scalable, $5/month**

1. **Account**: https://digitalocean.com/
2. **Create App**:
   - Connect GitHub repo
   - Choose "Web Service"
   - Auto-detects Laravel
   - Add database (PostgreSQL recommended)
   - Deploy!

**Cost**: $5-12/month

---

### Option 5: Shared Hosting (Traditional)
**Good for Nepal-based hosting**

**Recommended Nepal Hosts**:
- **Himalayan Host**: https://www.himalayanhosts.com/
- **Mercantile Communications**: https://www.mos.com.np/
- **Websoftit**: https://websoftit.com/

**Requirements**:
- PHP 8.1+
- MySQL/PostgreSQL
- Composer support
- SSL certificate

---

## 🔧 ENVIRONMENT SETUP

Create `.env.production`:

```env
APP_NAME="Buddhabhoomi Human Service Ashram"
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=buddhabhoomi_db
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

# Email Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=info@buddhabhoomi.org.np
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@buddhabhoomi.org.np
MAIL_FROM_NAME="Buddhabhoomi Human Service Ashram"

# Payment Gateways (Production)
ESEWA_MERCHANT_CODE=your-esewa-code
ESEWA_SECRET_KEY=your-esewa-secret
KHALTI_PUBLIC_KEY=your-khalti-public-key
KHALTI_SECRET_KEY=your-khalti-secret-key

# File Storage
FILESYSTEM_DISK=public

# Session & Cache
SESSION_DRIVER=database
CACHE_DRIVER=database
QUEUE_CONNECTION=database
```

---

## 🚀 QUICK DEPLOYMENT SCRIPT

```bash
# deploy.sh
#!/bin/bash

echo "🚀 Deploying Buddhabhoomi NGO Website..."

# Build for production
composer install --no-dev --optimize-autoloader
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Database
php artisan migrate --force
php artisan db:seed --force

# Storage
php artisan storage:link

# Clear caches
php artisan cache:clear
php artisan config:clear

echo "✅ Deployment complete!"
```

---

## 🌐 DOMAIN SETUP

### Option A: Free Domain (.np)
**For Nepal-based NGOs**
- Apply at: https://www.mos.com.np/
- Requirements: NGO registration documents
- Process: 2-4 weeks
- Suggested: `buddhabhoomi.org.np`

### Option B: International Domain
**Quick setup**
- **Namecheap**: https://namecheap.com/
- **Cloudflare**: https://cloudflare.com/
- Suggested: `buddhabhoomi.org`

---

## 📧 EMAIL SETUP

### Gmail SMTP (Free)
1. **Enable 2FA** on Gmail
2. **Generate App Password**:
   - Google Account → Security → App passwords
   - Generate password for "Mail"
3. **Use in .env**:
   ```env
   MAIL_USERNAME=your-email@gmail.com
   MAIL_PASSWORD=your-app-password
   ```

### Professional Email
- **Google Workspace**: $6/user/month
- **Microsoft 365**: $5/user/month
- **Zoho Mail**: $1/user/month

---

## 🔒 SSL CERTIFICATE

### Free SSL (Let's Encrypt)
Most hosting providers include this automatically.

### Cloudflare (Recommended)
1. **Account**: https://cloudflare.com/
2. **Add site**: Your domain
3. **Change nameservers** at your domain registrar
4. **Enable SSL**: Full (strict)
5. **Benefits**: CDN, DDoS protection, analytics

---

## 📊 MONITORING & ANALYTICS

### Google Analytics
```html
<!-- Add to layouts/app.blade.php -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'GA_MEASUREMENT_ID');
</script>
```

### Uptime Monitoring
- **UptimeRobot**: https://uptimerobot.com/ (Free)
- **Pingdom**: https://pingdom.com/

---

## 🎯 RECOMMENDED QUICK PATH

**For immediate launch (TODAY):**

1. **Railway Deployment** (15 minutes):
   ```bash
   # Create GitHub repo
   git init
   git add .
   git commit -m "NGO website ready for deployment"
   
   # Push to GitHub (create repo first)
   git remote add origin https://github.com/yourusername/buddhabhoomi-ngo.git
   git push -u origin main
   
   # Deploy on Railway
   # - Go to railway.app
   # - Connect GitHub
   # - Deploy repo
   # - Add environment variables
   ```

2. **Domain Setup** (if you have one):
   - Point domain to Railway URL
   - Enable SSL

3. **Email Configuration**:
   - Use Gmail SMTP for now
   - Upgrade to professional email later

**Result**: Live website in 15-30 minutes!

---

## 💰 COST BREAKDOWN

### Free Option
- **Railway**: Free tier (500 hours/month)
- **Domain**: .np domain (free for NGOs)
- **Email**: Gmail SMTP (free)
- **SSL**: Included
- **Total**: FREE

### Professional Option
- **DigitalOcean**: $5-12/month
- **Domain**: $10-15/year
- **Email**: $1-6/month
- **Cloudflare**: Free
- **Total**: $6-18/month

---

## 🆘 SUPPORT CONTACTS

### Technical Support
- **Railway**: Discord community
- **DigitalOcean**: 24/7 support
- **Cloudflare**: Community forum

### Nepal-specific
- **Domain (.np)**: MoS Nepal
- **Local hosting**: Contact recommended providers

---

## ✅ POST-DEPLOYMENT CHECKLIST

- [ ] Website loads correctly
- [ ] Admin panel accessible (/admin)
- [ ] Donation form works
- [ ] Volunteer registration works
- [ ] Email notifications working
- [ ] SSL certificate active
- [ ] Google Analytics tracking
- [ ] Mobile responsive
- [ ] Payment gateways configured
- [ ] Backup system in place

---

## 🎉 LAUNCH ANNOUNCEMENT

Once live, announce on:
- **Facebook**: https://www.facebook.com/share/17pfqLC1dq/
- **Local media**: Press release
- **Partner organizations**: Email announcement
- **Volunteers**: WhatsApp/SMS

---

**Your professional NGO website is ready to make a real impact! 🌟**

Choose Railway for the quickest launch, or DigitalOcean for professional hosting. Both will have you live within the hour!