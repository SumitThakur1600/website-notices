***Project Name: NoticeWebsite***

**Description:**
NoticeWebsite is an advanced web application designed to efficiently manage and disseminate notices, e-tenders, and proforma while enhancing user interaction through integrated contact forms, secure login, and signup functionalities. Serving as a centralized platform, NoticeWebsite enables users to access and engage with a diverse range of information:

**Notices:** Users can seamlessly search notices by title, upload date, category, and year. The system dynamically filters and presents up-to-date information on admissions, scholarships, exams, fees, committees, and general notifications.

**E-tenders:** Administrators benefit from comprehensive functionalities to add, search, and manage e-tenders, ensuring transparency and efficiency in procurement processes.

**Proforma:** Users have access to download proforma templates, facilitating standardized document handling and streamlined administrative procedures.

**Contact Form:** Integrated contact forms enable direct communication, allowing users to submit inquiries, feedback, or messages conveniently through the website.

**Authentication:** Robust user authentication and session management features ensure secure access, with personalized experiences tailored to user roles and permissions.

**User Management:** Seamless user registration (signup) and login processes provide enhanced accessibility to tailored content and functionalities.

NoticeWebsite is developed using a robust technology stack comprising PHP, MySQL, JavaScript, HTML, CSS, and Bootstrap. Its responsive design ensures optimal performance and user experience across various devices, accommodating both desktop and mobile platforms.

**Key Features:**
- Advanced search and filtering capabilities for notices, e-tenders, and proforma.
- Integrated contact forms for user interaction and communication.
- Secure user authentication and session handling mechanisms.
- Admin panel enabling CRUD operations (Create, Read, Update, Delete) for notices, e-tenders, and proforma.
- Responsive design ensuring seamless usability across desktop and mobile devices.

**Technologies Used:**
PHP, MySQL, JavaScript, HTML, CSS, Bootstrap

NoticeWebsite represents a comprehensive solution for organizations seeking efficient information management, improved user engagement, and streamlined administrative processes through a unified online platform.

***GUIDE:***

**Prerequisites:**
Ensure you have a web server (e.g., Apache), PHP (version 7.x or higher), and MySQL (version 5.6 or higher) installed on your system.
Basic knowledge of PHP, MySQL, HTML, and CSS is recommended.

**Steps:**
**Clone the Repository:**
Open your command-line interface (e.g., Terminal for macOS/Linux, Command Prompt for Windows).
Navigate to the directory where you want to store the project.
Run the following command to clone the repository:
bash
Copy code
git clone https://github.com/your-username/noticewebsite.git
Replace your-username with your GitHub username.

**Database Setup:**
Create Database:
Open MySQL Client Tool:
Launch PHPMyAdmin or any MySQL client tool you prefer.
Create New Database:
Navigate to the interface where you can create a new database.
Enter notices as the database name.

**Importing sumitnotices.sql File into Database:**
Locate SQL File:

Navigate to the directory where your sumitnotices.sql file is located. Typically, this file would be in the database folder of your project.
Access MySQL Client Tool:

Open PHPMyAdmin or your preferred MySQL client tool.
Select Database:

Choose the database where you want to import the notices. If the database (noticewebsite) does not exist, create it following the steps outlined in the "Database Setup" section.
Import SQL File:

In PHPMyAdmin, navigate to the Import tab.
Upload SQL File:

Click on Choose File and select the sumitnotices.sql file from your local machine.
Execute Import:

Optionally, set the character set (e.g., utf8mb4_unicode_ci) if needed for proper Unicode support.
Click Go or Import to execute the SQL file import.
Verify Import Success:

After the import completes, verify by checking the structure and content of the relevant table within the noticewebsite database.
Ensure that the notices data from sumitnotices.sql has been successfully inserted into the appropriate table.

**Configuring Database Connection in database.php:**
After importing sumitnotices.sql into your MySQL database through PHPMyAdmin or a MySQL client tool, locate the database.php file within the php folder of your project directory. Open this file using a text editor and update the database connection details (DB_HOST, DB_USER, DB_PASS, DB_NAME) to match your local MySQL setup. Ensure that DB_NAME is set to notices, which is the database where sumitnotices.sql was imported, containing four tables. Save the changes made to database.php. To verify the import, access PHPMyAdmin, select the notices database, and confirm that the four tables have been successfully populated with the imported data. Finally, ensure that your web server (e.g., Apache) is running, place the project folder (noticewebsite) in the server's document root directory, and access your application via a web browser to ensure it operates correctly with the imported data from sumitnotices.sql.

**Integrating PHPMailer with Gmail App Passwords:**
To enable email functionality in this project, PHPMailer is utilized along with Gmail's SMTP server. Gmail's security requires the use of an App Password instead of your regular Gmail password. Follow these steps to set up and configure PHPMailer with your Gmail App Password:

Download PHPMailer:

Download PHPMailer from its official GitHub repository.
Extract the PHPMailer files into a directory named phpmailer within your project.
Configure PHPMailer:

Ensure PHPMailer is included in the PHP files where email functionality is implemented (e.g., signuphandler.php, contact_process.php, forgotpass.php).
Use require_once or include_once to include PHPMailer's autoload.php file. Adjust the path based on your project structure.
Generate Gmail App Password:

Go to your Google Account settings and navigate to the "Security" section.
Under "Signing in to Google", select "App passwords".
Generate a new App Password specifically for this project. Choose "Mail" as the app and "Other (Custom name)" for the device.
Save the generated App Password securely.
PHPMailer Configuration Example:
signuphandler.php:
php
Copy code
<?php
// Include PHPMailer autoload file
require_once 'phpmailer/autoload.php';

// Configure PHPMailer with Gmail SMTP
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'your-email@gmail.com'; // Your Gmail email address
$mail->Password = 'your-app-password'; // Your Gmail App Password
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Other PHPMailer configurations and email sending logic

**Project Setup Complete**
All setup steps, including the integration of PHPMailer with Gmail App Passwords, have been successfully completed. The project is now ready to be deployed and used.
