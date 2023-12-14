# CRUD for market inzight 

### This will create, read, update, delete users, emails and proxies 
1. Install package
- First add repositories and require field of your root composer.json like below. In this case mi package in the same directory with project.
![image](https://github.com/ngovi-2909/market-inzight/assets/74971162/83ca4e52-cd5a-4186-ad4b-d4f5e5bcc28f)

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
