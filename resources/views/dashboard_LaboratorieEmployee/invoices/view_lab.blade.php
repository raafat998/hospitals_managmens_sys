@extends('layout/side-menu')

@section('subhead')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/css/lightgallery.min.css" />

<style>
    /* إعداد container لتوسيط المعرض */
    .gallery-container {
        max-width: 1200px;
        margin: auto;
        padding: 30px;
        background-color: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* إعداد شبكة العرض */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* زيادة العرض الأدنى للمربعات */
        gap: 15px;
    }

    /* تنسيق العناصر داخل المعرض */
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        background-color: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s, box-shadow 0.3s;
        cursor: pointer;
        border: 6px solid #e0e0e0; /* زيادة سمك الإطار */
        height: 300px; /* زيادة ارتفاع المربع */
    }

    /* تأثير التكبير والتظليل عند التمرير */
    .gallery-item:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    /* عرض الصور كاملة داخل المربعات */
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* ملء الصورة بالكامل مع الحفاظ على النسبة */
        transition: transform 0.3s;
    }

    /* تأثير إضافي على الصور عند التمرير */
    .gallery-item:hover img {
        transform: scale(1.1);
    }
</style>

@endsection

@section('subcontent')

<div class="gallery-container">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
    <h2 class="intro-y text-lg font-medium ">صور فحوصات المختبر</h2>
    <span class="text-muted mt-1 tx-13 mr-2 mb-0">&nbsp; &nbsp;/ &nbsp;&nbsp;{{$laboratorie->Patient->name}}</span>
@if(auth()->user()->role_id != 1)
    <a class="btn btn-primary ml-auto" href="{{route('invoices.index')}}"> Back </a>
@endif

@if(auth()->user()->role_id == 1)
<a class="btn btn-primary ml-auto" href="javascript:history.back()">Back</a>
@endif
    </div>
    <div class="gallery-container mt-3">
        <div class="form-group mb-4">
            <h5 class="intro-y text-lg font-medium  ">ملاحظات دكتور المختبر</h5>
            <textarea readonly class="form-control mt-3" id="exampleFormControlTextarea1" rows="3">{{$laboratorie->description_employee}}</textarea>
        </div>
    </div>
    <div class="gallery-container mt-5">
        
    <div class="main-content" style="overflow-x: auto; min-height: 100vh;">


        <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">

                <!-- معرض الصور باستخدام شبكة CSS Grid -->
                <div class="gallery-grid" id="lightgallery">
                    @foreach($laboratorie->images as $image)
                        <div class="btn-primary gallery-item" data-src="{{URL::asset('storage/properties/laboratories/'.$image->filename)}}">
                            <a href="{{URL::asset('storage/properties/laboratories/'.$image->filename)}}">
                                <img src="{{URL::asset('storage/properties/laboratories/'.$image->filename)}}" alt="صورة المختبر">
                            </a>
                        </div>
                    @endforeach
                </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/lightgallery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/plugins/thumbnail/lg-thumbnail.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/plugins/zoom/lg-zoom.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        lightGallery(document.getElementById('lightgallery'), {
            selector: '.gallery-item',
            thumbnail: true,
            zoom: true,
        });
    });
</script>
@endsection
