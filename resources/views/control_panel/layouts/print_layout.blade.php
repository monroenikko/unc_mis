<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@yield('content_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <style>
            * {
                font-family: Arial, Times, serif;
            }
            .page-break {
                page-break-after: always;
            }
            th, td {
                border: 1px solid #000;
                padding: 3px;
            }
            .td-center{
                text-align: center !important;
            }
            table {
                width: 100%;
                border-spacing: 0;
                border-collapse: collapse;
                font-size : 11px;
            }
            .table-student-info {
                width: 100%;
            }            
            .table-student-info th, .table-student-info td {
                border: none;
                padding: 0 2px 2px 2px;
            }
            .text-red {
                color : #dd4b39 !important;
            }
            small {
                font-size : 10px;
            }
            .text-center {
                text-align: center;
            }
            .heading1 {
                text-align: center;
                padding: 0;
                margin:0;
                font-size: 11px;
            }
            .heading2 {
                text-align: center;
                padding: 0;
                margin:0;
            }
            .heading2-title {
                /* font-family: "Old English Text MT", Times, serif; */
                font-family: 'Times New Roman', Times, serif;
            }
            .heading2-subtitle {
                font-size: 12px;
            }
            .p0 {
                padding: 0;
            }
            .m0 {
                margin: 0;
            }
    
            .student-info {
                font-size: 12px;
            }
    
            .logo {
                position: absolute;
            }
            .sja-logo {
                top: 10px;
                right: 10px;
            }
            .deped-bataan-logo {
                top: 10px;
                left: 10px;
            }
            .report-progress {
                text-align: center;
                font-size: 12px;
                font-weight: 700;
            }
            .report-progress-left {
                text-align: left;
                font-size: 12px;
                font-weight: 700;
            }
            .grade7{
                border-bottom: 6px solid green;
                margin-top: 0in;
            }

            .stem{
                border-bottom: 6px solid green;
                margin-top: -10px;
            }

            .grade8{
                border-bottom: 6px solid yellow;
                margin-top: 0in;
            }

            .abm{
                border-bottom: 6px solid yellow;
                margin-top: -10px;
            }

            .grade9{
                border-bottom: 6px solid #bb0a1e;
                margin-top: 0in;
            }

            .grade10{
                border-bottom: 6px solid blue;
                margin-top: 0in;
            }

            .humss{
                border-bottom: 6px solid blue;
                margin-top: -10px;
            }
        </style>
</head>
<body>
    
    <p class="heading1">Republic of the Philippines</p>
    <p class="heading1">Department of Education</p>
    <p class="heading1">Region III</p>
    <p class="heading1">Division of Bataan</p>
    <br/>
    <h2 class="heading2 heading2-title">UNIVERSITY OF NUEVA CACERES</h2>
    <p class="heading2 heading2-subtitle"><b>K to 12 BASIC EDUCATION CURRICULUM</b></p>
    <p class="heading2 heading2-subtitle">Dinalupihan, Bataan</p>
    <br/>
    <br/>
    <img src="{{ asset('/img/unc-logo.png') }}" style="height: 100px; float:left; margin-top:-120px; margin-left: 50px">

    @yield('content')
</body>
</html>