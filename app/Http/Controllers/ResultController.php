<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class ResultController extends BaseController
{
    public function getResults(CreateRequest $request)
    {
        $inputs = $request->all();
        try{
            $results = $this->calculateResults($inputs);
            $virusComposition = $inputs['virus_composition'];
            // return response()->view('results', $results, 200);
            return view('results',compact(['results','virusComposition']));
        }
        catch(Exception $exception){
            Log::error($exception);
            
        }
    }

    private function calculateResults($inputs)
    {
        $results = null;
        foreach($inputs['blood_composition'] as $bloodComposition){
            $position = 0;
            $result = "POSITIVE";
            for($i = 0 ; $i < strlen($bloodComposition);$i++){
                $temp = false;
                for($j = $position;$j < strlen($inputs['virus_composition']);$j++){
                    if (substr($bloodComposition,$i,1) == substr($inputs['virus_composition'],$j,1)){
                        $temp = true;
                        $position = $j;
                        break;
                    }
                }
                if ($temp == false){
                    $result = "NEGATIVE";
                    break;
                }
            }
            $results[] = [ 'name' => $bloodComposition, 'result' => $result];
       }
       return $results;
    }
}
