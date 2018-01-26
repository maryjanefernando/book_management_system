<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionPost;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionModel;

    public function __construct(Transaction $transactionModel) {
        $this->transactionModel = $transactionModel;
    }

    /**
     * Fetch transactions initiated by a specific employee
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Get(
     *     path="/api/transactions",
     *     description="Returns transactions.",
     *     operationId="api.transactions.index",
     *     produces={"application/json"},
     *     tags={"Transactions"},
     *     @SWG\Parameter(
     *         name="searchBy",
     *         in="query",
     *         description="Search By",
     *         required=false,
     *         type="string",
     *         enum={"employee_id", "employee_first_name", "employee_last_name"}
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
     *         description="Transaction List."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * )
     */
    public function index(Request $request) {
        $searchBy = $request->get('searchBy');
        $searchText = $request->get('searchText');
        $result = $this->transactionModel
            ->with('employee', 'customer', 'book')
            ->when($searchText, function($query) use($searchBy, $searchText) {
                if ($searchBy == 'employee_first_name' || $searchBy == 'employee_last_name') {
                    $searchBy = ($searchBy == 'employee_first_name') ? "first_name" : "last_name";
                    $query->whereHas('employee', function($q) use($searchBy, $searchText) {
                        $q->where($searchBy, 'like', '%'.$searchText.'%');
                    });
                } else {
                    $query->where($searchBy, $searchText);
                }
            })
            ->get();

        $message = "Sucessfully returned ".count($result)." item(s)";
        return $this->response($result, $message, 200);
    }


    /**
     * Create a transaction
     *
     * @param StoreTransactionPost $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *     path="/api/transactions",
     *     description="Stores transactions.",
     *     operationId="api.transactions.store",
     *     produces={"application/json"},
     *     tags={"Transactions"},
     *     @SWG\Parameter(
     *         name="employee_id",
     *         in="formData",
     *         description="",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="customer_id",
     *         in="formData",
     *         description="",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="book_id",
     *         in="formData",
     *         description="",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Transaction List."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * )
     */
    public function store(StoreTransactionPost $request) {
        $data = $this->transactionModel->create([
            'employee_id' => $request->get('employee_id'),
            'customer_id' => $request->get('customer_id'),
            'book_id' => $request->get('book_id'),
        ]);
        $result = $this->transactionModel->with('employee', 'customer', 'book')->find($data['id']);
        $message = "Sucessfully created new transaction";
        return $this->response($result, $message, 200);

    }

}
