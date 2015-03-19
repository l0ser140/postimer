#Postimer
Simple Web Site to display Re-inforcement Timers for Eve online Structures.

The application is based on the Yii framework and requires this to function. Download Yii from http://www.yiiframework.com/ See the help and tutorials on the Yii site for help on configuring. It is recommended that you get the simple example website "hangman" working to ensure that your Yii framework is correctly installed.

Installation Notes:
<ol>
<li>Upload the software to your web site and expand. Remember to set read and execute permissions on the software.</li>
<li>Create a new mySQL database called 'postimer' using phpMyAdmin and import the SQL file in /protected/data/postimer.sql<br />If you choose to use a different database name you will need to configure this in step 5.</li>
<li>If this is a new installation, copy /protected/config/settings.ini.template to /protected/config/settings.ini
<ul><li>Changes will be required in the following lines of /protected/config/settings.ini<br />
<code>dbname = "postimer"</code><br />
<code>dbuser = "your_mysql_username"</code><br />
<code>dbpassword = "your_mysql_password"</code><br /></li>
<li>You should now be able to log in</li>
<li>If you have problems connecting to the database, Check the configuration file in /protected/config/settings.ini to ensure you are connecting to the correct database with the right username, password, and table prefix.<br />
Note: Table names and field names are CASE SENSITIVE in some unix installations. e.g. authitem and AuthItem are NOT the same.</li></ul>
<li>The default database should have 4 sample POS timers and login details for "Admin" and "Demo"</li>
<li>Admin Password is stored in the the "User" table. Default initial log ins are "admin / admin" and "demo / demo". Login as Admin and "Manage Users" to give Superuser privileges to any additional superuser accounts. Once you have a working superuser account you should set the "admin" and "demo" user status to "Banned". Note that "superuser" rights are no longer required to create POS Timers.</li>
<li>To send e-mail alerts configure a cron job to run every hour using the command : <code>php /path/to/protected/yiic.php timerEmail sendMail</code>
<ul>
<li>If you have problems e-mailing check the database configuration in /protected/config/console.php</li>
</ul>
<li>Other options can be configured using the "settings" option from the top menu. You can optionally require users to log in to be able to see pos timer information.</li>
<li>Optional : If you are upgrading from a previous version, go to "Manage Users" -> "Manage Profile Fields". Delete the "isEditor" field. This field is no longer used.</li>
<li>Assign Roles to users
<ul><li>Superuser accounts have rights to manage other user accounts with the "Manage Users" menu.</li>
<li>Superusers cannot create, modify or delete POS timers.</li>
<li>Superusers can assign rights to other users</li>
<li>To allow a user to post and update POS timers a superuser must assign Access Rights</li>
<ul><li>Login with a superuser account</li>
<li>Select "Access Rights" from the top menu</li>
<li>Select a user from the list of user names</li>
<li>Select "Create and Delete POS Timers" from the Drop Box</li>
<li>Click the Assign Button</li></ul></ul>
</ol>

**Notes for users on a shared hosting service.**

Some users on shared hosting services may be required to install the Yii framework in the same directory structure as the POSTimer application. In this case, the POSTimer application files should be uploaded to your host before installing the Yii framework.
<ol><li>Upload the POSTimer files to a new folder on your web host. You will end up with directories something like<br />
/mytimersite/assets/<br />
/mytimersite/css/<br />
/mytimersite/images/<br />
/mytimersite/protected/<br />
/mytimersite/themes/<br />
/mytimersite/index.php<br /></li>
<li>Now install the Yii framework directory into the same root as the application. You will end up with a directory something like<br />
/mytimersite/framework/yii.php <- this is the important startup file<br />
/mytimersite/framework/base/<br />
/mytimersite/framework/ - lots more files -<br /></li>
<li>Modify /mytimersite/index.php line 4 to point to the Yii install directory and the Yii startup file.<br />
<code>$yii=dirname(FILE).'/framework/yii.php';</code><br />
should work (I haven't tested it) otherwise try<br />
<code>$yii=/mytimersite/framework/yii.php;</code>
</ol>
