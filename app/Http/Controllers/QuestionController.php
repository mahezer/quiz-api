<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    private $questions;
    private $answers;

    public function __construct(Question $questions, Answer $answers)
    {
        $this->questions = $questions;
        $this->answers = $answers;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->questions->all();
        return response()->json([
            'data' => $questions
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $question = new Question;
            $question->question = $request->question;
            $question->save();
            return response()->json([
                'data' => $question
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao salvar pergunta'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        try {
            $question = $this->questions->findOrFail($id);
            $answers = $question->answers;
            return response()->json([
                'data' => ['pergunta' => $question, 'respostas' => $answers]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([[
                'message' => 'Pergunta não encontrada'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $question = $this->questions->findOrFail($id);
            $question->question = $request->question;
            $question->save();
            return response()->json([
                'data' => $question
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar pergunta'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $question = $this->questions->findOrFail($id);
            $question->delete();
            return response()->json([
                'data' => $question
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar pergunta'
            ]);
        }
    }
}
