<!DOCTYPE html>
<html lang="en-NP">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Intern Manager</title>
    <link rel="icon" href="{{ asset('images/logoOnly.png') }}" type="image/x-icon">

    {{-- Hours calculator - Worklog --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/totalTime.js') }}"></script>
    <script src="{{ asset('js/totalDays.js') }}"></script>
    <script src="{{ asset('js/nepali.datepicker.v4.0.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/nepali.datepicker.v4.0.min.css') }}">
    {{-- graph --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    {{-- font awsome icons --}}
    <script src="https://kit.fontawesome.com/8d8b2b9a46.js" crossorigin="anonymous"></script>

    {{-- popup meaasge --}}
    <script src="{{ asset('js/popup_msg.js') }}"></script>

    {{-- External CSS file --}}
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">

    {{-- bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    @livewireStyles
</head>

<body>
    <livewire:nav-bar />

    <div class="main">
        @yield('content')
    </div>

    <livewire:footer />
    <script>
        /* Select your element */
        var elm = document.getElementById("nepali-datepicker");

        /* Initialize Datepicker with options */
        elm.nepaliDatePicker({
            language: "english",
            onChange: function() {
                let nepaliDate = $("input#nepali-datepicker").val();
                let engdate = $("input#eng_date");
                engdate.val(NepaliFunctions.BS2AD(nepaliDate));
            }
        });

        /* Select your element */
        var elm2 = document.getElementById("nepali-datepicker2");

        /* Initialize Datepicker with options */
        elm2.nepaliDatePicker({
            language: "english",
            onChange: function() {
                let nepaliDate = $("input#nepali-datepicker2").val();
                let engdate = $("input#eng_date2");
                engdate.val(NepaliFunctions.BS2AD(nepaliDate));
            }
        });
    </script>
    @livewireScripts
</body>
</html>