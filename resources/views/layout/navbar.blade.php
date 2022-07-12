<nav class="menu menu__main">
    <a class="logo" href="/">Go Home</a>
    <ul class="menu__list">

        @foreach ($navbarItems as $item)
        <x-layout.navbar-item class="{{ $item['class'] ?? '' }}" :href="$item['href']">{{ $item['label'] }}</x-layout.navbar-item>
        @endforeach

        <x-layout.navbar-item :href="'/cart'" class="cart__link" data-count="0">link</x-layout.navbar-item>

        @auth
        <x-layout.navbar-item :href="route('account', ['user' => auth()->user()])" class="account__icon">
            <img src="{{ auth()->user()->image ?? '/storage/images/icons/user-icon.svg' }}">
        </x-layout.navbar-item>
        @endauth

    </ul>

    <div class="menu__mobile" @click="toggleMenu = true">
        <x-layout.navbar-hamburger></x-layout.navbar-hamburger>
        <span>Menu</span>
    </div>
</nav>

<!-- Nav -->
<nav class="menu menu__main--mobile" :class="toggleMenu && 'active'">
    <div class="close-menu" @click.stop="toggleMenu = false"></div>
    <ul class="menu__list menu__list--mobile">
        @foreach ($navbarItems as $item)
        <x-layout.navbar-item class="menu__item--mobile" :href="$item['href']">{{ $item['label'] }}</x-layout.navbar-item>
        @endforeach
    </ul>
</nav>