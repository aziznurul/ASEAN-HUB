<nav class="bg-white shadow-md sticky top-0 z-50 font-poppins">
    <div class="max-w-6xl mx-auto px-6 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ url('/') }}">
            <img src="{{ asset('asset/images/logo.png') }}" alt="Logo" class="h-20 w-auto">
        </a>
        <!-- Menu -->
        <div class="hidden md:flex space-x-8 font-medium text-gray-700 relative">
                <!-- Home Dropdown -->
            <div class="relative group">
                <a href="{{ url('/') }}" class="hover:text-blue-600 transition flex items-center">
                    Home
                    <svg class="ml-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M5.25 7.5L10 12.25L14.75 7.5H5.25Z" />
                    </svg>
                </a>
                <!-- Dropdown menu -->
                <div class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all">
                    <a href="{{ url('/#About') }}" class="block px-4 py-2 hover:bg-gray-100">About</a>
                    <a href="{{ url('/#Aims') }}" class="block px-4 py-2 hover:bg-gray-100">Aims</a>
                    <a href="{{ url('/#CompetitionObjective') }}" class="block px-4 py-2 hover:bg-gray-100">Competition Objective</a>
                    <a href="{{ url('/#ScopeofCompetition') }}" class="block px-4 py-2 hover:bg-gray-100">Scope of Competition</a>
                    <a href="{{ url('/#Jury') }}" class="block px-4 py-2 hover:bg-gray-100">Jury</a>
                </div>
            </div>

            <!-- Resources Dropdown -->
            <div class="relative group">
                <a href="{{ url('/resources') }}" class="hover:text-blue-600 transition flex items-center">
                    Resources
                    <svg class="ml-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M5.25 7.5L10 12.25L14.75 7.5H5.25Z" />
                    </svg>
                </a>
                <!-- Dropdown menu -->
                <div class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all">
                    <a href="{{ url('/resources/#TermsofReference') }}" class="block px-4 py-2 hover:bg-gray-100">Terms of Reference</a>
                    <!--<a href="{{ url('/resources/#ScopeofCompetition') }}" class="block px-4 py-2 hover:bg-gray-100">Scope of Competition</a>-->
                    <a href="{{ url('/resources/#Timeline') }}" class="block px-4 py-2 hover:bg-gray-100">Timeline</a>
                    <a href="{{ url('/resources/#CompetitionSite') }}" class="block px-4 py-2 hover:bg-gray-100">Competition Site</a>
                    <a href="{{ url('/resources/#ExploreResources') }}" class="block px-4 py-2 hover:bg-gray-100">Explore Resources</a>
                    <!--<a href="{{ url('/resources/#InternationalLectureSeries') }}" class="block px-4 py-2 hover:bg-gray-100">International Lecture Series</a>-->
                    <!--<a href="{{ url('/resources/#Jury') }}" class="block px-4 py-2 hover:bg-gray-100">Jury</a>-->
                </div>
            </div>

            <!-- Application Guideline Dropdown -->
            <div class="relative group">
                <a href="{{ url('/guideline') }}" class="hover:text-blue-600 transition flex items-center">
                    Application Guideline
                    <svg class="ml-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M5.25 7.5L10 12.25L14.75 7.5H5.25Z" />
                    </svg>
                </a>
                <!-- Dropdown menu -->
                <div class="absolute left-0 mt-2 w-56 bg-white shadow-lg rounded-md opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all">
                    <a href="{{ url('/guideline/#ParticipantsandRequirements') }}" class="block px-4 py-2 hover:bg-gray-100">Participants and Requirements</a>
                    <a href="{{ url('/guideline/#CompetitionProcess') }}" class="block px-4 py-2 hover:bg-gray-100">Competition Process, Timeline and Outputs</a>
                    <a href="{{ url('/guideline/#Prizes') }}" class="block px-4 py-2 hover:bg-gray-100">Prizes</a>
                    <a href="{{ url('/guideline/#JudgingCriteria') }}" class="block px-4 py-2 hover:bg-gray-100">Judging Criteria</a>
                </div>
            </div>
            <a href="{{ url('/exhibition') }}" class="hover:text-blue-600 transition">Exhibition</a>
            <a href="{{ url('/announcement') }}" class="hover:text-blue-600 transition">Announcement</a>
        </div>


        <!-- Auth Buttons -->
        <div class="hidden md:flex items-center space-x-4">
            <a href="{{ route('login') }}" class="bg-white text-black border border-black px-4 py-2 rounded-lg hover:bg-[#22559E] hover:text-white transition">
                Participate
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <button id="menu-btn" class="md:hidden text-gray-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden flex-col space-y-3 px-6 pb-4 bg-white shadow-md font-poppins">
    
        <!-- Home (with submenu) -->
        <div class="border-b border-gray-200 pb-2">
            <button class="w-full text-left text-gray-700 hover:text-blue-600 flex justify-between items-center" onclick="toggleSubmenu('home-submenu')">
                Home
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="home-submenu" class="hidden-flex flex-col ml-4 mt-2 space-y-2">
                <a href="{{ url('/#About') }}" class="text-gray-600 hover:text-blue-600">About</a>
                <a href="{{ url('/#Aims') }}" class="text-gray-600 hover:text-blue-600">Aims</a>
                <a href="{{ url('/#CompetitionObjective') }}" class="text-gray-600 hover:text-blue-600">Competition Objective</a>
                <a href="{{ url('/#ScopeofCompetition') }}" class="text-gray-600 hover:text-blue-600">Scope of Competition</a>
                <a href="{{ url('/#Jury') }}" class="text-gray-600 hover:text-blue-600">Jury</a>
            </div>
        </div>
    
        <!-- Resources (with submenu) -->
        <div class="border-b border-gray-200 pb-2">
            <button class="w-full text-left text-gray-700 hover:text-blue-600 flex justify-between items-center" onclick="toggleSubmenu('resources-submenu')">
                Resources
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="resources-submenu" class="hidden-flex flex-col ml-4 mt-2 space-y-2">
                <a href="{{ url('/resources/#TermsofReference') }}" class="text-gray-600 hover:text-blue-600">Terms of Reference</a>
                <a href="{{ url('/resources/#Timeline') }}" class="text-gray-600 hover:text-blue-600">Timeline</a>
                 <a href="{{ url('/resources/#CompetitionSite') }}" class="text-gray-600 hover:text-blue-600">Competition Site</a>
                <a href="{{ url('/resources/#ExploreResources') }}" class="text-gray-600 hover:text-blue-600">Explore Resources</a>
            </div>
        </div>

        <!-- Guideline (with submenu) -->
        <div class="border-b border-gray-200 pb-2">
            <button class="w-full text-left text-gray-700 hover:text-blue-600 flex justify-between items-center px-4 py-2"
                onclick="toggleSubmenu('guideline-submenu')">
                Application Guideline
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="guideline-submenu" class="hidden-flex flex-col ml-8 mt-2 space-y-2">
                <a href="{{ url('/guideline/#ParticipantsandRequirements') }}" class="text-gray-600 hover:text-blue-600">Participants and Requirements</a>
                <a href="{{ url('/guideline/#CompetitionProcess') }}" class="text-gray-600 hover:text-blue-600">Competition Process, Timeline and Outputs</a>
                <a href="{{ url('/guideline/#Prizes') }}" class="text-gray-600 hover:text-blue-600">Prizes</a>
                <a href="{{ url('/guideline/#JudgingCriteria') }}" class="text-gray-600 hover:text-blue-600">JudgingCriteria</a>
            </div>
        </div>
    
        <!-- Other links -->
        <a href="{{ url('/exhibition') }}" class="block text-gray-700 hover:text-blue-600">Exhibition</a>
        <a href="{{ url('/announcement') }}" class="block text-gray-700 hover:text-blue-600">Announcement</a>
    
        <!-- Participate button -->
        <a href="{{ route('login') }}" class="block bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 transition">
            Participate
        </a>
    </div>
</nav>
<!-- Script to toggle submenu -->
<script>
function toggleSubmenu(id) {
    const submenu = document.getElementById(id);
    submenu.classList.toggle('hidden');
    // Optional: rotate the arrow icon
    const icon = submenu.previousElementSibling.querySelector('svg');
    icon.classList.toggle('rotate-180');
}
</script>

<!-- Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const iconOpen = document.getElementById('icon-open');
        const iconClose = document.getElementById('icon-close');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });
    });
</script>