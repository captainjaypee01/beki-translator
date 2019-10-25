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
        $translates = Translate::where('name', 'like' , '%' . request('q') . '%')->where('language', request('language'))->get();
        $words = null;
        if(count($translates) > 0){
            $grouped = Translate::where('name', 'like' , '%' . request('q') . '%')->where('language', request('language'))->groupBy('word_id')->get();
            Log::info($grouped);
            if(count($grouped) > 1){
                $wordIds = Translate::where('name', 'like' , '%' . request('q') . '%')->where('language', request('language'))->groupBy('word_id')->pluck('word_id');
                $words = Word::whereIn('id', $wordIds)->get();
            }
            else if(count($grouped) > 0){
                $trans = Translate::where('name', 'like' , '%' . request('q') . '%')->where('language', request('language'))->first();
                $words = Word::find($trans->word_id);
            }
            else{
                $words = null;
            }
        }
        return response()->json(['data' => request('q'), 'words' => $words]);
    }
}
