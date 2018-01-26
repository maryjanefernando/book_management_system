<?php

namespace App\Http\Requests;

use App\Book;
use App\Customer;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'employee_id' => 'required',
            'customer_id' => 'required',
            'book_id' => 'required',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function($validator) {
            if (!$this->isEmployeeIdValid()) {
                $validator->errors()->add('employee_id', 'Employee is non-existent');
            }
            if (!$this->isCustomerIdValid()) {
                $validator->errors()->add('customer_id', 'Customer is non-existent');
            }
            if (!$this->isBookIdValid()) {
                $validator->errors()->add('book_id', 'Book is non-existent');
            }
        });
    }

    protected function isEmployeeIdValid() {
        $employee = User::find($this->request->get('employee_id'));
        return !empty($employee);
    }

    protected function isCustomerIdValid() {
        $customer = Customer::find($this->request->get('customer_id'));
        return !empty($customer);
    }

    protected function isBookIdValid() {
        $book = Book::find($this->request->get('book_id'));
        return !empty($book);
    }

}
