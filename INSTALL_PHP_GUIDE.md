# PHP Installation Guide - Get Your NGO Website Running

## 🚀 QUICKEST SOLUTION: Laravel Herd (Recommended)

Laravel Herd is the easiest way to run Laravel projects on Windows. It includes everything you need.

### Step 1: Download Laravel Herd
1. Go to: **https://herd.laravel.com/**
2. Click "Download for Windows"
3. Install the downloaded file

### Step 2: After Installation
1. **Restart your terminal/command prompt**
2. Navigate to your project folder:
   ```cmd
   cd "C:\Users\surkh\Desktop\New folder"
   ```
3. Run the setup:
   ```cmd
   setup.bat
   ```

That's it! Herd includes PHP, Composer, and Node.js automatically.

---

## 🔧 ALTERNATIVE: XAMPP Installation

If you prefer XAMPP:

### Step 1: Download XAMPP
1. Go to: **https://www.apachefriends.org/**
2. Download XAMPP for Windows
3. Install it (default location: `C:\xampp`)

### Step 2: Add PHP to PATH
1. **Open System Properties**:
   - Press `Win + R`, type `sysdm.cpl`, press Enter
   - OR Right-click "This PC" → Properties → Advanced system settings

2. **Environment Variables**:
   - Click "Environment Variables" button
   - In "System Variables" section, find "Path"
   - Click "Edit"
   - Click "New"
   - Add: `C:\xampp\php`
   - Click "OK" on all dialogs

3. **Restart your terminal** and test:
   ```cmd
   php --version
   ```

### Step 3: Install Composer
1. Go to: **https://getcomposer.org/download/**
2. Download and install Composer-Setup.exe
3. Restart terminal

### Step 4: Run Setup
```cmd
setup.bat
```

---

## 🐳 DOCKER OPTION (Advanced Users)

If you have Docker installed:

1. Create `docker-compose.yml` in your project:
```yaml
version: '3.8'
services:
  app:
    image: php:8.2-cli
    working_dir: /var/www
    volumes:
      - .:/var/www
    ports:
      - "8000:8000"
    command: php artisan serve --host=0.0.0.0 --port=8000
  
  node:
    image: node:18
    working_dir: /var/www
    volumes:
      - .:/var/www
    command: npm run dev
```

2. Run:
```cmd
docker-compose up
```

---

## ✅ VERIFICATION

After any installation method, you should be able to run:

```cmd
php --version
composer --version
node --version
npm --version
```

All commands should work without errors.

---

## 🎯 NEXT STEPS

Once PHP is working:

1. **Run the setup script**:
   ```cmd
   setup.bat
   ```

2. **Start the development server**:
   ```cmd
   php artisan serve
   ```

3. **Open your browser**:
   - Website: http://localhost:8000
   - Admin Panel: http://localhost:8000/admin
   - Login: admin@buddhabhoomi.org.np / password

---

## 🆘 TROUBLESHOOTING

### "php is not recognized"
- PHP is not in your PATH
- Restart your terminal after adding to PATH
- Check the PATH was added correctly

### "composer not found"
- Install Composer from getcomposer.org
- Restart terminal after installation

### "npm not found"
- Install Node.js from nodejs.org
- Restart terminal after installation

### Still having issues?
Try Laravel Herd - it handles everything automatically!

---

## 🌟 WHAT YOU'LL SEE

Once running, your professional NGO website will have:

- **Homepage**: Beautiful landing page with impact counters
- **Donation System**: Secure payment processing
- **Volunteer Registration**: 4-step registration process
- **Admin Panel**: Complete management dashboard
- **Responsive Design**: Works on all devices
- **Professional Branding**: International NGO standards

The website is production-ready and includes all the features requested for बुद्धभुमी मानव सेवा आश्रम!