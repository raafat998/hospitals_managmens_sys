@extends('layouts.app')

@section('head')
    <title>Forgot Password - HomeRadar</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Password Reset Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="HomeRadar Logo" class="w-6" src="{{ asset('build/assets/images/logo.svg') }}">
                    <span class="text-white text-lg ml-3">
                        HomeRadar
                    </span>
                </a>
                <div class="my-auto">
                    <img alt="Forgot Password Illustration" class="-intro-x w-1/2 -mt-16" src="{{ asset('build/assets/images/illustration.svg') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">Forgot your password? <br> We can help you reset it.</div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Enter your email address and we'll send you a link to <br>reset your password.</div>
                </div>
            </div>
            <!-- END: Password Reset Info -->
            <!-- BEGIN: Password Reset Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Forgot Password</h2>
                    <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">Enter your email address and we'll send you a link to reset your password.</div>
                    <div class="intro-x mt-8">
                        <form id="forgot-password-form">
                            <input id="email" type="email" class="intro-x form-control py-3 px-4 block" placeholder="Email" value="">
                            <div id="error-email" class="text-danger mt-2"></div>
                        </form>
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button id="btn-reset" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Send Reset Link</button>
                        <a href="{{ route('login') }}">
                            <button id="btn-login" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Back to Login</button>
                        </a>
                    </div>
                    <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left">
                        By resetting your password, you agree to our <a class="text-primary dark:text-slate-200" href="/terms">Terms and Conditions</a> & <a class="text-primary dark:text-slate-200" href="/privacy">Privacy Policy</a>
                    </div>
                </div>
            </div>
            <!-- END: Password Reset Form -->
        </div>
    </div>
@endsection

@section('script')
    <script type="module">
        (function () {
            async function sendResetLink() {
                // Reset state
                $('#forgot-password-form').find('.form-control').removeClass('border-danger')
                $('#forgot-password-form').find('.text-danger').html('')

                // Post form
                let email = $('#email').val()

                // Loading state
                $('#btn-reset').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
                tailwind.svgLoader()
                await helper.delay(1500)

                axios.post(`{{ route('password.email') }}`, {
                    email: email
                }).then(res => {
                    alert('Password reset link sent to your email!')
                    location.href = '{{ route('login') }}'
                }).catch(err => {
                    $('#btn-reset').html('Send Reset Link')
                    if (err.response.data.message != 'The given data was invalid.') {
                        for (const [key, val] of Object.entries(err.response.data.errors)) {
                            $(`#${key}`).addClass('border-danger')
                            $(`#error-${key}`).html(val)
                        }
                    } else {
                        $(`#email`).addClass('border-danger')
                        $(`#error-email`).html(err.response.data.message)
                    }
                })
            }

            $('#forgot-password-form').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    sendResetLink()
                }
            })

            $('#btn-reset').on('click', function() {
                sendResetLink()
            })
        })()
    </script>
@endsection