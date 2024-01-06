CREATE DATABASE IF NOT EXISTS all_inkl_db;
CREATE USER 'all_inkl_usr'@'localhost' IDENTIFIED BY 'all1nklDb';
GRANT ALL ON all_inkl_db.* TO 'all_inkl_usr'@'%';

SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
/* Make sure the privileges are installed */
FLUSH PRIVILEGES;

USE all_inkl_db;
