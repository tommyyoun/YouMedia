<?php

	namespace App\Models;

	use CodeIgniter\Model;

	class LikeModel extends Model {
		protected $db;
		protected $table = 'users_comments';
		protected $allowedFields = [
			'user_id', 
            'comment_id',
            'isLike'
		];

		public function userCommentExists($user_id, $comment_id)
		{
			$sql = "SELECT * FROM " . $this->table . " WHERE user_id = " . $user_id . " AND comment_id = " . $comment_id;

			$num_rows = $this->query($sql)->getNumRows();

			if ($num_rows > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function isLike($user_id, $comment_id)
		{
			$sql = "SELECT isLike FROM " . $this->table . " WHERE user_id = " . $user_id . " AND comment_id = " . $comment_id;

			$result = $this->query($sql)->getResultArray();

			var_dump($result);

			return $result[0]['isLike'];
		}

		public function setLike($user_id, $comment_id, $likeBool)
		{
			if ($likeBool)
			{
				$sql = "UPDATE " . $this->table . " SET isLike = true WHERE user_id = " . $user_id . " AND comment_id = " . $comment_id;
			}
			else
			{
				$sql = "UPDATE " . $this->table . " SET isLike = false WHERE user_id = " . $user_id . " AND comment_id = " . $comment_id;
			}


			$this->query($sql);
		}
	}
?>