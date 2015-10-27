## Sistema de delivery com Laravel 5.1 + Ionic

###Capítulo 1: Criando a base do sistema

1. Gerar APP_KEY caso não tiver sido gerada na instalação do laravel
  ```
    php artisan key:generate
  ```
2. Definir variáveis no .env
3. Mudar nome da aplicação 
  ```
    php artisan app:name [namespace]
  ```
4. Criar database
5. Em relação aos Models:
  - Criada pasta app\Models 
  - User transferi para nova paste e namespace corrigido (no config\auth.php também)
  - Category, Product, Client, Order, OrderItem models criados
6. Em relação às Migrations criadas:
  - create_categories_table
  - create_products_table
  - create_clients_table
  - create_orders_table
  - create_order_items_table
7. Em relação às Factories criadas:
  - Category
  - Product
  - Client
8. Em relação aos Seeds:
  - UserTableSeeder (Client sendo criado junto)
  - CategoryTableSeeder
  - ProductTableSeeder (não utilizado, ver CategoryTableSeeder)
9. Relacionamentos:
  - Category hasMany Product
  - Product belongsTo Category
  - User hasOne Client
  - Client hasOne User
  - Order hasMany OrderItem
  - Order belongsTo User
  - Order hasMany Product
  - OrderItem belongsTo Product
  - OrderItem belongsTo Order
