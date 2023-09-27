<?php

	namespace App\Models;

	use CodeIgniter\Model;

	class CommentModel extends Model {
		protected $db;
		protected $table = 'comments';
		protected $allowedFields = [
			'description', 
            'user_id',
            'file_id',
			'rating'
		];

		public function getComments($fileID)
		{
            $users = new UserModel();
            $users = $users->findAll();

			$sql = "SELECT * FROM " . $this->table . " WHERE file_id = " . $fileID . " ORDER BY rating DESC";

			$data['comments'] = $this->query($sql)->getResultArray();

            // Add relevant comment names to comments
            foreach ($data['comments'] as &$comment) {
                foreach ($users as $user) {

                    if ($comment['user_id'] == $user['id']) {
                        $comment['firstName'] = $user['firstName'];
                        $comment['lastName'] = $user['lastName'];
                    }
                }
            }

            return $data;
		}

		public function saveComment($description, $user_id, $file_id, $rating)
		{
			$data = [
				'description' => $description,
				'user_id' => $user_id,
				'file_id' => $file_id,
				'rating' => $rating
			];

			$this->save($data);
		}

		public function deleteComments($fileID)
		{
			$sql = "DELETE FROM " . $this->table . " WHERE file_id = " . $fileID;

			$this->query($sql);
		}

		public function incrementComment($commentID)
		{
			$sql = "UPDATE " . $this->table . " SET rating = rating + 1 WHERE id = " . $commentID;

			$this->query($sql);
		}

		public function decrementComment($commentID)
		{
			$sql = "UPDATE " . $this->table . " SET rating = rating - 1 WHERE id = " . $commentID;

			$this->query($sql);
		}
	}
?>