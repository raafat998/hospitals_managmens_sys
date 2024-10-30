@extends('layout/side-menu')

@section('subhead')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>{{ __('Patients.Patient File') }}</title>
    <style>
        .timeline {
            display: flex;
            flex-direction: column;
            position: relative;
            padding-left: 40px; 
        }
    
        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 60px; 
            bottom: 0;
            width: 4px; 
            background-color: gray; 
            z-index: 0; 
        }
    
        .timeline-item {
            display: flex;
            position: relative;
            margin-bottom: 20px; 
            opacity: 0; 
            transform: translateY(20px); 
            transition: opacity 0.5s ease, transform 0.5s ease; 
        }
    
        .timeline-item.show {
            opacity: 1; 
            transform: translateY(0); 
        }
    
        .timeline-content {
            background: white;
            padding: 15px; 
            border-radius: 8px; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            flex: 1; 
            margin-left: 20px; 
            margin-right: 20px; 
            z-index: 1; 
        }
    </style>
@endsection

@section('subcontent')
<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">Patient File</h2>
        <a class="btn btn-primary" href="{{ route('Patients.index') }}"> Back </a>
    </div>
   
      <!-- row opened -->
      <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card" id="basic-alert">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-1">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">سجل المريض</a></li>
                                            <li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">الاشعة</a></li>
                                            <li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab">المختبر</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                    <div class="tab-content">


                                        {{-- Strat Show Information Patient --}}

                                        <div class="tab-pane active" id="tab1">
                                            <br>
                                            @include('Doctors.invoices.patient_record')
                                        </div>
                                        
                                      

                                        {{-- End Show Information Patient --}}



                                        {{-- Start Invices Patient --}}

                                        <div class="tab-pane" id="tab2">

                                            @include('Doctors.invoices.ray_table')
                                        </div>

                                        {{-- End Invices Patient --}}



                                        {{-- Start Receipt Patient  --}}

                                        <div class="tab-pane" id="tab3">
                                            3
                                        </div>

                                        {{-- End Receipt Patient  --}}


                                        {{-- Start payment accounts Patient --}}
                                        <div class="tab-pane" id="tab4">
                                           <h1>4</h1>
                                        </div>

                                        {{-- End payment accounts Patient --}}


                                        <div class="tab-pane" id="tab5">
                                            <p>praesentium voluptatum deleniti atque corrquas molestias excepturi sint
                                                occaecati cupiditate non provident,</p>
                                            <p class="mb-0">similique sunt in culpa qui officia deserunt mollitia animi,
                                                id est laborum et dolorum fuga. Et harum quidem rerum facilis est et
                                                expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi
                                                optio cumque nihil impedit quo minus id quod maxime placeat facere
                                                possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                        </div>
                                        <div class="tab-pane" id="tab6">
                                            <p>praesentium et quas molestias excepturi sint occaecati cupiditate non
                                                provident,</p>
                                            <p class="mb-0">similique sunt in culpa qui officia deserunt mollitia animi,
                                                id est laborum et dolorum fuga. Et harum quidem rerum facilis est et
                                                expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi
                                                optio cumque nihil impedit quo minus id quod maxime placeat facere
                                                possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Prism Precode -->
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
 <!-- Add your JS code here -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 <script>
     // Example: Handle tab click and alert based on the tab


     // Example: Another simple JavaScript function
     function alertPatientInfo() {
         alert("This is a sample alert for the patient information.");
     }

     // Add event listener for a button (example)
     document.addEventListener('DOMContentLoaded', function () {
         const alertButton = document.getElementById('alert-button');
         if (alertButton) {
             alertButton.addEventListener('click', function () {
                 alertPatientInfo();
             });
         }
     });
 </script>
@endsection
