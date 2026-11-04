
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Soft Allure Décor | Premium Home Décor')
    </title>

    <meta name="description"
          content="Soft Allure Décor - Premium home décor, furnishings and custom interior solutions.">

    {{-- MAIN CSS --}}
    <link rel="stylesheet"
          href="{{ asset('css/main.css') }}">

    {{-- ENQUIRY SYSTEM CSS --}}
    <link rel="stylesheet"
          href="{{ asset('css/enquiry-system.css') }}">

    {{-- PREMIUM NAVBAR CSS --}}
    <link rel="stylesheet"
          href="{{ asset('css/navbar.css') }}">

    @stack('styles')
</head>

<body>

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- PAGE CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('components.footer')

    
<!-- FLOATING SCROLL BUTTONS -->
<div class="sa-scroll-controls" id="saScrollControls">

    <!-- SCROLL TO TOP -->
    <button
        type="button"
        class="sa-scroll-btn sa-scroll-top"
        id="saScrollTop"
        aria-label="Scroll to top"
        title="Back to Top"
        hidden
    >
        <svg viewBox="0 0 24 24"
             width="21"
             height="21"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round"
             aria-hidden="true">
            <path d="m6 14 6-6 6 6"/>
            <path d="M12 20V8"/>
        </svg>
    </button>

    <!-- SCROLL TO BOTTOM -->
    <button
        type="button"
        class="sa-scroll-btn sa-scroll-bottom"
        id="saScrollBottom"
        aria-label="Scroll to bottom"
        title="Go to Bottom"
    >
        <svg viewBox="0 0 24 24"
             width="21"
             height="21"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round"
             aria-hidden="true">
            <path d="m6 10 6 6 6-6"/>
            <path d="M12 4v12"/>
        </svg>
    </button>

</div>


    {{-- MAIN JAVASCRIPT --}}
    <script src="{{ asset('js/main.js') }}" defer></script>

    {{-- ENQUIRY SYSTEM JAVASCRIPT --}}
    <script src="{{ asset('js/enquiry-system.js') }}" defer></script>

    {{-- NAVBAR DROPDOWN JAVASCRIPT --}}
    <script src="{{ asset('js/navbar.js') }}" defer></script>

    @stack('scripts')

</body>
</html>
