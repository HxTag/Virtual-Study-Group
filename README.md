# Virtual-Study-Group
A collaborative platform for students to form virtual study groups, share resources, and learn together online.

## Features

- 👥 **Group Management** - Create, join, and manage study groups
- 💬 **Real-time Chat** - WebSocket-based instant messaging
- 📚 **Resource Sharing** - Upload and share study materials
- ⭐ **Resource Voting** - Vote on helpful resources
- 👤 **User Profiles** - Customizable user profiles with avatars
- 🔒 **Permissions System** - Role-based access control (Admin/Member)
- 📊 **Points System** - Earn points for contributions
- 🚫 **Moderation Tools** - Ban/unban members, manage join requests

## Tech Stack

- **Backend:** PHP
- **Database:** MySQL
- **Object Storage:** MinIO
- **Real-time Communication:** PHP WebSocket Server
- **Frontend:** HTML, CSS, JavaScript
- **Dependencies:** Composer (for PHP dependencies)

## Prerequisites

- XAMPP (Apache + MySQL)
- MinIO Server
- PHP 7.4 or higher
- Composer (for dependency management)
- Web browser

## Installation & Setup

### Step 1: Install XAMPP
1. Download and install XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. Start **Apache** and **MySQL** modules from XAMPP Control Panel

### Step 2: Setup Database
1. Open your browser and go to [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/)
2. Create a new database named `studygroup`
3. Import the database schema:
   - Navigate to the `database` folder in this project
   - Import `studygroup(schema).sql` file

### Step 3: Install MinIO
1. Download MinIO from [https://min.io/download](https://min.io/download)
2. Extract MinIO to `C:\minio`
3. Create a data directory: `C:\minio-data`
4. Open PowerShell as Administrator and run:
   ```powershell
   cd C:\minio
   .\minio.exe server C:\minio-data
   ```
5. MinIO will start on [http://localhost:9000](http://localhost:9000)

### Step 4: Configure MinIO
1. Open browser and go to [http://localhost:9000](http://localhost:9000/)
2. Login with default credentials:
   - **Username:** minioadmin
   - **Password:** minioadmin
3. Create a bucket named `virtual-study-group`
4. Set the bucket policy to public or configure as needed

### Step 5: Setup Project Files
1. Clone or download this repository
2. Copy the project folder to `C:\xampp\htdocs\`
3. The project should be at: `C:\xampp\htdocs\VirtualStudyGroup`

### Step 6: Configure Database Connection
1. Create a `config.php` file in the root directory
2. Add your database credentials:
   ```php
   <?php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'studygroup');
   ?>
   ```

### Step 7: Install PHP Dependencies
1. Open Command Prompt as Administrator
2. Navigate to project directory:
   ```cmd
   cd C:\xampp\htdocs\VirtualStudyGroup
   ```
3. Install Composer dependencies:
   ```cmd
   composer install
   ```

### Step 8: Start WebSocket Server
1. Open Command Prompt as Administrator
2. Navigate to project directory:
   ```cmd
   cd C:\xampp\htdocs\VirtualStudyGroup
   ```
3. Start the chat server:
   ```cmd
   php chat_server.php
   ```
4. Keep this terminal open while using the chat feature

### Step 9: Access the Application
1. Open your browser
2. Go to [http://localhost/VirtualStudyGroup](http://localhost/VirtualStudyGroup)
3. Register a new account or login

## Usage

### Creating a Study Group
1. Login to your account
2. Click on "Create Group"
3. Fill in group details (name, description, privacy settings)
4. Upload a group picture (optional)
5. Click "Create"

### Joining a Group
1. Go to "Search Groups"
2. Find a group you want to join
3. Click "Join" (or "Request to Join" for private groups)
4. Wait for admin approval if required

### Sharing Resources
1. Enter a group
2. Navigate to "Resources" section
3. Click "Upload Resource"
4. Select file and add description
5. Resources are stored in MinIO object storage

### Real-time Chat
1. Enter a group
2. Navigate to "Chat" section
3. Type your message and press Enter
4. Messages are delivered instantly via WebSocket

## Project Structure

```
VirtualStudyGroup/
├── assets/              # Static files and images
├── config/              # Configuration files
├── css/                 # Stylesheets
├── database/            # Database schema
├── includes/            # PHP includes (header/footer)
├── js/                  # JavaScript files
├── vendor/              # Composer dependencies
├── .gitignore           # Git ignore file
├── .htaccess            # Apache configuration
├── composer.json        # Composer dependencies
├── composer.lock        # Composer lock file
├── chat_server.php      # WebSocket server
├── index.php            # Landing page
├── login.php            # Login page
├── register.php         # Registration page
├── dashboard.php        # User dashboard
└── [other PHP files]    # Various functionality
```

## Security Notes

⚠️ **Important:** This project is for educational purposes. Before deploying to production:

1. Change default MinIO credentials
2. Use environment variables for sensitive data
3. Implement HTTPS/SSL
4. Add input validation and sanitization
5. Use prepared statements for database queries
6. Implement CSRF protection
7. Set proper file upload restrictions

## Contributing

Feel free to fork this project and submit pull requests for any improvements!

## License

This project is open source and available for educational purposes.

## Author

**Hariom Pandey** (HxTag)
- GitHub: [@HxTag](https://github.com/HxTag)
- MCA Student @ DY Patil University

## Support

If you encounter any issues or have questions, please open an issue on GitHub.

---

⭐ If you find this project helpful, please give it a star!
