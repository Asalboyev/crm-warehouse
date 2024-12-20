@extends('layouts.admin')
@section('title')
Mahsulot haqida
@endsection
@section('style')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        padding: 20px;
    }

    /* Jadval ustunlarini markazlashtirish */
    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
    }

    /* Xaridor va sotuvchi ma'lumotlari bloklarini bo'lib ko'rsatish */
    .info-block {
        display: inline-block;
        text-align: left;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .back-btn {
        background-color: #ddd;
        border: none;
        padding: 10px;
        cursor: pointer;
        margin-bottom: 20px;
    }

    .tabs {
        display: flex;
        margin-bottom: 20px;
    }

    .tab {
        flex: 1;
        padding: 10px;
        background-color: #009ef7;
        color: white;
        border: none;
        cursor: pointer;
        text-align: center;
    }

    .tab.active {
        background-color: #04537c;
    }

    .product-info,
    .stock-info {
        margin-bottom: 40px;
    }

    .info-section {
        display: flex;
        justify-content: space-between;
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 8px;
    }

    .info-column {
        flex: 1;
        padding: 0 20px;
    }

    .info-column h3 {
        margin-bottom: 10px;
        font-size: 1.2em;
    }

    .info-column p {
        margin-bottom: 10px;
        font-size: 1em;
    }

    .stock-info {
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 8px;
    }

    .stock-details {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .stock-details div {
        flex: 1;
        margin-right: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .operations {
        display: flex;
        justify-content: space-between;
    }

    .operations button {
        padding: 10px 20px;
        background-color: #009ef7;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .operations button:hover {
        background-color: #009ef7;
    }

    .hidden {
        display: none;
    }

    .sales-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        text-align: left;
    }

    .sales-table thead {
        background-color: #f2f2f2;
    }

    .sales-table th,
    .sales-table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
    }

    .sales-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .sales-table tr:hover {
        background-color: #f1f1f1;
    }

    .sales-table th {
        background-color: #009ef7;
        color: white;
        text-transform: uppercase;
    }

    .sales-history h2 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #333;
        font-weight: 600;
    }

    .text-center {
        text-align: center;
    }
</style>
@endsection
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@include('admin.success-file')
<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <a href="{{ route('product.index') }}"
                class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Back</a>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">

                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">--}}
            {{-- <button type="submit" class="btn btn-sm btn-primary">S</button>--}}
            {{-- <!--end::Primary button-->--}}
            {{-- </div>--}}
        <!--end::Actions-->
    </div>
    <!--end::Container-->
