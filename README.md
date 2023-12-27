# CRUD for market inzight 

### This will create, read, update, delete users, emails and proxies 
1. Install maatwebsite/excel
```
composer require maatwebsite/excel
```
2. Install laravel datatable
```
composer require yajra/laravel-datatables:"^9.0"
```
3. Public config of maatwebsite
```
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config
```
4. Install package
- First add repositories and require field of your root composer.json like below. In this case mi package in the same directory with project.
  
![image](https://github.com/ngovi-2909/market-inzight/assets/74971162/83ca4e52-cd5a-4186-ad4b-d4f5e5bcc28f)

 ![image](https://github.com/ngovi-2909/market-inzight/assets/74971162/248d1a66-fc10-40d0-b058-03efd93121c0)
- Then run this below command to install package. 
```
composer update
```
5. Get the js, css and components for views.
```
php artisan vendor:publish --tag=public --force
```

6. Create users, emails, proxies tables. It will meet error when you have users table so delete it if needed
```
php artisan migrate:refresh
```

