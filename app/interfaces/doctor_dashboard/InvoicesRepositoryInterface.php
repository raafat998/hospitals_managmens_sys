<?php

namespace App\Interfaces\doctor_dashboard;

interface InvoicesRepositoryInterface
{
        public function index();
        
        public function reviewInvoices();

        public function completedInvoices();
}