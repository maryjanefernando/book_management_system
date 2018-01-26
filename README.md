# book_management_system

## INSTALLATION
1) Create a database named "book_management_system"
2) Clone this repository
3) Configure the .env file
4) Run "composer install"
5) Run "php artisan migrate:refresh --seed"
6) Run "php artisan serve"
7) Go to {your_domain}/api/documentation to see available API Calls


## TO DO
1) Use Laravel Framework
2) Create Database Migration
3) Define Models and their relationships <br>
	3.1) BookType [id, type = book_store || library || kiosk] <br>
	3.2) BookSite [id, site_info = $owner || $neighborhood || $newspaper, site_type = BookType.id] <br>
	3.3) Book [id(10), title, author, site_id = BookSite.id] <br>
	3.4) Customer [id, first_name, last_name, bank_account_no(12)] <br>
	3.5) User (Employee) [id, first_name, last_name, email, password] <br>
	3.6) Transaction [id(8), employee_id = User.id, customer_id = Customer.id, book_id = Book.id] <br>

4) Create Controllers for the ff API Calls: <br>
	4.1) Fetch books offered by a specific place <br>
	4.2) Create a transaction <br>
	4.3) Fetching transaction initiated by a specific employee <br>
	    Transaction Details: <br>
			4.3.a) Book given <br>
			4.3.b) Place of transaction <br>
			4.3.c) Customer <br>
			4.3.d) Employee <br>

5) Push your work to a remote repository (e.g. github)
6) Provide repository's link

## DATABASE SEED DETAILS
1) BookSiteType - 3 records (book_store, library, kiosk)
2) BookSite - 10 dummy records
3) Book - 20 dummy records
4) Customer - 10 dummy records
5) User - 10 dummy records
6) Transaction - 10 dummy records
