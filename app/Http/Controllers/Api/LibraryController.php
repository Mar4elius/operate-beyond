<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\StoreLibraryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Library;

class LibraryController extends Controller
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
     * @param  \Illuminate\Http\StoreLibraryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLibraryRequest $request)
    {

        $library = Library::create($request->all());

        return response()->json([
            'message'       => 'Library has been created.',
            'library'       => $library
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
        $libraries = Library::all();

        return response()->json([
            'libraries' => $libraries
        ]);
    }
}
