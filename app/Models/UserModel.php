<?php

	namespace App\Models;

	use CodeIgniter\Model;

	class UserModel extends Model {
		protected $db;
		protected $table = 'users';
		protected $allowedFields = ['id', 'firstName', 'lastName', 'emailAddress', 'password'];
	}
?>