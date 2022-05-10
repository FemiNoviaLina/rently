<div class="absolute">
    <div class="w-screen h-1 bg-lilac-100"></div>
    <div class="navbar flex justify-between">
        <a href="{{ url('/') }}"><div class="navbar-logo basis-1/4 text-lilac-100">Rent.ly</div></a>
        <div class="basis-3/4 flex justify-between sm:max-h-0 md:max-h-0" id="menu-list">
            <div class="navbar-links flex p-3 m-3">
                @guest
                <?php $values = array('Rent', 'Guide', 'Help', 'About'); ?>
                @endguest
                @auth
                <?php $values = array('Rent', 'My order', 'Guide', 'Help', 'About'); ?>
                @endauth
                @foreach($values as $value)
                    <a href="{{ $isRent($value) ? '' : url(strtolower($value)) }}">
                        <div id="{{ $isRent($value) ? 'rent-button' : '' }}" class="relative navbar-option mx-6 whitespace-nowrap {{ Auth::check() ? 'w-24' : 'w-20' }}">
                            <p class="inline-block w-8 px-2 text-center"> {{ $value }} </p>
                                @if($isRent($value)) 
                                    <img src="images/down-arrow.svg" class="inline-block w-5 ml-3 pl-1">
                                    <div id="rent-menu" class="rent-menu z-10 hidden absolute w-40 font-normal">
                                        <div class="rent-menu-option px-2 py-1 bg-gray hover:bg-lilac-100 hover:text-white">
                                            <a href="{{ url('/cars') }}"> Rent Car </a>
                                        </div>
                                        <div class="rent-menu-option px-2 py-1 bg-gray hover:bg-lilac-100 hover:text-white">
                                            <a href="{{ url('/motors') }}"> Rent Motorcycle</a>
                                        </div>
                                    </div>
                                @endif
                        </div>
                    </a>
                @endforeach
                </div>
            <div class="cta-button m-2 flex flex-nowrap content-center">
                @guest
                <a href="{{ url('/login') }}">
                    <x-button filled=true> {{ __('Login') }}</x-button>
                </a>
                <a href="{{ url('/register') }}">
                    <x-button> {{ __('Register') }}</x-button>
                </a>
                @endguest
                @auth
                <form action="{{ url('/logout') }}" method="post">
                    @csrf
                    <x-button filled=true> {{ __('Logout') }}</x-button>
                </form>
                @endauth
            </div>
        </div>
        <div class="lg:hidden sm:inline md:inline m-3 cursor-pointer" id="menu-toggle">
            <div class="w-8 h-0.5 bg-lilac-100 block m-2"></div>
            <div class="w-8 h-0.5 bg-lilac-100 block m-2"></div>
            <div class="w-8 h-0.5 bg-lilac-100 block m-2"></div>
        </div>
    </div>
    <script src="js/navbar_script.js"></script>
</div>