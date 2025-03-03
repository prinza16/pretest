<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';
    protected $primaryKey = 'id_answers';
    public $incrementing = true;
    protected $fillable = ['question_id', 'answer_text'];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id_questions');
    }

    public function responses()
    {
        return $this->hasMany(Response::class, 'answer_id', 'id_answers');
    }
}
