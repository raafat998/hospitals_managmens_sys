@extends('layouts.app')

@section('head')
    <title>{{ app()->getLocale() == 'ar' ? 'تسجيل الدخول - TabeebZone - لوحة التحكم' : 'Login - TabeebZone - Admin Dashboard' }}</title>
@endsection

@section('content')
    <div class="container sm:px-10" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="block xl:grid grid-cols-2 gap-4">
<!-- BEGIN: Login Info -->
<div class="hidden xl:flex flex-col min-h-screen">
    <a href="" class="-intro-x flex items-center pt-5">
        <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('build/assets/images/logo.svg') }}">
        <span class="text-lg ml-3 {{ app()->getLocale() == 'ar' ? 'text-black' : 'text-white' }}">
            TabeebZone
        </span>
    </a>
    <div class="my-auto">
        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
        <dotlottie-player src="https://lottie.host/f6c9e8e6-760b-4780-8059-61f660574ab8/TVSPOwOkzK.json" class="-intro-x w-1/2 -mt-16" background="transparent" speed="1" style="width: 400px; height: 400px;" loop autoplay></dotlottie-player>
        
        <!-- النصوص الرئيسية مع الشرطية للألوان -->
        <div class="-intro-x font-medium text-4xl leading-tight mt-10" 
             style="{{ app()->getLocale() == 'ar' ? 'color: black;' : 'color: white;' }}">
            {{ __('auth.welcome') }}
            <br>
            {{ __('auth.sign_in') }}
        </div>

        <!-- النص الفرعي مع الشرطية للألوان -->
        <div class="-intro-x mt-5 text-lg {{ app()->getLocale() == 'ar' ? 'text-black' : 'text-slate-400' }}">
            {{ __('auth.manage_accounts') }}
        </div>
    </div>
</div>
<!-- END: Login Info -->



          <!-- BEGIN: Login Form -->
<div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
    <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left {{ app()->getLocale() == 'ar' ? 'text-white' : 'text-black' }}">
            {{ app()->getLocale() == 'ar' ? 'تسجيل الدخول' : 'Sign In' }}
        </h2>
        <div class="intro-x mt-2 {{ app()->getLocale() == 'ar' ? 'text-white' : 'text-slate-400' }} xl:hidden text-center">
            {{ app()->getLocale() == 'ar' ? 'مرحبًا بك في شركة TabeebZone، قم بتسجيل الدخول إلى حسابك.' : 'Welcome to TabeebZone Company, sign in to your account.' }}
        </div>
        <div class="intro-x mt-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input id="email" name="email" type="text" class="intro-x login__input form-control py-3 px-4 block {{ app()->getLocale() == 'ar' ? 'text-white' : 'text-black' }}" placeholder="{{ app()->getLocale() == 'ar' ? 'البريد الإلكتروني' : 'Email' }}">
                <div id="error-email" class="login__input-error text-danger mt-2">{{ $errors->first('email') }}</div>

                <input id="password" name="password" type="password" class="intro-x login__input form-control py-3 px-4 block mt-4 {{ app()->getLocale() == 'ar' ? 'text-white' : 'text-black' }}" placeholder="{{ app()->getLocale() == 'ar' ? 'كلمة المرور' : 'Password' }}">
                <div id="error-password" class="login__input-error text-danger mt-2">{{ $errors->first('password') }}</div>

               
            
                </div>
                
                <div class="intro-x flex {{ app()->getLocale() == 'ar' ? 'text-white' : 'text-slate-600' }} dark:text-slate-500 text-xs sm:text-sm mt-4">
                    <a class="{{ app()->getLocale() == 'ar' ? 'text-white' : '' }}" href="">{{ app()->getLocale() == 'ar' ? 'هل نسيت كلمة المرور؟' : 'Forgot Password?' }}</a>
                </div>

                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                    <button id="btn-login" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">
                        {{ app()->getLocale() == 'ar' ? 'تسجيل الدخول' : 'Login' }}
                    </button>
            </form>
            <a href="{{ route('register2') }}">
                <button id="btn-register" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top {{ app()->getLocale() == 'ar' ? 'text-white' : 'text-black' }}">
                    {{ app()->getLocale() == 'ar' ? 'إنشاء حساب' : 'Register' }}
                </button>
            </a>
        </div>

        <div class="intro-x mt-10 xl:mt-24 {{ app()->getLocale() == 'ar' ? 'text-white' : 'text-slate-600' }} dark:text-slate-500 text-center xl:text-left">
            {{ app()->getLocale() == 'ar' ? 'عند التسجيل، فإنك توافق على' : 'By signing up, you agree to our' }}
            <a class="{{ app()->getLocale() == 'ar' ? 'text-white' : 'text-primary dark:text-slate-200' }}" href="/register-page">
                {{ app()->getLocale() == 'ar' ? 'الشروط والأحكام' : 'Terms and Conditions' }}
            </a>
            & 
            <a class="{{ app()->getLocale() == 'ar' ? 'text-white' : 'text-primary dark:text-slate-200' }}" href="">
                {{ app()->getLocale() == 'ar' ? 'سياسة الخصوصية' : 'Privacy Policy' }}
            </a>
        </div>
    </div>
