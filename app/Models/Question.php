<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'id_questions';
    public $incrementing = true;
    protected $fillable = ['question_text'];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id_questions');
    }

    public function responses()
    {
        return $this->hasMany(Response::class, 'question_id', 'id_questions');
    }
}