<?php
	class ModerationEntity{
		protected $id;
		protected $id_comment;
		protected $chapter_id;
		protected $cause;
		protected $moderation_date;

		public function getId()
		{
		    return $this->id;
		}
		 
		public function setId($id)
		{
		    $this->id = $id;
		    return $this;
		}

		public function getId_comment()
		{
		    return $this->id_comment;
		}
		 
		public function setId_comment($id_comment)
		{
		    $this->id_comment = $id_comment;
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

		public function getCause()
		{
		    return $this->cause;
		}
		 
		public function setCause($cause)
		{
		    $this->cause = $cause;
		    return $this;
		}

		public function getModeration_date()
		{
		    return $this->moderation_date;
		}
		 
		public function setModeration_date($moderation_date)
		{
		    $this->moderation_date = $moderation_date;
		    return $this;
		}
	}