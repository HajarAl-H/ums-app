<?php

namespace App\Http\Controllers;

use App\Models\Company;

class CompanyController extends Controller
{
    // GET /api/companies
    public function index()
    {
        return Company::orderBy('name')->get(['id', 'name']);
    }
}
