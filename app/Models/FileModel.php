<?php

	namespace App\Models;

	use CodeIgniter\Model;
	use CodeIgniter\Database\Query;

	class FileModel extends Model {
		protected $db;
		protected $table = 'files';
		protected $primaryKey = 'id';
		protected $allowedFields = [
			'name', 
			'description', 
			'fileName',
			'fileType'
		];

		public function storeFile($name, $description, $fileName, $fileType)
		{
			$data = [
                'name' => $name,
                'description' => $description,
                'fileName' => $fileName,
                'fileType' => $fileType,
            ];

            $this->save($data);
		}

		public function getSearchResults($search)
		{
			$sql = "SELECT * FROM " . $this->table . " WHERE name LIKE '%" . $this->escapeLikeString($search) . "%' OR description LIKE '%" . $this->escapeLikeString($search) . "%' ESCAPE '!'";

			return $this->query($sql)->getResultArray();
		}
	}
?>