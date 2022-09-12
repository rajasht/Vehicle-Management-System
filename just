1. project title vehicle management
2. design database (each task )
	1. User
	2. Inventory
	3. Order
	4. Vehicle
	5. Dealer
3. API DEVELOPMENT
	1. login
	2. profile details (List and Update)
	3. list Inventory
	4. Add Inventory
	5. Update Invetory
	6. Update inventory Status
	7. User(admin/dealer/customer)
		add, update, list user
		user category

	8. Transaction(Buy Online/Order)
		1. inventory shortlist (add and list both) based on user id
		2. Add to Cart
		3. Create Order
		4. list order (customer/dealer/admin)

API INtegration with frontend

starting
login
buy


INVOICE: TABLE COLUMNS:


invoice id
seller_id
item_id
item_quantity
tax
discount
sum total amount
paymnet-method
transaction_id
verified by
created on

----------------------
$table->id()->from(1501);
            $table->integer('order_id');
            $table->integer('vehicle_id');
            $table->integer('dealer_id');
            $table->decimal('price');
            $table->decimal('tax_percentage');
            $table->decimal('discount_percentage');
            $table->decimal('total_amount');
            $table->string('payment_method');
            $table->string('UPI_Reference_number')->nullable();
            $table->string('Credit_card_number')->nullable();
            $table->string('Debit_card_number')->nullable();
            $table->string('Net_Banking_transaction_id')->nullable();
            $table->string('verified_by');


            ----------------------------------------------

  for generating button onclick reference no. of the form

        <a href="">
            <button class="btn btn-primary col-md-12" type="button" onclick="func()">
                List Car
            </button>
	            <script>
	                function func(){
	                    var ref = new Date().getTime().toString();
	                    console.log(ref);
	                }
	            </script>
        </a>


        -----------------------------------------

        $response = $this->post('/api/users', [
            "first_name" => "Steve",
            "last_name" => "Smith",
            "phone" => "9999881234",
            "address" => "123, Street No., AB City India",
            "email" => "steave@example.com",
            "password" => "112233",
            "user_type" => 2,
            "car_id" => 8
        ]);
        $response->assertStatus(200);
        $response->assertSame();


        ---------------------------------------

        public function user_creation()
    {
        $response = $this->post('/api/users', [
            "first_name" => "Rajan",
            "last_name" => "Suri",
            "phone" => "9123111234",
            "address" => "BZ-14, Street No. 2, AC City Peru",
            "email" => "rajan@example.com",
            "password" => "122331",
            "user_type" => 2,
            "car_id" => 12
        ]);
        $response->assertStatus(201);

    }

    -------------------------------------------------------------------------

    /**
     * A basic feature test example.
     *
     *  @test
     * 
     * @return void
     */
    public function user_creation()
    {
        $response = $this->post('/api/users', [
            "first_name" => "Rajan",
            "last_name" => "Suri",
            "phone" => "9123111234",
            "address" => "BZ-14, Street No. 2, AC City Peru",
            "email" => "rajansuri@example.com",
            "password" => "112331",
            "user_type" => 2,
            "car_id" => 13
        ]);
        $response->assertStatus(201);
    }

    /**
     * A basic feature test example.
     *
     *  @test
     * 
     * @return void
     */

     public function new_user_duplicacy()
     {
        $user1 = User::make([
            "first_name" => "Rajat",
            "last_name" => "patidar",
            "phone" => "9123880010",
            "address" => "BD-14, Street No. 2, AC City Peru",
            "email" => "rajatpa@example.com",
            "password" => "1200334",
            "user_type" => 2,
            "car_id" => 17
        ]);
        $user2 = User::make([
            "first_name" => "Rani",
            "last_name" => "Lali",
            "phone" => "9120003334",
            "address" => "BZ-13, Street No. 20, ABC City Sumeru",
            "email" => "rani@example.com",
            "password" => "117733",
            "user_type" => 2,
            "car_id" => 19
        ]);
        $this->assertTrue($user1->email != $user2->email);
     }