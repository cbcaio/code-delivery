## Sistema de delivery com Laravel 5.1 + Ionic

###Capítulo 1: Criando a base do sistema

1. Gerar APP_KEY caso não tiver sido gerada na instalação do laravel
```php
  php artisan key:generate
```
2. Definir variáveis no .env
3. Mudar nome da aplicação 
  php artisan app:name [namespace]
4. Criar database
5. Em relação aos Models:
  1. Criação pasta app\Models 
  2. Transferir User para a pasta e corrigir namespace e config\auth.php
  3. Category, Product, Client, Order, OrderItem models criados
6. Em relação às Migrations:
  1. create_categories_table
  2. create_products_table
  3. create_clients_table
  4. create_orders_table
  5. create_order_items_table
7. Em relação às Factories:
  Category, Product, Client factories criadas
8. Em relação aos Seeds:
  UserTableSeeder (Client sendo criado junto), CategoryTableSeeder, ProductTableSeeder (não utilizado, ver CategoryTableSeeder)
9. Relacionamentos:
  - [x] Category hasMany Product
  - [x] Product belongsTo Category
  - [x] User hasOne Client
  - [x] Client hasOne User
  - [x] Order hasMany OrderItem
  - [x] Order belongsTo User
  - [x] Order hasMany Product
  - [x] OrderItem belongsTo Product
  - [x] OrderItem belongsTo Order
