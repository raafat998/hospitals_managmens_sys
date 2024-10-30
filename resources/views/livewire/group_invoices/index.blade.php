@extends('layout/side-menu')

@section('subhead')
    <title>Create New group Invoice - Your App</title>
@endsection

@section('subcontent')


       <!-- BEGIN: Data List -->
       
       <div class="intro-y col-span-12">
        <div class="table-responsive">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <livewire:group-invoices /> 
                    </div>
        </div>
       </div>
@endsection
