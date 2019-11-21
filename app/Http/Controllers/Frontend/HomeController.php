<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Record\Translate;
use App\Models\Record\Word;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Log;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // $translations = Translate::groupBy("word_id")->select('*', DB::raw('count(*) as total'))->get();
        // $translations = DB::table('translates')->groupBy("word_id")->first();
        // dd($translations);
        
        return view('frontend.index');
    }

    public function translate(){
        $q = request('q');
        $likeData = '%' . $q . '%';
        $translates = Translate::where(function($query) use ($likeData){
                                $query->where('name', 'like', $likeData)
                                    ->orWhere('root_word', 'like', $likeData);
                            })->where('language', request('language'))->get();
        $words = null;
        if(count($translates) > 0){
            $grouped = Translate::where(function($query) use ($likeData){
                                $query->where('name', 'like', $likeData)
                                    ->orWhere('root_word', 'like', $likeData);
                            })->where('language', request('language'))->groupBy('word_id')->get();
            Log::info($grouped);
            if(count($grouped) > 1){
                $wordIds = Translate::where(function($query) use ($likeData){
                                    $query->where('name', 'like', $likeData)
                                        ->orWhere('root_word', 'like', $likeData);
                                })->where('language', request('language'))->groupBy('word_id')->pluck('word_id');
                $words = Word::whereIn('id', $wordIds)->get();
            }
            else if(count($grouped) > 0){
                $trans = Translate::where(function($query) use ($likeData){
                                    $query->where('name', 'like', $likeData)
                                        ->orWhere('root_word', 'like', $likeData);
                                })->where('language', request('language'))->first();
                $words = Word::find($trans->word_id);
            }
            else{
                $words = null;
            }
        }
        return response()->json(['data' => request('q'), 'words' => $words]);
    }

    public function translateWithSpace(){
        $sentence = strtolower(request('q'));
        $translates = Translate::where(function($query) use ($sentence){
                                $query->where('name', 'like', $sentence)
                                    ->orWhere('root_word', 'like', $sentence);
                            })->where('language', request('language'))->get();
        
        $output = null;
        $result = "";
        $sentenceWord = "";
        $grouped = new Collection();
        $allTranslates = Translate::where('status', 1)->orderByRaw('CHAR_LENGTH(name)', 'DESC')->get(); 
        // echo $sentence;
        // echo '<br>';
        foreach($allTranslates as $t){
            if(strpos($sentence, strtolower($t->name)) !== false){
                $output[] = Word::find($t->word_id);
                $sentenceWord = strtolower($t->name);
                $result = "";

                if($output){
                    if(count($output) > 0){
                        foreach($output as $out){
                            $result .= $out->name ." ";
                        }
                    }
                }
                $sentence = str_replace(strtolower($t->name), ' ', strtolower($sentence));
                // echo $sentence;
                // echo 1;
            }
        }
        // echo $sentence;
        // exit();
        // if(count($translates) > 0){
        //     $grouped = Translate::where(function($query) use ($sentence){
        //                         $query->where('name', 'like', $sentence)
        //                             ->orWhere('root_word', 'like', $sentence);
        //                     })->where('language', request('language'))->groupBy('word_id')->get();
        //     if(count($grouped) > 0){
        //         $trans = Translate::where(function($query) use ($sentence){
        //                             $query->where('name', 'like', $sentence)
        //                                 ->orWhere('root_word', 'like', $sentence);
        //                         })->where('language', request('language'))->first();
        //         $output[] = Word::find($trans->word_id);
        //         $sentenceWord = strtolower($trans->name);
        //         $result = "";

        //         if($output){
        //             if(count($output) > 0){
        //                 foreach($output as $out){
        //                     $result .= $out->name ." ";
        //                 }
        //             }
        //         }
        //         echo "te";
        //         $sentence = str_replace($sentenceWord, '', strtolower($sentence));
        //         echo $sentence;
        //         // return response()->json(['data' => request('q'), 'output' => $output, 'result' => $result]);
        //     }
        //     else{
        //         $output[] = null;
        //     }
        // }
        // if(count($grouped) > 0){
        //     $sentence = str_replace($sentenceWord, '', strtolower($sentence));
        //     echo $sentence;
        // }
        // echo $sentence;
        // exit();
        // echo $sentence;
        // exit(); 
        $thetextstring = preg_replace("#[\s]+#", " ", $sentence);
        $listedWords = explode(" ", $thetextstring);
        
        // echo $thetextstring;
        // print_r($listedWords);
        // exit();
        foreach($listedWords as $word){
            if($word != ""){
                $likeData = '%' . $word . '%';
                $translates = Translate::where(function($query) use ($likeData){
                                        $query->where('name', 'like', $likeData)
                                            ->orWhere('root_word', 'like', $likeData);
                                    })->where('language', request('language'))->get();
                $words = null;
                if(count($translates) > 0){
                    $grouped = Translate::where(function($query) use ($likeData){
                                        $query->where('name', 'like', $likeData)
                                            ->orWhere('root_word', 'like', $likeData);
                                    })->where('language', request('language'))->groupBy('word_id')->get();
                    Log::info($grouped);
                    if(count($grouped) > 0){
                        $trans = Translate::where(function($query) use ($likeData){
                                            $query->where('name', 'like', $likeData)
                                                ->orWhere('root_word', 'like', $likeData);
                                        })->where('language', request('language'))->first();
                        $output[] = Word::find($trans->word_id);
                    }
                    else{
                        $output[] = null;
                    }
                } 
            }

        }
        // print_r($output);
        // exit();
        // $result = "";
        if($output){
            if(count($output) > 0){
                foreach($output as $out){
                    $result .= $out->name ." ";
                }
            }
        }
        return response()->json(['data' => request('q'), 'output' => $output, 'result' => $result]);
        dd($result);
    }
}
