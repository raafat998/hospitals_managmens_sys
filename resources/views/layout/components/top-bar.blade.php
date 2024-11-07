<!-- BEGIN: Top Bar -->
<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Application</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Search -->
    <div class="intro-x relative mr-3 sm:mr-6">
        <div class="search hidden sm:block">
            <input type="text" class="search__input form-control border-transparent" placeholder="Search...">
            <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
        </div>
        <a class="notification sm:hidden" href="">
            <i data-lucide="search" class="notification__icon dark:text-slate-500"></i>
        </a>
    </div>
    <!-- END: Search -->

    <!-- BEGIN: Language Switch -->
    <div class="relative inline-block text-left mr-3">
        <button class="btn btn-primary" onclick="toggleDropdown()">
            {{ app()->getLocale() == 'ar' ? 'اختر اللغة ' : 'Select Language' }}
        </button>
        <div id="dropdownMenu" class="hidden absolute right-0 z-10 w-40 bg-white border border-gray-300 rounded-md shadow-lg mt-2">
            <ul class="py-1">
                <li>
                    <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 flex items-center">
                        English
                    </a>
                </li>
                <li>
                    <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 flex items-center">
                        العربية
                    </a>
                </li>
                <!-- يمكنك إضافة المزيد من اللغات هنا -->
            </ul>
        </div>
    </div>
    <!-- END: Language Switch -->

    <!-- BEGIN: Notifications -->
    <div class="intro-x dropdown mr-auto sm:mr-6 dropdown-notifications">
        <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            <p data-count="0" class="notification-count notif-count">0</p> 
            <i data-lucide="bell" class="notification__icon dark:text-slate-500"></i>
        </div>
        <div class="notification-content pt-2 dropdown-menu">
            <div class="notification-content__box dropdown-content">
                <div class="notification-content__title">
                    Notifications 
                    <p data-count="0" class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 notif-count">0</p>
                    <hr>
                </div>

                <div id="notification-list">
                    <!-- إشعارات الحدث سيتم إضافتها هنا -->
                </div>
            </div>
        </div>
    </div>
    <!-- END: Notifications -->

    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            @if (Auth::check())
                @if (Auth::user()->role_id == 1)
                    <img alt="Profile Image" src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('build/assets/images/' . $fakers[9]['photos'][0]) }}">
                @elseif(Auth::user()->role_id == 2)
                    <img alt="Profile Image" src="{{ Auth::user()->doctor->image ? asset('storage/properties/doctors/' . Auth::user()->doctor->image->filename) : asset('build/assets/images/' . $fakers[9]['photos'][0]) }}">
                @elseif(Auth::user()->role_id == 3)
                    <img alt="Profile Image" src="{{ Auth::user()->patient->image ? asset('storage/properties/Patient/' . Auth::user()->patient->image->filename) : asset('build/assets/images/' . $fakers[9]['photos'][0]) }}">
                @elseif(Auth::user()->role_id == 4)
                    <img alt="Profile Image" src="{{ Auth::user()->employee->image ? asset('storage/properties/ray_employee/' . Auth::user()->employee->image->filename) : asset('build/assets/images/' . $fakers[9]['photos'][0]) }}">            
                @elseif(Auth::user()->role_id == 5)
                    <img alt="Profile Image" src="{{ Auth::user()->LaboratorieEmployee->image ? asset('storage/properties/lab_employee/' . Auth::user()->LaboratorieEmployee->image->filename) : asset('build/assets/images/' . $fakers[9]['photos'][0]) }}">            
                @else
                    <h1>hhhhh</h1>
                @endif
            @endif
        </div>
        <div class="dropdown-menu w-56">
            <ul class="dropdown-content bg-primary text-white">
                <li class="p-2">
                    <div class="font-medium">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">{{ Auth::user()->email }}</div>
                </li>
                <li><hr class="dropdown-divider border-white/[0.08]"></li>
                <li>
                    <a href="" class="dropdown-item hover:bg-white/5">
                        <i data-lucide="user" class="w-4 h-4 mr-2"></i> Profile
                    </a>
                </li>
                <li>
                    <a href="" class="dropdown-item hover:bg-white/5">
                        <i data-lucide="edit" class="w-4 h-4 mr-2"></i> Add Account
                    </a>
                </li>
                <li>
                    <a href="" class="dropdown-item hover:bg-white/5">
                        <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Reset Password
                    </a>
                </li>
                <li>
                    <a href="" class="dropdown-item hover:bg-white/5">
                        <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Help
                    </a>
                </li>
                <li><hr class="dropdown-divider border-white/[0.08]"></li>
                <li>
                    <a href="{{ route('logout') }}" class="dropdown-item hover:bg-white/5">
                        <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->

<!-- JavaScript to toggle dropdown visibility -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-JobWAqYk5CSjWuVV3mxgS+MmccJqkrBaDhk8SKS1BW+71dJ9gzascwzW85UwGhxiSyR7Pxhu50k+Nl3+o5I49A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  
    var notificationsWrapper   = $('.dropdown-notifications');
    var notificationsCountElem = notificationsWrapper.find('p[data-count]');
    var notificationsCount  = parseInt(notificationsCountElem.data('count'));
    var notifications = notificationsWrapper.find('h5.notification-label');

    Pusher.logToConsole = true;
    var pusher = new Pusher('a0a4c1239416a3006849', {
        cluster: 'mt1'
    });

  var channel = pusher.subscribe('my-channel');
    channel.bind('App\\Events\\MyEvent', function(data) {
        var existingNotifications = notifications.html();
        var newNotificationHtml = `<h5 class="notification-label mb-1">`+data.patient_id+`</h5>`;
        notifications.html(newNotificationHtml + existingNotifications);
        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
    }); notificationsWrapper.show();


</script>
<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('hidden');
    }

    // Close the dropdown if clicked outside
    window.onclick = function(event) {
        if (!event.target.matches('.btn-primary')) {
            const dropdowns = document.getElementsByClassName("absolute");
            for (let i = 0; i < dropdowns.length; i++) {
                const openDropdown = dropdowns[i];
                if (!openDropdown.classList.contains('hidden')) {
                    openDropdown.classList.add('hidden');
                }
            }
        }
    }

 
</script>
