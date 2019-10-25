<?php

namespace App\Http\Controllers\Backend\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Record\Translate;
use App\Models\Record\Word;
use Log;

class WordController extends Controller
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
        return view('backend.record.word.index',
            [ 
                "search" => $keyword,
                "words" => $words,
            ]); 
    }

    public function create(){ 
        return view('backend.record.word.create',
            [  
            ]);
    }

    public function show(Word $word){
        return view('backend.record.word.show',
            [ 
                "word" => $word, 
                "wordTranslations" => $word->translates->all()
            ]);
    }

    public function edit(Word $word){
        return view('backend.record.word.edit',
            [ 
                "word" => $word,  
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
        return redirect()->route('admin.record.word.index')->withFlashSuccess("Word Successfully Deleted");
    }

    public function save($form, $word){
        // Validate
        $data = request()->validate([
            'name' => 'required',  
            'description' => 'required',
            'translates' => 'required',
        ]);
        // Log::info(request());
        // dd(request());
        if(isset($form['name']))
            $word->name = ucwords($form["name"]);
 
        if(isset($form['description']))
            $word->description = $form['description'];
        
        $word->save();
        
        if(isset($form['translates'])){
            foreach($form['translates'] as $t){
                $translate = new Translate();
                $translate->name = $t;
                $translate->word_id = $word->id;
                $translate->language = "english";
                $translate->save();
            } 
        }
        return redirect()->route('admin.record.word.show', $word)->withFlashSuccess("Word Successfully Saved");

    }
    public function mark(Word $word, $status){
        $word->status = $status;
        $word->save();
        return redirect()->route('admin.record.word.index')->withFlashSuccess("Word Status Saved");
    }
    
    public function addTranslation(Word $word){
        // Validate
        $data = request()->validate([
            'name' => 'required',  
        ]);
        $translate = new Translate();
        $translate->name = request('name');
        $translate->word_id = $word->id;
        $translate->language = "english";
        $translate->save();
        return redirect()->route('admin.record.word.show', $word)->withFlashSuccess("Translation Successfully Added");
    }

    public function removeTranslation(Word $word, Translate $translate){
        $translate->delete();
        return redirect()->route('admin.record.word.show', $word)->withFlashSuccess("Translate Successfully Removed");
    }
}
