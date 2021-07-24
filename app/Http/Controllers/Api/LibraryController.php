<?php

namespace App\Http\Controllers\Api;
// Support
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
// Models
use App\Models\Library;
// Requests
use Illuminate\Http\Request;
use App\Http\Requests\Library\StoreLibraryRequest;
use App\Http\Requests\Library\UpdateLibraryRequest;

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
     * @param  App\Http\Requests\Library\UpdateLibraryRequest
     * @param  App\Models\Library $library
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLibraryRequest $request, Library $library): JsonResponse
    {
        $library->name = $request->name;
        $library->address = $request->address;
        $library->save();

        return response()->json([
            'message' => 'Library has been updated.'
        ]);
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
