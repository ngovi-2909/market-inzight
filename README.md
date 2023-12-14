# CRUD for market inzight 

### This will create, read, update, delete users, emails and proxies 
1. Install package
- First add repositories in your root composer.json. In this case mi package in the same directory with project. 
![image](https://github.com/ngovi-2909/market-inzight/assets/74971162/248d1a66-fc10-40d0-b058-03efd93121c0)
- Then run this below command to install package. 
```
composer update
```
2. Get the js, css and components for views.
```
php artisan vendor:publish --tag=public --force
```
3. Migrate Database
```
php artisan migrate 
```
