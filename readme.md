## Sistema de delivery com Laravel 5.1 + Ionic

###Capítulo 1: Criando a base do sistema

- Gerar APP_KEY caso não tiver sido gerada na instalação do laravel
	php artisan key:generate

- Definir variáveis no .env

- Mudar nome da aplicação 
	php artisan app:name [namespace]

- Criar database

- Em relação aos Models:
	Criação pasta app\Models 
	Transferir User para a pasta e corrigir namespace e config\auth.php
	Category, Product, Client, Order, OrderItem models criados
	
- Em relação às Migrations:
	create_categories_table
	create_products_table
	create_clients_table
	create_orders_table
	create_order_items_table
	
- Em relação às Factories:
	Category, Product, Client factories criadas
	
- Em relação aos Seeds:
	UserTableSeeder (Client sendo criado junto), CategoryTableSeeder, ProductTableSeeder (não utilizado, ver CategoryTableSeeder)
	
- Relacionamentos:
	Category hasMany Product
	Product belongsTo Category
	User hasOne Client
	Client hasOne User
	Order hasMany OrderItem
	Order belongsTo User
	Order hasMany Product
	OrderItem belongsTo Product
	OrderItem belongsTo Order