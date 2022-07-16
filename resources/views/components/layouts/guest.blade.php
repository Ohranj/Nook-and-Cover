<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{env('APP_NAME')}}</title>
        <!-- FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
        <!-- STYLES -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <!-- SCRIPTS -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{asset('js/alpineStores.js')}}"></script>
    </head>
    <body x-data :class="$store.globalStates.modalShowing ? 'bg-orange-100' : 'bg-gradient-to-b from-[#c2d0e5]'" class="min-h-screen">
        {{ $slot }}
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute bottom-0 z-0">
            <path fill="#0099ff" fill-opacity="1" d="M0,96L12.6,106.7C25.3,117,51,139,76,154.7C101.1,171,126,181,152,176C176.8,171,202,149,227,144C252.6,139,278,149,303,165.3C328.4,181,354,203,379,229.3C404.2,256,429,288,455,277.3C480,267,505,213,531,213.3C555.8,213,581,267,606,256C631.6,245,657,171,682,170.7C707.4,171,733,245,758,245.3C783.2,245,808,171,834,133.3C858.9,96,884,96,909,112C934.7,128,960,160,985,154.7C1010.5,149,1036,107,1061,96C1086.3,85,1112,107,1137,128C1162.1,149,1187,171,1213,176C1237.9,181,1263,171,1288,186.7C1313.7,203,1339,245,1364,245.3C1389.5,245,1415,203,1427,181.3L1440,160L1440,320L1427.4,320C1414.7,320,1389,320,1364,320C1338.9,320,1314,320,1288,320C1263.2,320,1238,320,1213,320C1187.4,320,1162,320,1137,320C1111.6,320,1086,320,1061,320C1035.8,320,1011,320,985,320C960,320,935,320,909,320C884.2,320,859,320,834,320C808.4,320,783,320,758,320C732.6,320,707,320,682,320C656.8,320,632,320,606,320C581.1,320,556,320,531,320C505.3,320,480,320,455,320C429.5,320,404,320,379,320C353.7,320,328,320,303,320C277.9,320,253,320,227,320C202.1,320,177,320,152,320C126.3,320,101,320,76,320C50.5,320,25,320,13,320L0,320Z"></path>
        </svg>
    </body>
</html>