</div>

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <!-- <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/products.html"> -->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <!--begin:::Tabs-->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                        href="#kt_ecommerce_add_product_general">Mahsulot haqida</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                        href="#kt_ecommerce_add_product_advanced">Sotuv tarixi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                        href="#kt_ecommerce_add_product_turnover">Mahsulot aylanmasi</a>
                </li>
            </ul>
            <!--end:::Tabs-->
            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade active show" id="kt_ecommerce_add_product_general" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                            <!--begin::Order details-->
                            <div class="card card-flush py-4 flex-row-fluid">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Umumiy ma'lumotlar</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                            <!--begin::Table body-->
                                            <tbody class="fw-bold text-gray-600">
                                                <!--begin::Date-->
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->Mahsulot nomi
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">{{$product->product_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->Kategoriya:
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">{{$product->category->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->Davlat:
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">{{$product->country}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->Qalinligi:
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">{{$product->thickness}}mm</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->Uzunligi:
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end"> {{$product->length}} Metr</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->Metal turi:
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">{{$product->metal_type}}</td>
                                                </tr>

                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Order details-->
                            <!--begin::Customer details-->
                            <div class="card card-flush py-4 flex-row-fluid">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Parametrlar</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                            <!--begin::Table body-->
                                            <tbody class="fw-bold text-gray-600">
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->1 tonna narxi:
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">{{$product->price_per_ton}} $</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->1 tonna uzunligi:
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">{{$product->length_per_ton}} Metr
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->1 metr uchun narx:
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">{{$product->price_per_meter}} $</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->1 pochka narxi:
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">{{$product->price_per_package}} $
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->1 dona uchun narx:
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">{{$product->price_per_item}} $</td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Customer details-->
                            <!--begin::Documents-->
                            <div class="card card-flush py-4 flex-row-fluid">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Qiymaatlari</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                            <!--begin::Table body-->
                                            <tbody class="fw-bold text-gray-600">
                                                <!--begin::Invoice-->
                                                @if($product->items_per_package)
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->pochkalar soni:
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="View the invoice generated by this order."></i>
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">
                                                        <a class="text-gray-600 text-hover-primary">{{$product->items_per_package}}
                                                            ta</a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if($product->total_units)
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->umumi donalar soni:
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="View the invoice generated by this order."></i>
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">
                                                        <a class="text-gray-600 text-hover-primary">
                                                            {{$product->total_units}} ta</a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if($product->package_weight)
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->1 pochkaning og'irligi
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="View the invoice generated by this order."></i>
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">
                                                        <a class="text-gray-600 text-hover-primary">{{$product->package_weight}}
                                                            Tonna</a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if($product->package_length)
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->1 pochka uzunligi:
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="View the invoice generated by this order."></i>
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">
                                                        <a class="text-gray-600 text-hover-primary">
                                                            {{$product->package_length}} metr</a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if($product->weight_per_meter)
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->1 metr og'irligi:
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="View the invoice generated by this order."></i>
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">
                                                        <a class="text-gray-600 text-hover-primary">{{$product->weight_per_meter}}
                                                            tonna</a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if($product->weight_per_item)
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->1 dona og'irligi:
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="View the invoice generated by this order."></i>
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">
                                                        <a class="text-gray-600 text-hover-primary">
                                                            {{$product->weight_per_item}} tonna</a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if($product->grains_package)
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->Donalarning pochkadagi soni:
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="View the invoice generated by this order."></i>
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">
                                                        <a class="text-gray-600 text-hover-primary">
                                                            {{$product->grains_package}} ta</a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if($product->total_packages)
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->Ombordagi jami pochkalar soni:
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="View the invoice generated by this order."></i>
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">
                                                        <a class="text-gray-600 text-hover-primary">
                                                            {{$product->total_packages}} ta</a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if($product->items_in_package)
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->Pochkadagi mavjud donalar soni:
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="View the invoice generated by this order."></i>
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">
                                                        <a class="text-gray-600 text-hover-primary">
                                                            {{$product->items_in_package}} ta</a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if($product->total_weight)
                                                <tr>
                                                    <td class="text-muted">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                                            <span class="svg-icon svg-icon-2 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->Jami og'irligi:
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="View the invoice generated by this order."></i>
                                                        </div>
                                                    </td>
                                                    <td class="fw-bolder text-end">
                                                        <a class="text-gray-600 text-hover-primary">
                                                            {{$product->total_weight}} Tonna</a>
                                                    </td>
                                                </tr>
                                                @endif
                                                <!--end::Rewards-->
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Documents-->
                        </div>
                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!-- <div class="card-title">
                                        <h2>General</h2>
                                    </div> -->
                            </div>


                            <div class="card-body pt-0">
                                <div class="product-info">

                                    <div>
                                        <h2>Qoldiq</h2>

                                        <div class="stock-details">
                                            <div>
                                                <label for="pochkalar">Pochkalar soni</label>
                                                <input value="{{$product->items_per_package}}" readonly
                                                    style="background-color: #F5F5F7; border: 1px solid #ccc; color: #333;">
                                            </div>
                                            <div>
                                                <label for="pochkada-dona">Pochkada donalar soni</label>
                                                <input value="{{$product->total_packages}}" readonly
                                                    style="background-color: #F5F5F7; border: 1px solid #ccc; color: #333;">
                                            </div>
                                            <div>
                                                <label for="aloqida-dona">Alohida dona</label>
                                                <input value="{{$product->total_units}}" readonly
                                                    style="background-color: #F5F5F7; border: 1px solid #ccc; color: #333;">
                                            </div>
                                            <div>
                                                <label for="tonna">Umumiy Tonna</label>
                                                <input value="{{$product->total_weight}}" readonly
                                                    style="background-color: #F5F5F7; border: 1px solid #ccc; color: #333;">
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!-- <div class="card-title">
                                                <h2>General</h2>
                                            </div> -->
                                    </div>


                                    <div class="card-body pt-0">
                                        <div class="product-info">

                                            <div>
                                                <h2>Operatsiya</h2>
                                                <form id="product-form"
                                                action="{{ route('product.addPackage', $product->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                              @csrf
                                              @method("PUT")
                                              <div class="stock-details">
                                                  <div>
                                                      <label for="pochkalar">Pochkalar qo'shish</label>
                                                      <input name="total_packages" type="text" id="pochkalar" value="0">
                                                  </div>

                                                  <div>
                                                      <label for="aloqida-dona">Alohida dona qo'shish</label>
                                                      <input type="text" name="total_units" id="aloqida-dona" value="0">
                                                  </div>
                                              </div>

                                              <div class="operations">
                                                  <button type="button" id="add-button">Qo'shish</button>
                                                  <button type="button" id="subtract-button">Ayrish</button>
                                              </div>
                                          </form>
                                            </div>

                                        </div>

                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                            </div>
                            <!--end::Card header-->
                        </div>
                    </div>
                </div>
                <!--end::Tab pane-->
                <!--begin::Tab pane-->
                <div class="tab-pane fade" id="kt_ecommerce_add_product_turnover" role="tabpanel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <h2>Mahsulot aylanmasi</h2>
                            </div>
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle gs-0 gy-4">
                                        <thead style="background: #e9edf1">
                                            <tr>
                                                <th>Kirim/Chiqim</th>
                                                <th>Sana</th>
                                                <th>Pochkalar soni</th>
                                                <th>Alohida dona soni</th>
                                                <th>Og'irlik (Tonna)</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($turnoverDetails as $turnover)
                                            <tr>
                                                <td>{{ $turnover['type'] }}</td>
                                                <td>{{ $turnover['date'] }}</td>
                                                <td>{{ $turnover['quantity_pack'] }}</td>
                                                <td>{{ $turnover['quantity_piece'] }}</td>
                                                <td>{{ $turnover['total_weight'] }} Tonna</td>
                                                <td>{{ $turnover['user_name'] ?? 'Ma\'lumot yo\'q' }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Aylanma ma'lumotlari mavjud emas.
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Inventory-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Sotuv tarixi</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="card mb-5 mb-xl-8">
                                    <!--begin::Header-->

                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">



                                            <table class="table table-bordered table-striped align-middle gs-0 gy-4">
                                                <thead style="background: #e9edf1 ">

                                                    <tr>
                                                        <th>Buyurtma vaqti</th>
                                                        <th>Buyurtma ID</th>
                                                        <th>Xaridor</th>
                                                        <th>Pachka</th>
                                                        <th>Dona</th>

                                                        <th>Jami Og'irlik (Tonna)</th>
                                                        <th>Jami Narx ($)</th>
                                                        <!-- <th>Bitta dona narxi ($)</th> -->
                                                        <th>Sotuvchi</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    @if ($salesDetails->isEmpty())
                                                    <tr>
                                                        <td colspan="10" class="text-center">Savdo tarixi mavjud emas.
                                                        </td>
                                                    </tr>
                                                    @else
                                                    @foreach ($salesDetails as $sale)
                                                    <tr>
                                                        <td>{{ $sale['created_at'] }}</td>
                                                        <td>{{ $sale['order_id'] }}</td>
                                                        <td>
                                                            <div class="info-block">
                                                                <strong>Ism:</strong> {{ $sale['sold_to'] }} <br>
                                                                <strong>Telefon:</strong> {{ $sale['sold_to_phone'] }}
                                                            </div>
                                                        </td>
                                                        <!-- <td>{{ $sale['times_sold'] }}</td> -->
                                                        <td>{{ $sale['quantity_pack'] }}</td>
                                                        <td>{{ $sale['quantity_piece'] }}</td>
                                                        <td>{{ $sale['total_weight'] }} Tonna</td>
                                                        <td>${{ $sale['total_price'] }}</td>

                                                        <td>
                                                            <div class="info-block">
                                                                <strong>ID:</strong> {{ $sale['sold_by_id'] ??
                                                                'Ma\'lumot yo\'q' }} <br>
                                                                <strong>Ism:</strong> {{ $sale['sold_by'] }} <br>
                                                                <strong>Email:</strong> {{ $sale['sold_by_phone'] }}
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            {{ $turnoverDetails->links() }}

                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--begin::Body-->
                                </div>


                            </div>
                            <!--end::Card header-->
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="kt_ecommerce_add_product_turnover" role="tabpanel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <h2>Mahsulot aylanmasi</h2>
                            </div>
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle gs-0 gy-4">
                                        <thead style="background: #e9edf1">
                                            <tr>
                                                <th>Kirim/Chiqim</th>
                                                <th>Sana</th>
                                                <th>Pochkalar soni</th>
                                                <th>Alohida dona soni</th>
                                                <th>Og'irlik (Tonna)</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($turnoverDetails as $turnover)
                                            <tr>
                                                <td>{{ $turnover['type'] }}</td>
                                                <td>{{ $turnover['date'] }}</td>
                                                <td>{{ $turnover['quantity_pack'] }}</td>
                                                <td>{{ $turnover['quantity_piece'] }}</td>
                                                <td>{{ $turnover['total_weight'] }} Tonna</td>
                                                <td>{{ $turnover['user_name'] ?? 'Ma\'lumot yo\'q' }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Aylanma ma'lumotlari mavjud emas.
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end::Tab pane-->
            </div>

        </div>
    </div>
</div>


@endsection
@section('scripts')
<script>
    document.getElementById("add-button").addEventListener("click", function () {
        const pochkalar = document.getElementById("pochkalar");
        const dona = document.getElementById("aloqida-dona");
        pochkalar.value = Math.abs(pochkalar.value) || 0; // Ensure positive values
        dona.value = Math.abs(dona.value) || 0;
        document.getElementById("product-form").submit(); // Submit form
    });

    document.getElementById("subtract-button").addEventListener("click", function () {
        const pochkalar = document.getElementById("pochkalar");
        const dona = document.getElementById("aloqida-dona");
        pochkalar.value = -Math.abs(pochkalar.value) || 0; // Ensure negative values
        dona.value = -Math.abs(dona.value) || 0;
        document.getElementById("product-form").submit(); // Submit form
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tabs = document.querySelectorAll('.tab');
        const productInfo = document.querySelector('.product-info');
        const salesHistory = document.querySelector('#sales-history');

        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                // Remove 'active' class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                // Toggle sections visibility
                if (this.textContent.includes('Mahsulot haqida')) {
                    productInfo.classList.remove('hidden');
                    salesHistory.classList.add('hidden');
                } else if (this.textContent.includes('Sotuv tarixi')) {
                    productInfo.classList.add('hidden');
                    salesHistory.classList.remove('hidden');
                    loadSalesHistory(); // Load sales history data dynamically
                }
            });
        });

    });
</script>
@endsection
