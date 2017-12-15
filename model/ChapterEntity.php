<?php
class ChapterEntity
{
    protected $id;
    protected $chapter;
    protected $title;
    protected $content; 
    protected $creation_date;
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

    public function getChapter()
    {
        return $this->chapter;
    }
      
    public function setChapter($chapter)
    {
        $this->chapter = $chapter;
        return $this;
    } 

    public function getTitle()
    {
        return $this->title;
    }
     
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }
     
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function getCreation_date()
    {
        return $this->creation_date;
    }
     
    public function setCreation_date($creation_date)
    {
        $this->creation_date = $creation_date;
        return $this;
    }

    public function getUpdate_date()
    {
        return $this->update_date;
    }
     
    public function setUpdate_date($update_date)
    {
        $this->update_date = $update_date;
        return $this;
    }
}
?>