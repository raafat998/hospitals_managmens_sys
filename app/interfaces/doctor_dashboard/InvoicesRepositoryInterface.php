<?php

namespace App\Interfaces\doctor_dashboard;

interface InvoicesRepositoryInterface
{
        public function index();
        
        public function reviewInvoices();

        public function completedInvoices();

            // View rays
    public function show($id);
}