<?php ?>
<link rel="stylesheet" href="{{asset('my-asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('my-asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('my-asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<style>
    table.dataTable > tbody > tr.child ul.dtr-details > li {
        text-align: left !important;
    }

    table.dataTable tbody td.dtr-control, table.dataTable tbody td.middle {
        /*vertical-align: middle;*/

    }

    table.table-bordered.dataTable th, table.table-bordered.dataTable td {
        vertical-align: middle;
        padding-left: 5px;
        padding-right: 5px;
    }

    table.dataTable thead {
        text-transform: uppercase !important;
        /*color: white;*/
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table-bordered td, .table-bordered th {
        border: 1px solid #dee2e6;
    }

    /*table.dataTable thead {*/
    .bgcolortable {
        text-transform: uppercase !important;
        /*color: white;*/
        color: white;
        background-color: #212529;
        /*background-image: linear-gradient(49deg, #FFFB7D 63%, #85FFBD 96%);*/


    }

</style>
