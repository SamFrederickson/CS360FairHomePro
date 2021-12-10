# cs360
 This project was created by Samuel Frederickson, Zackary Hale, Chase Gornick.
 It was constructed on the UIDAHO University Server provided by Instructor Hasan, Jamil.

# SETUP:
Import db2 (1).sql into PHPmyadmin to create the structure for the database.
Change ConnectLogin.php to have personal data entries filled. Ensure database, username, password, sqlport, and socket are all set up to your personal information. If you are on the university server, this infromation can be found in the includes folder in the file "dbconn.php"

Connect to your data by visiting your specified address or localhost if one is not set.

# For University Server Connection:
Login to UIDAHO VPN. Navigate to /webfiles/httph(x) where x is your personal space given to you by your instructor which commonly is a number 1-100.
In here you should see an includes folder and a PHPMyAdmin folder. All files should be placed at this directory and not inside any of these folders.
You can test your pages by going to the IP given to you by your instructor and you can access the phpmyadmin database by going to https://xxx.xxx.xxx.xx/phpMyAdmin-4.0.10.20-english/ where the x's are the IP given to you by your instructor.

Logins may be required to initially see your pages as well as the PHPMyAdmin database. If this is the case, your vandal username (ex. fred1380) and your vandal password should provide you access to the pages contents.

If files are not giving you access. You may have to change file permission to allow rwx on each php page. The easiest but also the least safe way of doing this is to type into putty chmod 777 *.php. This gives everyone access to these files.

File transfers were done on this project with use of WINSCP and connecting to the UIDAHO cs-360 server.