</div>
<!-- END: Login Form -->


            
        </div>
    </div>
@endsection

@section('script')
<script type="module">
    (function () {
        const routes = {
            adminHome: "{{ route('dashboard-overview-1') }}", 
            doctorHome: "{{ route('alert1') }}", 
            patientHome: "{{ route('dashboard-overview-3') }}" ,
            RayEmployeeHome: "{{ route('dashboard-ray-emplyee') }}" ,
            LabEmployeeHome: "{{ route('dashboard-lab-emplyee') }}" ,

        };

        async function login() {
            // إعادة تعيين حالة الإدخال
            $('#login-form').find('.login__input').removeClass('border-danger');
            $('#login-form').find('.login__input-error').html('');

            // استرجاع البيانات من النموذج
            let email = $('#email').val();
            let password = $('#password').val();

            // تغيير حالة زر الدخول إلى تحميل
            $('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>');
            tailwind.svgLoader();
            await helper.delay(1500);

            // إرسال طلب تسجيل الدخول
            axios.post(`login`, {
                email: email,
                password: password
            }).then(res => {
                if (res.data.success) {
                    const roleId = res.data.role_id; // تحديد دور المستخدم
                    let redirectUrl = '';

                    switch (roleId) {
                        case 1: // مسؤول
                            redirectUrl = routes.adminHome;
                            break;
                        case 2: // طبيب
                            redirectUrl = routes.doctorHome;
                            break;
                        case 3: // مريض
                            redirectUrl = routes.patientHome;
                        case 4: 
                            redirectUrl = routes.RayEmployeeHome;  
                        case 5: 
                        redirectUrl = routes.LabEmployeeHome;
                            
                            break;
                        default:
                            console.error("دور المستخدم غير صحيح أو غير معرف");
                            return; // لا توجه إذا لم يتم التعرف على الدور
                    }

                    // توجيه المستخدم للصفحة المطلوبة
                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    }
                }
            }).catch(err => {
                // إعادة زر الدخول إلى النص الأصلي
                $('#btn-login').html('{{ app()->getLocale() == 'ar' ? 'تسجيل الدخول' : 'Login' }}');

                // عرض الأخطاء إذا كانت موجودة
                if (err.response && err.response.data.errors) {
                    for (const [key, val] of Object.entries(err.response.data.errors)) {
                        $(`#${key}`).addClass('border-danger');
                        $(`#error-${key}`).html(val);
                    }
                } else {
                    $('#password').addClass('border-danger');
                    $('#error-password').html(err.response.data.message || '{{ app()->getLocale() == 'ar' ? "حدث خطأ غير متوقع." : "An unexpected error occurred." }}');
                }
            });
        }

        // عند الضغط على زر تسجيل الدخول
        $('#btn-login').on('click', function () {
            login();
        });

        // عند الضغط على Enter لتنفيذ تسجيل الدخول
        $('#login-form').on('keyup', function (e) {
            if (e.keyCode === 13) {
                login();
            }
        });
    })();
</script>





@endsection
