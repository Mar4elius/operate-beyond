<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Library;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $book = new Book();

        $book->name = $request->name;
        $book->year = $request->year;

        $author = Author::find($request->author_id);
        $book->author()->associate($author);
        $book->save();

        if (isset($request->library_id)) {
            $library = Library::find($request->library_id);
            $book->libraries()->attach($library->id);
        }

        return response()->json([
            'message' => "Book has been saved."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Search books
     *
     * @return \Illuminate\Http\Response
     */
    public function search(): JsonResponse
    {
        $books = Book::with(['author', 'libraries'])
            ->get();

        return response()->json([
            'books' => $books
        ]);
    }
}
