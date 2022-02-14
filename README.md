
# Template Laravel 8x, StartBootstrap with basic User, Role, Permission, Activity Log Manager

### Libs and Tools

* Core: [Laravel 8x](https://laravel.com/docs/8.x/releases)

* Admin Template: [StartBootstrap](https://startbootstrap.com/template/sb-admin)
* Permission/Role Lib: [Laravel Permission v5](https://spatie.be/index.php/docs/laravel-permission/v5/introduction)
* Activity Logs Lib: [Laravel-activitylog v3](https://spatie.be/docs/laravel-activitylog/v4/introduction)
* CSS Framework: [Bootstrap 5](https://getbootstrap.com/docs/5.0/getting-started/introduction/)
* JS Framework: [Vue.js v2](https://vuejs.org/), [Chart.js v2](https://www.chartjs.org/samples/2.6.0/)
* Other dev tools: [laravel-debugbar](https://github.com/barryvdh/laravel-debugbar), [laravel-ide-helper]()

### *Tutorial start project*

1. Get project from git

   > git@github.com:bkv1409/lar8x_sb_admin.git

2. Create database, assumption we use mysql and create database name is lar8x-sb-admin


3. Create file .env

   > cp .env.dev .env

   Edit config connect db correctly

   ```
   DB_CONNECTION=mysql
   
   DB_HOST=127.0.0.1
   
   DB_PORT=3306
   
   DB_DATABASE=lar8x-sb-admin
   
   DB_USERNAME=root
   
   DB_PASSWORD=
   ```

4. Install composer package

   > composer install

5. Run migrate db
   > php artisan migrate

6. Run seeder, insert config and sample data in db

   > php artisan db:seed

7. Install js lib and build 
   
    * For Dev
   > yarn install && yarn dev
   
   Or use npm
   > npm install && npm dev

    * For Prod
   > yarn install && yarn prod

    Or use npm
   > npm install && npm prod

8. Run clear config, cache

   > php artisan app:clear
   
9. Run test project

   > php artisan serve

10. Go to Front
   [Front GUI](http://localhost:8000)


11. Go to Admin
    [Admin Site](http://localhost:8000/admin)
    * Login with admin account: *admin@gmail.com/123456Abc$*


12. Cache config, route to optimize performance in production (optional)
    > php artisan app:clear
    
    > php artisan app:cache
                                                                                              
