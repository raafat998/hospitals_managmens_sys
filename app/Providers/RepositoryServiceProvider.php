<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Doctors\DoctorRepository;
use App\Repository\Finance\PaymentRepository;
use App\Repository\Finance\ReceiptRepository;
use App\Repository\Patients\PatientRepository;
use App\Repository\Sections\SectionRepository;
use App\Repository\Ambulances\AmbulanceRepository;
use App\Repository\insurances\insuranceRepository;
use App\Repository\doctor_dashboard\RaysRepository;
use App\Repository\Services\SingleServiceRepository;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Repository\RayEmployee\RayEmployeeRepository;
use App\Interfaces\Finance\PaymentRepositoryInterface;
use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\interfaces\Sections\SectionRepositoryInterface;
use App\Repository\doctor_dashboard\InvoicesRepository;
use App\Repository\doctor_dashboard\DiagnosisRepository;
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\Interfaces\insurances\insuranceRepositoryInterface;
use App\Interfaces\doctor_dashboard\RaysRepositoryInterface;
use App\Interfaces\Services\SingleServiceRepositoryInterface;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use App\Interfaces\doctor_dashboard\DiagnosisRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);

        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
    
        $this->app->bind(SingleServiceRepositoryInterface::class, SingleServiceRepository::class);

        $this->app->bind(insuranceRepositoryInterface::class, insuranceRepository::class);

        $this->app->bind(AmbulanceRepositoryInterface::class, AmbulanceRepository::class);

        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);

        $this->app->bind(ReceiptRepositoryInterface::class, ReceiptRepository::class);
    
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);

        $this->app->bind(InvoicesRepositoryInterface::class, InvoicesRepository::class);
        
        $this->app->bind(DiagnosisRepositoryInterface::class, DiagnosisRepository::class);
    
        $this->app->bind(RaysRepositoryInterface::class, RaysRepository::class);

        $this->app->bind(RayEmployeeRepositoryInterface::class, RayEmployeeRepository::class);

        // $this->app->bind(LaboratoriesRepositoryInterface::class, LaboratoriesRepository::class);


        //Dashboard_Ray_Employee

        $this->app->bind('App\Interfaces\Dashboard_Ray_Employee\InvoicesRepositoryInterface',
                'App\Repository\Dashboard_Ray_Employee\InvoicesRepository');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
