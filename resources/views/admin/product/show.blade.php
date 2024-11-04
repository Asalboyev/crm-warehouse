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

        .product-info, .stock-info {
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

        .sales-table th, .sales-table td {
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
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
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
{{--                <div class="d-flex align-items-center gap-2 gap-lg-3">--}}
{{--                    <button type="submit" class="btn btn-sm btn-primary">S</button>--}}
{{--                    <!--end::Primary button-->--}}
{{--                </div>--}}
                <!--end::Actions-->
            </div>
            <!--end::Container-->
        </div>

    </div>

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <!-- <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/products.html"> -->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                            href="#kt_ecommerce_add_product_general">Mahsulot haqida</a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#kt_ecommerce_add_product_advanced">Sotuv tarixi</a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade active show" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::General options-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!-- <div class="card-title">
                                        <h2>General</h2>
                                    </div> -->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="product-info">

                                        <div class="info-section">
                                            <div class="info-column">
                                                <h3>Umumiy ma'lumotlar</h3>
                                                <p><strong>Mahsulot nomi:</strong> {{$product->product_name}}</p>
                                                <p><strong>Kategoriya:</strong> {{$product->category->name}}</p>
                                                <!-- Assuming you have a relationship for category -->
                                                <p><strong>Davlat:</strong> {{$product->country}}</p>
                                                <p><strong>Qalinligi:</strong> {{$product->thickness}} mm</p>
                                                <p><strong>Uzunligi:</strong> {{$product->length}} Metr</p>
                                                <p><strong>Metal turi:</strong> {{$product->metal_type}}</p>
                                            </div>
                                            <div class="info-column">
                                                <h3>Parametrlar</h3>
                                                <p><strong>1 tonna narxi:</strong> {{$product->price_per_ton}} $</p>
                                                <p><strong>1 tonna uzunligi:</strong> {{$product->length_per_ton}} metr</p>
                                                <p><strong>1 metr uchun narx:</strong> {{$product->price_per_meter}} $</p>
                                                <p><strong>1 dona uchun narx:</strong> {{$product->price_per_item}} $</p>
                                                <p><strong>1 pochka narxi:</strong> {{$product->price_per_package}} $</p>
                                            </div>
                                            <div class="info-column">
                                                <h3>Qiymaatlari</h3>

                                                @if($product->items_per_package)
                                                <p><strong> pochkalar soni:</strong> {{$product->items_per_package}} ta</p>
                                                @endif

                                                @if($product->total_units)
                                                <p><strong>umumi donalar soni:</strong> {{$product->total_units}} ta</p>
                                                @endif
                                                @if($product->package_weight)
                                                <p><strong>1 pochkaning og'irligi:</strong> {{$product->package_weight}} Tonna</p>
                                                @endif

                                                @if($product->package_length)
                                                <p><strong>1 pochka uzunligi:</strong> {{$product->package_length}} metr</p>
                                                @endif

                                                @if($product->weight_per_meter)
                                                <p><strong>1 metr og'irligi:</strong> {{$product->weight_per_meter}} tonna</p>
                                                @endif

                                                @if($product->weight_per_item)
                                                <p><strong>1 dona og'irligi:</strong> {{$product->weight_per_item}} tonna</p>
                                                @endif

                                                @if($product->grains_package)
                                                <p><strong>Donalarning pochkadagi soni:</strong> {{$product->grains_package}} ta</p>
                                                @endif

                                                @if($product->total_packages)
                                                <p><strong>Ombordagi jami pochkalar soni:</strong> {{$product->total_packages}} ta</p>
                                                @endif

                                                @if($product->items_in_package)
                                                <p><strong>Pochkadagi mavjud donalar soni:</strong> {{$product->items_in_package}} ta</p>
                                                @endif

                                                @if($product->total_weight)
                                                <p><strong>Jami og'irligi:</strong> {{$product->total_weight}} Tonna</p>
                                                @endif
                                            </div>

                                        </div>
                                        <div>
                                            <h2>Qoldiq</h2>
                                            <form id="product-form" action="{{ route('product.addPackage', $product->id) }}" method="POST"
                                                enctype="multipart/form-data" class="stock-info">
                                                @csrf
                                                @method("PUT")
                                                <div class="stock-details">
                                                    <div>
                                                        <label for="pochkalar">Pochkalar soni</label>
                                                        <input name="items_per_package" type="text" id="pochkalar"
                                                            value="{{$product->items_per_package}}">
                                                    </div>
                                                    <div>
                                                        <label for="pochkada-dona">Pochkada donalar soni</label>
                                                        <input type="text" name="total_packages" id="pochkada-dona"
                                                            value="{{$product->total_packages}}">
                                                    </div>
                                                    <div>
                                                        <label for="aloqida-dona">Alohida dona</label>
                                                        <input type="text" name="total_units" id="aloqida-dona" value="{{$product->total_units}}">
                                                    </div>
                                                    <div>
                                                        <label for="tonna">Umumiy Tonna</label>
                                                        <input type="text" id="tonna" name="total_weight" value="{{$product->total_weight}}">
                                                    </div>
                                                </div>

                                                <div class="operations">
                                                    <button>Qo'shish </button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>

                                    <!--end::Input group-->
                                </div>
                                <!--end::Card header-->
                            </div>
                        </div>
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::Inventory-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Inventory</h2>
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

                                                <table class="table align-middle gs-0 gy-4">
                                                    <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Nechi marta sotilgan</th>
                                                        <th>Seller</th>
                                                        <th>Buyer</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody >
                                                    @if ($salesDetails->isEmpty())
                                                        <tr>
                                                            <td colspan="4" class="text-center">Sotuv tarixi mavjud emas.</td>
                                                        </tr>
                                                    @else
                                                        @foreach ($salesDetails as $sale)
                                                            <tr>
                                                                <td>  <span class="text-muted fw-bold text-muted d-block fs-7">{{ $sale['order_id'] }}</span></td>

                                                                <td><span class="text-muted fw-bold text-muted d-block fs-7">{{ $sale['times_sold'] }}</span> </td>
                                                                <!-- Seller details -->
                                                                <!-- <td>
                                                                    <strong>ID:</strong> {{ $sale['sold_by_id'] ?? 'N/A' }} <br>
                                                                    <strong>Name:</strong> {{ $sale['sold_by'] }} <br>
                                                                    <strong>Email:</strong> {{ $sale['sold_by_phone'] }}
                                                                </td>
                                                                <!-- Buyer details -->
                                                                <td>
                                                                    <span class="text-muted fw-bold text-muted d-block fs-7"><strong>ID:</strong> {{ $sale['sold_to_id'] ?? 'N/A' }} <br>
                                                                        <strong>Name:</strong> {{ $sale['sold_to'] }} <br>
                                                                        <strong>Phone:</strong> {{ $sale['sold_to_phone'] }}</span>
                                                                </td>
                                                                <td>
                                                                    <strong>ID:</strong> {{ $sale['sold_to_id'] ?? 'N/A' }} <br>
                                                                            <strong>Name:</strong> {{ $sale['sold_to'] }} <br>
                                                                            <strong>Phone:</strong> {{ $sale['sold_to_phone'] }}
                                                                        </td>
                                                            </tr>
                                                         @endforeach
                                                    @endif
                                                     </tbody>
                                                 </table>
                                                <!--end::Table-->
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
                    <!--end::Tab pane-->
                </div>

            </div>
    </div>


@endsection
@section('scripts')

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
 

