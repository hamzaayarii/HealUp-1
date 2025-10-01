<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdviceController extends Controller
{
    public function index()
    {
        $advices = Advice::latest()->paginate(10);
        return view('admin.advices.index', compact('advices'));
    }

    public function create()
    {
        return view('admin.advices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'source'  => 'required|in:AI,professor,system',
            'user_id' => 'required|exists:users,id',
        ]);

        Advice::create([
            'user_id'   => $request->user_id,
            'advisor_id'=> auth()->id(),   // the professor or admin logged in
            'title'     => $request->title,
            'content'   => $request->content,
            'source'    => $request->source,
            'is_read'   => false,
        ]);

        return redirect()->route('admin.advices.index')->with('success', 'Advice created successfully.');
    }

    public function update(Request $request, Advice $advice)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'source'  => 'required|in:AI,professor,system',
            'is_read' => 'boolean',
        ]);

        $advice->update($request->all());

        return redirect()->route('admin.advices.index')->with('success', 'Advice updated successfully.');
    }


    public function show(Advice $advice)
    {
        return view('admin.advices.show', compact('advice'));
    }

    public function edit(Advice $advice)
    {
        return view('admin.advices.edit', compact('advice'));
    }

    public function destroy(Advice $advice)
    {
        $advice->delete();
        return redirect()->route('admin.advices.index')->with('success', 'Advice deleted successfully.');
    }
}
