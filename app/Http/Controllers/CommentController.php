<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Book;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Book $book)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'comment_text' => ['required', 'min:1', 'max:1000'],
            'book_id' => ['required'],
            'user_id' => ['required']
        ]);

        Comment::create($validatedData);

        return redirect('/dashboard/books/' . $book->id . '#comment-section')->with('successComment', 'Komentar Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        // Check if the authenticated user is the owner of the comment
        if (auth()->user()->id === $comment->user_id) {
            $comment->delete();
            return redirect('/dashboard/books/' . $comment->book_id . '#comment-section')->with('successDeleteComment', 'Komentar Berhasil Dihapus!');
        } else {
            return redirect('/dashboard/books/' . $comment->book_id . '#comment-section')->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
        }
    }

}
