@include('admin.layouts.__header')

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>

    <div id="app">
        @include('admin.layouts.__sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('content')

            @include('admin.layouts.__footer')

            <div class="toast-container position-fixed bottom-0 end-0 p-3">

            </div>

        </div>
    </div>

    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>

    <!-- Need: Apexcharts -->
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('assets/static/js/pages/component-toasts.js') }}"></script>

    <script type="module">
        console.log('listening on orders channel...');
        // Create toast container if it doesn't exist
        let toastContainer = document.querySelector('.toast-container');

        window.Echo.channel('orders')
            .listen('.create', (data) => {
                console.log('Order status updated: ', data);

                // Create unique id for each toast
                const toastId = 'liveToast-' + Date.now();

                // Toast HTML
                const toastHTML = `
                <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#007aff"></rect></svg>
                        <strong class="me-auto">Pesanan Baru!</strong>
                        <small>Baru saja</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Pesanan baru telah diterima dengan Kode Pesanan:
                        <a href="/orders/${data.id}" target="_blank">${data.order_code}</a>
                    </div>
                </div>
                `;

                // Insert toast into container
                toastContainer.insertAdjacentHTML('beforeend', toastHTML);

                // Show the toast using Bootstrap's JS
                const toastElement = document.getElementById(toastId);
                const toast = new bootstrap.Toast(toastElement, { delay: 5000 });
                toast.show();

                // Remove toast from DOM after hidden
                toastElement.addEventListener('hidden.bs.toast', () => {
                    toastElement.remove();
                });
            });
    </script>

    @yield('js')

</body>

</html>
