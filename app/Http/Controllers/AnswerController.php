<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    private $answers;

    public function __construct(Answer $answers)
    {
        $this->answers = $answers;
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
            $answer = new Answer;
            $answer->question_id = $request->question_id;
            $answer->answer = $request->answer;
            $answer->right = $request->right;
            $answer->save();
            return response()->json([
                'data' => $answer
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao salvar resposta'
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
            $answer = $this->answers->findOrFail($id);
            return response()->json([
                'data' => $answer
            ], 200);
        } catch (\Exception $e) {
            return response()->json([[
                'message' => 'Resposta não encontrada'
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
            $answer = $this->answers->findOrFail($id);
            $answer->answer = $request->answer;
            $answer->right = $request->right;
            $answer->save();
            return response()->json([
                'data' => $answer
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar resposta'
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
            $answer = $this->answers->findOrFail($id);
            $answer->delete();
            return response()->json([
                'data' => $answer
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar resposta'
            ]);
        }
    }
}
