<?php

namespace App\Http\Controllers;

use App\BookSite;
use Illuminate\Http\Request;

class BookSiteController extends Controller
{
    private $bookSiteModel;

    public function __construct(BookSite $bookSiteModel) {
        $this->bookSiteModel = $bookSiteModel;
    }

    /**
     * Fetch books offered by a specific place
     *
     * @param Request $request
     * @return void
     *
     * @SWG\Get(
     *     path="/api/book_sites",
     *     description="Returns book sites.",
     *     operationId="api.book_sites.index",
     *     produces={"application/json"},
     *     tags={"Book Sites"},
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
     *         enum={"name", "owner", "neighborhood", "newspaper"}
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
     *         description="Book Site List."
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
        $result = $this->bookSiteModel
            ->with('book_site_type', 'books')
            ->when($siteType, function($query) use ($siteType) {
                $query->whereHas('book_site_type', function($q) use($siteType) {
                    $q->where('type', $siteType);
                });
            })
            ->when($searchText, function($query) use($searchBy, $searchText) {
                $siteInfoFields = ['owner', 'neighborhood', 'newspaper'];
                if (in_array($searchBy, $siteInfoFields)) {
                    $query->where('site_info', 'like', '%'.$searchText.'%');
                } else {
                    $query->where($searchBy, 'like', '%'.$searchText.'%');
                }
            })
            ->get();

        $message = "Sucessfully returned ".count($result)." item(s)";
        return $this->response($result, $message, 200);
    }

    /**
     * Fetch books offered by a specific place
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/api/book_sites/{id}",
     *     description="Returns specified book site.",
     *     operationId="api.book_sites.show",
     *     produces={"application/json"},
     *     tags={"Book Sites"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID",
     *         required=false,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Book Site List."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * )
     */
    public function show($id) {
        $result = $this->bookSiteModel
            ->with('book_site_type', 'books')
            ->where('id', $id)
            ->first();

        $message = "Sucessfully returned an item";
        return $this->response($result, $message, 200);
    }

}
