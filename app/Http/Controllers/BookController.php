<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    private $bookModel;

    public function __construct(Book $bookModel) {
        $this->bookModel = $bookModel;
    }

    /**
     * Fetch books offered by a specific place
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Get(
     *     path="/api/books",
     *     description="Returns books.",
     *     operationId="api.book.index",
     *     produces={"application/json"},
     *     tags={"Books"},
     *     @SWG\Parameter(
     *         name="siteType",
     *         in="query",
     *         description="Site Type",
     *         required=false,
     *         type="string",
     *         enum={"book_store", "library", "kiosk"}
     *     ),
     *     @SWG\Parameter(
     *         name="searchBy",
     *         in="query",
     *         description="Search By",
     *         required=false,
     *         type="string",
     *         enum={"title", "author", "site_name", "site_owner", "site_neighborhood", "site_newspaper"}
     *     ),
     *     @SWG\Parameter(
     *         name="searchText",
     *         in="query",
     *         description="Search Text",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Book List."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * )
     */
    public function index(Request $request) {
        $siteType = $request->get('siteType');
        $searchBy = $request->get('searchBy');
        $searchText = $request->get('searchText');
        $result = $this->bookModel
            ->with('book_site', 'book_site.book_site_type')
            ->when($siteType, function($query) use ($siteType) {
                $query->whereHas('book_site.book_site_type', function($q) use($siteType) {
                    $q->where('type', $siteType);
                });
            })
            ->when($searchText, function($query) use($searchBy, $searchText) {
                $siteInfoFields = ['site_owner', 'site_neighborhood', 'site_newspaper'];
                if (in_array($searchBy, $siteInfoFields)) {
                    $query->whereHas('book_site', function($q) use($searchText) {
                        $q->where('site_info', 'like', '%'.$searchText.'%');
                    });
                } else {
                    $query->where($searchBy, 'like', '%'.$searchText.'%');
                }
            })
            ->get();

        $message = "Sucessfully returned ".count($result)." item(s)";
        return $this->response($result, $message, 200);
    }

}
