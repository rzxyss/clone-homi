<!DOCTYPE html>
<html lang="en">

<head>
    @include('page.partials.header')
</head>

<body>

    @include('page.partials.navbar')
    @yield('contents')
    @include('page.partials.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        // Add the sticky functionality using JavaScript
            // window.onscroll = function () {
            //     var headerSection = document.querySelector('.header_section_top');
            //     if (window.scrollY > headerSection.offsetTop) {
            //         headerSection.classList.add('header-section-fixed');
            //     } else {`
            //         headerSection.classList.remove('header-section-fixed');
            //     }
            // };
            
            @if(session('success'))
                iziToast.success({
                    title: 'Success!',
                    message: "{{ session('success') }}",
                    icon: 'fa fa-check',
                    closeOnClick: true,
                    closeOnEscape: true,
                    position: "topRight",
                });            
            @elseif(session('error'))
                iziToast.error({
                    title: 'Error!',
                    message: "{{ session('error') }}",
                    icon: 'fa fa-x',
                    closeOnClick: true,
                    closeOnEscape: true,
                    position: "topRight",
                });
            @elseif(session('info'))
                iziToast.info({
                    title: 'Info!',
                    message: "{{ session('info') }}",
                    icon: 'fa fa-info-circle',
                    closeOnClick: true,
                    closeOnEscape: true,
                    position: "topRight",
                });
            @elseif(session('warning'))
                iziToast.warning({
                    title: 'Warning!',
                    message: "{{ session('warning') }}",
                    icon: 'fa fa-exclamation',
                    closeOnClick: true,
                    closeOnEscape: true,
                    position: "topRight",
                });
            @endif
    </script>
    <script>
        // document.addEventListener('contextmenu', function (e) {
        //         e.preventDefault();
        //     });
    </script>
    <script>
        // document.onkeydown = function (e) {
        //     if (event.keyCode == 123) {
        //         return false;
        //     }
        //     if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
        //         return false;
        //     }
        //     if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
        //         return false;
        //     }
        //     if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
        //         return false;
        //     }
        //     if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
        //         return false;
        //     }
        // }
    </script>
</body>

</html>