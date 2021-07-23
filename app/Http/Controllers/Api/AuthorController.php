<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\StoreAuthorRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Author;
use Carbon\Carbon;


class AuthorController extends Controller
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
     * @param  \Illuminate\Http\StoreAuthorRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuthorRequest $request): JsonResponse
    {
        $author = new Author();
        $author->name = $request->name;
        $author->birth_date = Carbon::parse($request->birth_date);
        $author->genre = $request->genre;
        $author->save();

        return response()->json([
            'message'   => 'Author has been created.',
            'author'    => $author
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
     * Search authors
     *
     * @return \Illuminate\Http\Response
     */
    public function search(): JsonResponse
    {
        $authors = Author::all();

        return response()->json([
            'authors' => $authors
        ]);
    }
}
