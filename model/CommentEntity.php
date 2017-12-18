<?php
	class CommentEntity{
		protected $id;
		protected $chapter_id;
		protected $user_id;
		protected $author;
		protected $comment;
		protected $comment_date;
		protected $update_date;

		public function getId()
		{
		    return $this->id;
		}
		 
		public function setId($id)
		{
		    $this->id = $id;
		    return $this;
		}

		public function getChapterId()
		{
		    return $this->chapterId;
		}
		 
		public function setChapterId($chapterId)
		{
		    $this->chapterId = $chapterId;
		    return $this;
		}

		public function getUserId()
		{
		    return $this->userId;
		}
		 
		public function setUserId($userId)
		{
		    $this->userId = $userId;
		    return $this;
		}

		public function getAuthor()
		{
		    return $this->author;
		}
		 
		public function setAuthor($author)
		{
		    $this->author = $author;
		    return $this;
		}

		public function getComment()
		{
		    return $this->comment;
		}
		 
		public function setComment($comment)
		{
		    $this->comment = $comment;
		    return $this;
		}

		public function getCommentDate()
		{
		    return $this->commentDate;
		}
		 
		public function setCommentDate($commentDate)
		{
		    $this->commentDate = $commentDate;
		    return $this;
		}

		public function getUpdateDate()
		{
		    return $this->updateDate;
		}
		 
		public function setUpdateDate($updateDate)
		{
		    $this->updateDate = $updateDate;
		    return $this;
		}
	}