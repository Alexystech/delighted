<?php
namespace Welldex\Entities;

class SurveyResponse
{
    private string $id;
    private string $person;
    private string $survey_type;
    private int $score;
    private string $comment;
    private string $permalink;
    private int $created_at;
    private int $updated_at;

    public function __construct(string $id, string $person, string $survey_type, int $score, string $comment, string $permalink, int $created_at, int $updated_at)
    {
        $this->id = $id;
        $this->person = $person;
        $this->survey_type = $survey_type;
        $this->score = $score;
        $this->comment = $comment;
        $this->permalink = $permalink;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function setPerson(string $person)
    {
        $this->person = $person;
    }

    public function setSurveyType(string $survey_type)
    {
        $this->survey_type = $survey_type;
    }

    public function setScore(int $score)
    {
        $this->score = $score;
    }

    public function setComment(string $comment)
    {
        $this->comment = $comment;
    }

    public function setPermalink(string $permalink)
    {
        $this->permalink = $permalink;
    }

    public function setCreatedAt(int $created_at) 
    {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt(int $updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPerson()
    {
        return $this->person;
    }

    public function getSurveyType()
    {
        return $this->survey_type;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getPermalink()
    {
        return $this->permalink;
    }

    public function getCreatedAt() 
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
?>