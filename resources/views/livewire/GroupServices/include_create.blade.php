@extends('layout/side-menu')

@section('subhead')
    <title>Create New Section - Your App</title>
@endsection

@section('subcontent')
<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <livewire:create-group-services /> 
    </div>
</div>
@endsection
