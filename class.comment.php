<?php
class Comment
{
  private $comment;
  private $commenter;

    public function __construct($commenter, $comment) {
        $this->comment = $comment;
        $this->commenter = $commenter;
    }

    public function getComment() {
        return $this->comment;
    }

    public function getCommenter() {
        return $this->commenter;
    }
}
?>
