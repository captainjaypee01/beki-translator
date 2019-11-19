<?php

namespace App\Http\Controllers\Frontend\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Record\Translate;
use App\Models\Record\Word; 

class WordListController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $words = Word::orderBy("created_at", "desc");
        $append = array();
        if($keyword = request("search")){
            $append["search"] = $keyword;
            $words = $words->where("name", "like", "%". $keyword . "%");
        }

        $words = $words->paginate(10)->setpath('');
        $words->appends($append); 
        return view('frontend.record.word.index',
            [ 
                "search" => $keyword,
                "words" => $words,
            ]); 
    }

    public function create(){ 
        return view('frontend.record.word.create',
            [  
            ]);
    }

    public function show(Word $word){
        return view('frontend.record.word.show',
            [ 
                "word" => $word, 
                "wordTranslations" => $word->translates->all()
            ]);
    }

    public function edit(Word $word){
        return view('frontend.record.word.edit',
            [ 
                "word" => $word,  
            ]);
    }

    public function editTranslate(Word $word, Translate $translate){
        return view('frontend.record.word.translate.edit',
            [ 
                "word" => $word, 
                "translate" => $translate,   
            ]);
    }

    public function store(Request $request){
        $word = new Word();
        return $this->save($request, $word);
    }

    public function update(Request $request, Word $word){
        return $this->save($request, $word);
    }
    public function destroy(Word $word){
        $word->delete();
        return redirect()->route('frontend.record.word.index')->withFlashSuccess("Word Successfully Deleted");
    }

    public function save($form, $word){
        // Validate
        $data = request()->validate([
            'name' => 'required',  
            'description' => 'required', 
        ]);
        // Log::info(request());
        // dd(request());
        if(isset($form['name']))
            $word->name = ucwords($form["name"]);
 
        if(isset($form['description']))
            $word->description = $form['description'];
        
        $word->user_id = auth()->user()->id;
        $word->status = 0;
        $word->save();
         
        return redirect(route('frontend.record.word.show', $word) . "#translations")->withFlashSuccess("Word Successfully Saved");

    }
    public function mark(Word $word, $status){
        $word->status = $status;
        $word->save();
        return redirect()->route('frontend.record.word.index')->withFlashSuccess("Word Status Saved");
    }
    
    public function addTranslation(Word $word){
        // Validate
        $data = request()->validate([
            'name' => 'required',  
            'root_word' => 'required', 
        ]);
        $translate = new Translate();
        $translate->user_id = auth()->user()->id;
        $translate->name = request('name');
        $translate->root_word = request('root_word');
        $translate->word_id = $word->id;
        $translate->language = request('language');
        $translate->save();
        return redirect(route('frontend.record.word.show', $word) . "#translations")->withFlashSuccess("Translation Successfully Added");
    }

    public function updateTranslation(Word $word, Translate $translate){
        // Validate
        $data = request()->validate([
            'name' => 'required',  
            'root_word' => 'required',  
        ]);
         
        $translate->name = request('name');
        $translate->root_word = request('root_word'); 
        $translate->language = request('language');
        $translate->save();
        return redirect(route('frontend.record.word.show', $word) . "#translations")->withFlashSuccess("Translation Successfully Updated");
    }

    public function removeTranslation(Word $word, Translate $translate){
        $translate->delete();
        return redirect(route('frontend.record.word.show', $word) . "#translations")->withFlashSuccess("Translate Successfully Removed");
    }
}
