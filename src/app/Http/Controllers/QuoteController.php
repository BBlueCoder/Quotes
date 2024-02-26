<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        return view("quotes.index", ['quotes' => Quote::with('user')->get()]);
    }

    function create()
    {
        return view("quotes.create");
    }

    function save(Request $request)
    {
        $formFields = $request->validate([
            'author' => ['required'],
            'content' => ['required']
        ]);

        $formFields['created_by'] = auth()->user()->id;

        Quote::create($formFields);

        return redirect('/')->status(200);
    }
}
