
<p align="center"></p>
<h1>Laravel Jmeter reports</h1>
<p>Using jmeter test plan, upload your test results to a Mysql database for storeage. The front end will automatically run simple analysis and graph the outcomes of the tests. It automatically links all your tests runs to the respective projects.  
    
<p>The original architecture has two views.</p>
<p>1. For the guys who only want a quick glance of the quality of the product.</p>
- this view shows anly the latest test results for a product.</p>
<p>2. The other for the test engineer who wants to see the details of test outcomes.
- Shows the full list of test runs, and the user chooses whatever results they want to analyze.
</p>

<h4>Running The Project</h4>

Now, Windows, Linux, and MacOS users can continue from the below steps.
1. Run the XAMPP or any server on your system, open PHPMYADMIN or database, create the database named with homestead type utf8_general_ci.

2. Pull or download the Laravel project from Git.
3. On the Laravel project package, you can see the .env.example file which is inside your root directory. Rename it to .env, then update it with the correct database parameters.
4. Open the console and cd to the root directory of your project.
5. Run composer install or php composer.phar install.
6. Run php artisan key:generate
7. Run php artisan migrate
8. Run php artisan db:seed run seeders, if any.
9. Run php artisan serve.
