<?php

namespace App\Http\Controllers\Api;
// Support
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
// Models
use App\Models\Author;
use App\Models\Book;
use App\Models\Library;
// Requests
use Illuminate\Http\Request;
use App\Http\Requests\Books\StoreBookRequest;
use App\Http\Requests\Books\UpdateBookRequest;

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
     * @param  \Illuminate\Http\StoreBookRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request): JsonResponse
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
            'book'      => $book,
            'message'   => "Book has been saved."
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
     * @param  App\Http\Requests\Books\UpdateBookRequest $request
     * @param  App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        Book::find($book->id)->author()->dissociate();
        $book->name = $request->name;
        $book->year = $request->year;

        $author = Author::find($request->author_id);
        $book->author()->associate($author);
        $book->save();

        // sync many-to-many on libraries
        if (!empty($request->libraries)) {
            $ids = array_column($request->libraries, 'id');
            $book->libraries()->sync($ids);
        }

        if (isset($request->library_id)) {
            $library = Library::find($request->library_id);
            $book->libraries()->attach($library->id);
        }

        return response()->json([
            'message' => 'Book has been updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Book $book
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book): JsonResponse
    {
        $book->author()->dissociate();
        $book->delete();

        return response()->json([
            'message' => "Book has been deleted."
        ]);
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
