<?php

namespace App\Http\Controllers\Business;

use App\Models\Business\Statement;
use App\Models\Business\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatementController extends Controller
{
    public function index(Request $request)
    {
        $data = Statement::with('tag')->get();
        $tags = Tag::all();

        if ($request->ajax() || $request->isJson()) {
            return response()->json($data);
        }
        
        return view('pages.statement-page', compact('data', 'tags'));
    }

    public function filter(Tag $tag)
    {
        $data = Statement::with('tag')->where('tag_id', $tag->id)->get();
        
        return response()->json($data);
    }
}
