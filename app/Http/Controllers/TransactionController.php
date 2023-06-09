<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TransferService;

class TransactionController extends Controller
{

    public function __construct(protected TransferService $transferService)
    {
        $this->transferService=$transferService;

    }

    public function index()
    {

    }
    public function show()
    {

    }
    public function create()
    {

    }
    public function update()
    {

    }
    public function delete()
    {
        
    }

}
