@extends('layouts.admin')
@section('title')
    Dashboard
@endsection
@section('style')
    <link href="{{ asset('/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css" />
    <link href="{{ asset('/assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet"
          type="text/css" />

    <link href="{{ asset('/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">eCommerce Dashboard</h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Secondary button-->
                    <a href="../../demo1/dist/apps/ecommerce/sales/listing.html" class="btn btn-sm btn-light">Manage Sales</a>
                    <!--end::Secondary button-->
                    <!--begin::Primary button-->
                    <a href="../../demo1/dist/apps/ecommerce/catalog/add-product.html" class="btn btn-sm btn-primary">Add Product</a>
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Row-->
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row gy-10 g-xl-16">
                    <!--begin::Col-->
                    <div class="col-xl-14 mb-xl-10">
                        <!--begin::Tables widget 2-->
                        <div class="card h-md-100">
                            <!--begin::Header-->
                            <div class="card-header align-items-center border-0">
                                <!--begin::Title-->
                                <h3 class="fw-bolder text-gray-900 m-0">Recent Orders</h3>
                                <!--end::Title-->
                                <!--begin::Menu-->
                                <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                    <span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
															<rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
															<rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
															<rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
														</svg>
													</span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--begin::Menu 2-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Quick Actions</div>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator mb-3 opacity-75"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">New Ticket</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">New Customer</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                        <!--begin::Menu item-->
                                        <a href="#" class="menu-link px-3">
                                            <span class="menu-title">New Group</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <!--end::Menu item-->
                                        <!--begin::Menu sub-->
                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Admin Group</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Staff Group</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Member Group</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu sub-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">New Contact</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator mt-3 opacity-75"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content px-3 py-3">
                                            <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                        </div>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu 2-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-2">
                                <!--begin::Nav-->
                                <ul class="nav nav-pills nav-pills-custom mb-3">
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3 me-3 me-lg-6">
                                        <!--begin::Link-->
                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden active w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_1">
                                            <!--begin::Icon-->
                                            <div class="nav-icon">
                                                <img alt="" src="assets/media/svg/products-categories/t-shirt.svg" class="" />
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Subtitle-->
                                            <span class="nav-text text-gray-700 fw-bolder fs-6 lh-1">T-shirt</span>
                                            <!--end::Subtitle-->
                                            <!--begin::Bullet-->
                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                            <!--end::Bullet-->
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3 me-3 me-lg-6">
                                        <!--begin::Link-->
                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_2">
                                            <!--begin::Icon-->
                                            <div class="nav-icon">
                                                <img alt="" src="assets/media/svg/products-categories/gaming.svg" class="" />
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Subtitle-->
                                            <span class="nav-text text-gray-700 fw-bolder fs-6 lh-1">Gaming</span>
                                            <!--end::Subtitle-->
                                            <!--begin::Bullet-->
                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                            <!--end::Bullet-->
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3 me-3 me-lg-6">
                                        <!--begin::Link-->
                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_3">
                                            <!--begin::Icon-->
                                            <div class="nav-icon">
                                                <img alt="" src="assets/media/svg/products-categories/watch.svg" class="" />
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Subtitle-->
                                            <span class="nav-text text-gray-600 fw-bolder fs-6 lh-1">Watch</span>
                                            <!--end::Subtitle-->
                                            <!--begin::Bullet-->
                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                            <!--end::Bullet-->
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3 me-3 me-lg-6">
                                        <!--begin::Link-->
                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_4">
                                            <!--begin::Icon-->
                                            <div class="nav-icon">
                                                <img alt="" src="assets/media/svg/products-categories/gloves.svg" class="nav-icon" />
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Subtitle-->
                                            <span class="nav-text text-gray-600 fw-bolder fs-6 lh-1">Gloves</span>
                                            <!--end::Subtitle-->
                                            <!--begin::Bullet-->
                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                            <!--end::Bullet-->
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3">
                                        <!--begin::Link-->
                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_5">
                                            <!--begin::Icon-->
                                            <div class="nav-icon">
                                                <img alt="" src="assets/media/svg/products-categories/shoes.svg" class="nav-icon" />
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Subtitle-->
                                            <span class="nav-text text-gray-600 fw-bolder fs-6 lh-1">Shoes</span>
                                            <!--end::Subtitle-->
                                            <!--begin::Bullet-->
                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                            <!--end::Bullet-->
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Nav-->
                                <!--begin::Tab Content-->
                                <div class="tab-content">
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade show active" id="kt_stats_widget_2_tab_1">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                                <!--begin::Table head-->
                                                <thead>
                                                <tr class="fs-7 fw-bolder text-gray-500 border-bottom-0">
                                                    <th class="ps-0 w-50px">ITEM</th>
                                                    <th class="min-w-140px"></th>
                                                    <th class="text-end min-w-140px">QTY</th>
                                                    <th class="pe-0 text-end min-w-120px">PRICE</th>
                                                    <th class="pe-0 text-end min-w-120px">TOTAL PRICE</th>
                                                </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Elephant 1802</a>
                                                        <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">Item: #XDG-2347</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end">x1</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$72.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$126.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="assets/media/stock/ecommerce/215.gif" class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Red Laga</a>
                                                        <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">Item: #XDG-1321</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end">x2</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$45.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$76.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="assets/media/stock/ecommerce/209.gif" class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">RiseUP</a>
                                                        <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">Item: #XDG-4312</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end">x3</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$84.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$168.00</span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade" id="kt_stats_widget_2_tab_2">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                                <!--begin::Table head-->
                                                <thead>
                                                <tr class="fs-7 fw-bolder text-gray-500 border-bottom-0">
                                                    <th class="ps-0 w-50px">ITEM</th>
                                                    <th class="min-w-140px"></th>
                                                    <th class="text-end min-w-140px">QTY</th>
                                                    <th class="pe-0 text-end min-w-120px">PRICE</th>
                                                    <th class="pe-0 text-end min-w-120px">TOTAL PRICE</th>
                                                </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="assets/media/stock/ecommerce/197.gif" class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Elephant 1802</a>
                                                        <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">Item: #XDG-4312</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end">x1</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$32.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$312.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="assets/media/stock/ecommerce/178.gif" class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Red Laga</a>
                                                        <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">Item: #XDG-3122</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end">x2</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$53.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$62.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="assets/media/stock/ecommerce/22.gif" class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">RiseUP</a>
                                                        <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">Item: #XDG-1142</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end">x3</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$74.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$139.00</span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade" id="kt_stats_widget_2_tab_3">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                                <!--begin::Table head-->
                                                <thead>
                                                <tr class="fs-7 fw-bolder text-gray-500 border-bottom-0">
                                                    <th class="ps-0 w-50px">ITEM</th>
                                                    <th class="min-w-140px"></th>
                                                    <th class="text-end min-w-140px">QTY</th>
                                                    <th class="pe-0 text-end min-w-120px">PRICE</th>
                                                    <th class="pe-0 text-end min-w-120px">TOTAL PRICE</th>
                                                </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="assets/media/stock/ecommerce/1.gif" class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Elephant 1324</a>
                                                        <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">Item: #XDG-1523</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end">x1</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$43.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$231.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="assets/media/stock/ecommerce/24.gif" class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Red Laga</a>
                                                        <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">Item: #XDG-5314</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end">x2</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$71.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$53.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="assets/media/stock/ecommerce/71.gif" class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">RiseUP</a>
                                                        <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">Item: #XDG-4222</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end">x3</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$23.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$213.00</span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade" id="kt_stats_widget_2_tab_4">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                                <!--begin::Table head-->
                                                <thead>
                                                <tr class="fs-7 fw-bolder text-gray-500 border-bottom-0">
                                                    <th class="ps-0 w-50px">ITEM</th>
                                                    <th class="min-w-140px"></th>
                                                    <th class="text-end min-w-140px">QTY</th>
                                                    <th class="pe-0 text-end min-w-120px">PRICE</th>
                                                    <th class="pe-0 text-end min-w-120px">TOTAL PRICE</th>
                                                </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="assets/media/stock/ecommerce/41.gif" class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Elephant 2635</a>
                                                        <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">Item: #XDG-1523</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end">x1</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$65.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$163.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="assets/media/stock/ecommerce/63.gif" class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Red Laga</a>
                                                        <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">Item: #XDG-2745</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end">x2</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$64.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$73.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="assets/media/stock/ecommerce/59.gif" class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">RiseUP</a>
                                                        <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">Item: #XDG-5173</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end">x3</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$54.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$173.00</span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade" id="kt_stats_widget_2_tab_5">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                                <!--begin::Table head-->
                                                <thead>
                                                <tr class="fs-7 fw-bolder text-gray-500 border-bottom-0">
                                                    <th class="ps-0 w-50px">ITEM</th>
                                                    <th class="min-w-140px"></th>
                                                    <th class="text-end min-w-140px">QTY</th>
                                                    <th class="pe-0 text-end min-w-120px">PRICE</th>
                                                    <th class="pe-0 text-end min-w-120px">TOTAL PRICE</th>
                                                </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="assets/media/stock/ecommerce/10.gif" class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Nike</a>
                                                        <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">Item: #XDG-2163</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end">x1</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$64.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$287.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="assets/media/stock/ecommerce/96.gif" class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Adidas</a>
                                                        <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">Item: #XDG-2162</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end">x2</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$76.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$51.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="assets/media/stock/ecommerce/13.gif" class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0">Puma</a>
                                                        <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">Item: #XDG-1537</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-800 fw-bolder d-block fs-6 ps-0 text-end">x3</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$27.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">$167.00</span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Tap pane-->
                                </div>
                                <!--end::Tab Content-->
                            </div>
                            <!--end: Card Body-->
                        </div>
                        <!--end::Tables widget 2-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-6 mb-5 mb-xl-10">
                        <!--begin::Chart widget 4-->
                        <!--end::Chart widget 4-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row gy-5 g-xl-10">
                    <!--begin::Col-->
                    <div class="col-xl-4 mb-xl-10">
                        <!--begin::Engage widget 1-->
                        <div class="card h-md-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column flex-center">
                                <!--begin::Heading-->
                                <div class="mb-2">
                                    <!--begin::Title-->
                                    <h1 class="fw-bold text-gray-800 text-center lh-lg">Have you tried
                                        <br />new
                                        <span class="fw-boldest">eCommerce App ?</span></h1>
                                    <!--end::Title-->
                                    <!--begin::Illustration-->
                                    <div class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center card-rounded-bottom h-200px mh-200px my-5 my-lg-12" style="background-image:url('assets/media/svg/illustrations/easy/2.svg')"></div>
                                    <!--end::Illustration-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Links-->
                                <div class="text-center mb-1">
                                    <!--begin::Link-->
                                    <a class="btn btn-sm btn-primary me-2" href="../../demo1/dist/apps/ecommerce/sales/listing.html">View App</a>
                                    <!--end::Link-->
                                    <!--begin::Link-->
                                    <a class="btn btn-sm btn-light" href="../../demo1/dist/apps/ecommerce/catalog/add-product.html">New Product</a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Links-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Engage widget 1-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-8 mb-5 mb-xl-10">
                        <!--begin::Table Widget 4-->
                        <div class="card card-flush h-xl-100">
                            <!--begin::Card header-->
                            <div class="card-header pt-7">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder text-gray-800">Product Orders</span>
                                    <span class="text-gray-400 mt-1 fw-bold fs-6">Avg. 57 orders per day</span>
                                </h3>
                                <!--end::Title-->
                                <!--begin::Actions-->
                                <div class="card-toolbar">
                                    <!--begin::Filters-->
                                    <div class="d-flex flex-stack flex-wrap gap-4">
                                        <!--begin::Destination-->
                                        <div class="d-flex align-items-center fw-bolder">
                                            <!--begin::Label-->
                                            <div class="text-gray-400 fs-7 me-2">Cateogry</div>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bolder py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option">
                                                <option></option>
                                                <option value="Show All" selected="selected">Show All</option>
                                                <option value="a">Category A</option>
                                                <option value="b">Category A</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Destination-->
                                        <!--begin::Status-->
                                        <div class="d-flex align-items-center fw-bolder">
                                            <!--begin::Label-->
                                            <div class="text-gray-400 fs-7 me-2">Status</div>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select class="form-select form-select-transparent text-dark fs-7 lh-1 fw-bolder py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option" data-kt-table-widget-4="filter_status">
                                                <option></option>
                                                <option value="Show All" selected="selected">Show All</option>
                                                <option value="Shipped">Shipped</option>
                                                <option value="Confirmed">Confirmed</option>
                                                <option value="Rejected">Rejected</option>
                                                <option value="Pending">Pending</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Status-->
                                        <!--begin::Search-->
                                        <div class="position-relative my-1">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                            <span class="svg-icon svg-icon-2 position-absolute top-50 translate-middle-y ms-4">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
																	<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
																</svg>
															</span>
                                            <!--end::Svg Icon-->
                                            <input type="text" data-kt-table-widget-4="search" class="form-control w-150px fs-7 ps-12" placeholder="Search" />
                                        </div>
                                        <!--end::Search-->
                                    </div>
                                    <!--begin::Filters-->
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-2">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_4_table">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px">Order ID</th>
                                        <th class="text-end min-w-100px">Created</th>
                                        <th class="text-end min-w-125px">Customer</th>
                                        <th class="text-end min-w-100px">Total</th>
                                        <th class="text-end min-w-100px">Profit</th>
                                        <th class="text-end min-w-50px">Status</th>
                                        <th class="text-end"></th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bolder text-gray-600">
                                    <tr data-kt-table-widget-4="subtable_template" class="d-none">
                                        <td colspan="2">
                                            <div class="d-flex align-items-center gap-3">
                                                <a href="#" class="symbol symbol-50px bg-secondary bg-opacity-25 rounded">
                                                    <img src="" data-kt-src-path="assets/media/stock/ecommerce/" alt="" data-kt-table-widget-4="template_image" />
                                                </a>
                                                <div class="d-flex flex-column text-muted">
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-bolder" data-kt-table-widget-4="template_name">Product name</a>
                                                    <div class="fs-7" data-kt-table-widget-4="template_description">Product description</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="text-gray-800 fs-7">Cost</div>
                                            <div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_cost">1</div>
                                        </td>
                                        <td class="text-end">
                                            <div class="text-gray-800 fs-7">Qty</div>
                                            <div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_qty">1</div>
                                        </td>
                                        <td class="text-end">
                                            <div class="text-gray-800 fs-7">Total</div>
                                            <div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_total">name</div>
                                        </td>
                                        <td class="text-end">
                                            <div class="text-gray-800 fs-7 me-3">On hand</div>
                                            <div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_stock">32</div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#XGY-346</a>
                                        </td>
                                        <td class="text-end">7 min ago</td>
                                        <td class="text-end">
                                            <a href="#" class="text-gray-600 text-hover-primary">Albert Flores</a>
                                        </td>
                                        <td class="text-end">$630.00</td>
                                        <td class="text-end">
                                            <span class="text-gray-800 fw-boldest">$86.70</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-warning">Pending</span>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                <span class="svg-icon svg-icon-3 m-0 toggle-off">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																			<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
                                                <!--end::Svg Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                                <span class="svg-icon svg-icon-3 m-0 toggle-on">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
                                                <!--end::Svg Icon-->
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#YHD-047</a>
                                        </td>
                                        <td class="text-end">52 min ago</td>
                                        <td class="text-end">
                                            <a href="#" class="text-gray-600 text-hover-primary">Jenny Wilson</a>
                                        </td>
                                        <td class="text-end">$25.00</td>
                                        <td class="text-end">
                                            <span class="text-gray-800 fw-boldest">$4.20</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-primary">Confirmed</span>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                <span class="svg-icon svg-icon-3 m-0 toggle-off">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																			<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
                                                <!--end::Svg Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                                <span class="svg-icon svg-icon-3 m-0 toggle-on">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
                                                <!--end::Svg Icon-->
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#SRR-678</a>
                                        </td>
                                        <td class="text-end">1 hour ago</td>
                                        <td class="text-end">
                                            <a href="#" class="text-gray-600 text-hover-primary">Robert Fox</a>
                                        </td>
                                        <td class="text-end">$1,630.00</td>
                                        <td class="text-end">
                                            <span class="text-gray-800 fw-boldest">$203.90</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-warning">Pending</span>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                <span class="svg-icon svg-icon-3 m-0 toggle-off">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																			<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
                                                <!--end::Svg Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                                <span class="svg-icon svg-icon-3 m-0 toggle-on">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
                                                <!--end::Svg Icon-->
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#PXF-534</a>
                                        </td>
                                        <td class="text-end">3 hour ago</td>
                                        <td class="text-end">
                                            <a href="#" class="text-gray-600 text-hover-primary">Cody Fisher</a>
                                        </td>
                                        <td class="text-end">$119.00</td>
                                        <td class="text-end">
                                            <span class="text-gray-800 fw-boldest">$12.00</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                <span class="svg-icon svg-icon-3 m-0 toggle-off">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																			<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
                                                <!--end::Svg Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                                <span class="svg-icon svg-icon-3 m-0 toggle-on">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
                                                <!--end::Svg Icon-->
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#XGD-249</a>
                                        </td>
                                        <td class="text-end">2 day ago</td>
                                        <td class="text-end">
                                            <a href="#" class="text-gray-600 text-hover-primary">Arlene McCoy</a>
                                        </td>
                                        <td class="text-end">$660.00</td>
                                        <td class="text-end">
                                            <span class="text-gray-800 fw-boldest">$52.26</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                <span class="svg-icon svg-icon-3 m-0 toggle-off">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																			<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
                                                <!--end::Svg Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                                <span class="svg-icon svg-icon-3 m-0 toggle-on">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
                                                <!--end::Svg Icon-->
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#SKP-035</a>
                                        </td>
                                        <td class="text-end">2 day ago</td>
                                        <td class="text-end">
                                            <a href="#" class="text-gray-600 text-hover-primary">Eleanor Pena</a>
                                        </td>
                                        <td class="text-end">$290.00</td>
                                        <td class="text-end">
                                            <span class="text-gray-800 fw-boldest">$29.00</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-danger">Rejected</span>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                <span class="svg-icon svg-icon-3 m-0 toggle-off">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																			<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
                                                <!--end::Svg Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                                <span class="svg-icon svg-icon-3 m-0 toggle-on">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
                                                <!--end::Svg Icon-->
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#SKP-567</a>
                                        </td>
                                        <td class="text-end">7 min ago</td>
                                        <td class="text-end">
                                            <a href="#" class="text-gray-600 text-hover-primary">Dan Wilson</a>
                                        </td>
                                        <td class="text-end">$590.00</td>
                                        <td class="text-end">
                                            <span class="text-gray-800 fw-boldest">$50.00</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                <span class="svg-icon svg-icon-3 m-0 toggle-off">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																			<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
                                                <!--end::Svg Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                                <span class="svg-icon svg-icon-3 m-0 toggle-on">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
                                                <!--end::Svg Icon-->
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Table Widget 4-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row gy-5 g-xl-10">
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <!--begin::List widget 5-->
                        <div class="card card-flush h-xl-100">
                            <!--begin::Header-->
                            <div class="card-header pt-7">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder text-dark">Product Delivery</span>
                                    <span class="text-gray-400 mt-1 fw-bold fs-6">1M Products Shipped so far</span>
                                </h3>
                                <!--end::Title-->
                                <!--begin::Toolbar-->
                                <div class="card-toolbar">
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="btn btn-sm btn-light">Order Details</a>
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Scroll-->
                                <div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 415px">
                                    <!--begin::Item-->
                                    <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                        <!--begin::Info-->
                                        <div class="d-flex flex-stack mb-3">
                                            <!--begin::Wrapper-->
                                            <div class="me-3">
                                                <!--begin::Icon-->
                                                <img src="assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                <!--end::Icon-->
                                                <!--begin::Title-->
                                                <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Wrapper-->
                                            <!--begin::Action-->
                                            <div class="m-0">
                                                <!--begin::Menu-->
                                                <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                    <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
																			<rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																			<rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																			<rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																		</svg>
																	</span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                                <!--begin::Menu 2-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Quick Actions</div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator mb-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Ticket</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Customer</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                                        <!--begin::Menu item-->
                                                        <a href="#" class="menu-link px-3">
                                                            <span class="menu-title">New Group</span>
                                                            <span class="menu-arrow"></span>
                                                        </a>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu sub-->
                                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Admin Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Staff Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Member Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu sub-->
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Contact</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator mt-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3 py-3">
                                                            <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                                        </div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu 2-->
                                                <!--end::Menu-->
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Customer-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Name-->
                                            <span class="text-gray-400 fw-bolder">To:
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">Jason Bourne</a></span>
                                            <!--end::Name-->
                                            <!--begin::Label-->
                                            <span class="badge badge-light-success">Delivered</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Customer-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                        <!--begin::Info-->
                                        <div class="d-flex flex-stack mb-3">
                                            <!--begin::Wrapper-->
                                            <div class="me-3">
                                                <!--begin::Icon-->
                                                <img src="assets/media/stock/ecommerce/209.gif" class="w-50px ms-n1 me-1" alt="" />
                                                <!--end::Icon-->
                                                <!--begin::Title-->
                                                <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">RiseUP</a>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Wrapper-->
                                            <!--begin::Action-->
                                            <div class="m-0">
                                                <!--begin::Menu-->
                                                <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                    <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
																			<rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																			<rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																			<rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																		</svg>
																	</span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                                <!--begin::Menu 2-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Quick Actions</div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator mb-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Ticket</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Customer</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                                        <!--begin::Menu item-->
                                                        <a href="#" class="menu-link px-3">
                                                            <span class="menu-title">New Group</span>
                                                            <span class="menu-arrow"></span>
                                                        </a>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu sub-->
                                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Admin Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Staff Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Member Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu sub-->
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Contact</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator mt-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3 py-3">
                                                            <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                                        </div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu 2-->
                                                <!--end::Menu-->
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Customer-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Name-->
                                            <span class="text-gray-400 fw-bolder">To:
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">Marie Durant</a></span>
                                            <!--end::Name-->
                                            <!--begin::Label-->
                                            <span class="badge badge-light-primary">Shipping</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Customer-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                        <!--begin::Info-->
                                        <div class="d-flex flex-stack mb-3">
                                            <!--begin::Wrapper-->
                                            <div class="me-3">
                                                <!--begin::Icon-->
                                                <img src="assets/media/stock/ecommerce/214.gif" class="w-50px ms-n1 me-1" alt="" />
                                                <!--end::Icon-->
                                                <!--begin::Title-->
                                                <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Yellow Stone</a>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Wrapper-->
                                            <!--begin::Action-->
                                            <div class="m-0">
                                                <!--begin::Menu-->
                                                <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                    <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
																			<rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																			<rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																			<rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																		</svg>
																	</span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                                <!--begin::Menu 2-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Quick Actions</div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator mb-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Ticket</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Customer</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                                        <!--begin::Menu item-->
                                                        <a href="#" class="menu-link px-3">
                                                            <span class="menu-title">New Group</span>
                                                            <span class="menu-arrow"></span>
                                                        </a>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu sub-->
                                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Admin Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Staff Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Member Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu sub-->
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Contact</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator mt-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3 py-3">
                                                            <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                                        </div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu 2-->
                                                <!--end::Menu-->
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Customer-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Name-->
                                            <span class="text-gray-400 fw-bolder">To:
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">Dan Wilson</a></span>
                                            <!--end::Name-->
                                            <!--begin::Label-->
                                            <span class="badge badge-light-danger">Confirmed</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Customer-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                        <!--begin::Info-->
                                        <div class="d-flex flex-stack mb-3">
                                            <!--begin::Wrapper-->
                                            <div class="me-3">
                                                <!--begin::Icon-->
                                                <img src="assets/media/stock/ecommerce/211.gif" class="w-50px ms-n1 me-1" alt="" />
                                                <!--end::Icon-->
                                                <!--begin::Title-->
                                                <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Wrapper-->
                                            <!--begin::Action-->
                                            <div class="m-0">
                                                <!--begin::Menu-->
                                                <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                    <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
																			<rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																			<rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																			<rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																		</svg>
																	</span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                                <!--begin::Menu 2-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Quick Actions</div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator mb-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Ticket</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Customer</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                                        <!--begin::Menu item-->
                                                        <a href="#" class="menu-link px-3">
                                                            <span class="menu-title">New Group</span>
                                                            <span class="menu-arrow"></span>
                                                        </a>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu sub-->
                                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Admin Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Staff Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Member Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu sub-->
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Contact</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator mt-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3 py-3">
                                                            <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                                        </div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu 2-->
                                                <!--end::Menu-->
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Customer-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Name-->
                                            <span class="text-gray-400 fw-bolder">To:
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">Lebron Wayde</a></span>
                                            <!--end::Name-->
                                            <!--begin::Label-->
                                            <span class="badge badge-light-success">Delivered</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Customer-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                        <!--begin::Info-->
                                        <div class="d-flex flex-stack mb-3">
                                            <!--begin::Wrapper-->
                                            <div class="me-3">
                                                <!--begin::Icon-->
                                                <img src="assets/media/stock/ecommerce/215.gif" class="w-50px ms-n1 me-1" alt="" />
                                                <!--end::Icon-->
                                                <!--begin::Title-->
                                                <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">RiseUP</a>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Wrapper-->
                                            <!--begin::Action-->
                                            <div class="m-0">
                                                <!--begin::Menu-->
                                                <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                    <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
																			<rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																			<rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																			<rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																		</svg>
																	</span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                                <!--begin::Menu 2-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Quick Actions</div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator mb-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Ticket</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Customer</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                                        <!--begin::Menu item-->
                                                        <a href="#" class="menu-link px-3">
                                                            <span class="menu-title">New Group</span>
                                                            <span class="menu-arrow"></span>
                                                        </a>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu sub-->
                                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Admin Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Staff Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Member Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu sub-->
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Contact</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator mt-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3 py-3">
                                                            <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                                        </div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu 2-->
                                                <!--end::Menu-->
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Customer-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Name-->
                                            <span class="text-gray-400 fw-bolder">To:
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">Ana Simmons</a></span>
                                            <!--end::Name-->
                                            <!--begin::Label-->
                                            <span class="badge badge-light-primary">Shipping</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Customer-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3">
                                        <!--begin::Info-->
                                        <div class="d-flex flex-stack mb-3">
                                            <!--begin::Wrapper-->
                                            <div class="me-3">
                                                <!--begin::Icon-->
                                                <img src="assets/media/stock/ecommerce/192.gif" class="w-50px ms-n1 me-1" alt="" />
                                                <!--end::Icon-->
                                                <!--begin::Title-->
                                                <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Yellow Stone</a>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Wrapper-->
                                            <!--begin::Action-->
                                            <div class="m-0">
                                                <!--begin::Menu-->
                                                <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                    <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
																			<rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																			<rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																			<rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
																		</svg>
																	</span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                                <!--begin::Menu 2-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Quick Actions</div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator mb-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Ticket</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Customer</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                                        <!--begin::Menu item-->
                                                        <a href="#" class="menu-link px-3">
                                                            <span class="menu-title">New Group</span>
                                                            <span class="menu-arrow"></span>
                                                        </a>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu sub-->
                                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Admin Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Staff Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Member Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu sub-->
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">New Contact</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator mt-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3 py-3">
                                                            <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                                        </div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu 2-->
                                                <!--end::Menu-->
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Customer-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Name-->
                                            <span class="text-gray-400 fw-bolder">To:
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">Kevin Leonard</a></span>
                                            <!--end::Name-->
                                            <!--begin::Label-->
                                            <span class="badge badge-light-danger">Confirmed</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Customer-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Scroll-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::List widget 5-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-8">
                        <!--begin::Table Widget 5-->
                        <div class="card card-flush h-xl-100">
                            <!--begin::Card header-->
                            <div class="card-header pt-7">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder text-dark">Stock Report</span>
                                    <span class="text-gray-400 mt-1 fw-bold fs-6">Total 2,356 Items in the Stock</span>
                                </h3>
                                <!--end::Title-->
                                <!--begin::Actions-->
                                <div class="card-toolbar">
                                    <!--begin::Filters-->
                                    <div class="d-flex flex-stack flex-wrap gap-4">
                                        <!--begin::Destination-->
                                        <div class="d-flex align-items-center fw-bolder">
                                            <!--begin::Label-->
                                            <div class="text-muted fs-7 me-2">Cateogry</div>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select class="form-select form-select-transparent text-dark fs-7 lh-1 fw-bolder py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option">
                                                <option></option>
                                                <option value="Show All" selected="selected">Show All</option>
                                                <option value="a">Category A</option>
                                                <option value="b">Category B</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Destination-->
                                        <!--begin::Status-->
                                        <div class="d-flex align-items-center fw-bolder">
                                            <!--begin::Label-->
                                            <div class="text-muted fs-7 me-2">Status</div>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select class="form-select form-select-transparent text-dark fs-7 lh-1 fw-bolder py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option" data-kt-table-widget-5="filter_status">
                                                <option></option>
                                                <option value="Show All" selected="selected">Show All</option>
                                                <option value="In Stock">In Stock</option>
                                                <option value="Out of Stock">Out of Stock</option>
                                                <option value="Low Stock">Low Stock</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Status-->
                                        <!--begin::Search-->
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/products.html" class="btn btn-light btn-sm">View Stock</a>
                                        <!--end::Search-->
                                    </div>
                                    <!--begin::Filters-->
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px">Item</th>
                                        <th class="text-end pe-3 min-w-100px">Product ID</th>
                                        <th class="text-end pe-3 min-w-150px">Date Added</th>
                                        <th class="text-end pe-3 min-w-100px">Price</th>
                                        <th class="text-end pe-3 min-w-50px">Status</th>
                                        <th class="text-end pe-0 min-w-25px">Qty</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bolder text-gray-600">
                                    <tr>
                                        <!--begin::Item-->
                                        <td>
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">Macbook Air M1</a>
                                        </td>
                                        <!--end::Item-->
                                        <!--begin::Product ID-->
                                        <td class="text-end">#XGY-356</td>
                                        <!--end::Product ID-->
                                        <!--begin::Date added-->
                                        <td class="text-end">02 Apr, 2022</td>
                                        <!--end::Date added-->
                                        <!--begin::Price-->
                                        <td class="text-end">$1,230</td>
                                        <!--end::Price-->
                                        <!--begin::Status-->
                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
                                        </td>
                                        <!--end::Status-->
                                        <!--begin::Qty-->
                                        <td class="text-end" data-order="58">
                                            <span class="text-dark fw-bolder">58 PCS</span>
                                        </td>
                                        <!--end::Qty-->
                                    </tr>
                                    <tr>
                                        <!--begin::Item-->
                                        <td>
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">Surface Laptop 4</a>
                                        </td>
                                        <!--end::Item-->
                                        <!--begin::Product ID-->
                                        <td class="text-end">#YHD-047</td>
                                        <!--end::Product ID-->
                                        <!--begin::Date added-->
                                        <td class="text-end">01 Apr, 2022</td>
                                        <!--end::Date added-->
                                        <!--begin::Price-->
                                        <td class="text-end">$1,060</td>
                                        <!--end::Price-->
                                        <!--begin::Status-->
                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-danger">Out of Stock</span>
                                        </td>
                                        <!--end::Status-->
                                        <!--begin::Qty-->
                                        <td class="text-end" data-order="0">
                                            <span class="text-dark fw-bolder">0 PCS</span>
                                        </td>
                                        <!--end::Qty-->
                                    </tr>
                                    <tr>
                                        <!--begin::Item-->
                                        <td>
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">Logitech MX 250</a>
                                        </td>
                                        <!--end::Item-->
                                        <!--begin::Product ID-->
                                        <td class="text-end">#SRR-678</td>
                                        <!--end::Product ID-->
                                        <!--begin::Date added-->
                                        <td class="text-end">24 Mar, 2022</td>
                                        <!--end::Date added-->
                                        <!--begin::Price-->
                                        <td class="text-end">$64</td>
                                        <!--end::Price-->
                                        <!--begin::Status-->
                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
                                        </td>
                                        <!--end::Status-->
                                        <!--begin::Qty-->
                                        <td class="text-end" data-order="290">
                                            <span class="text-dark fw-bolder">290 PCS</span>
                                        </td>
                                        <!--end::Qty-->
                                    </tr>
                                    <tr>
                                        <!--begin::Item-->
                                        <td>
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">AudioEngine HD3</a>
                                        </td>
                                        <!--end::Item-->
                                        <!--begin::Product ID-->
                                        <td class="text-end">#PXF-578</td>
                                        <!--end::Product ID-->
                                        <!--begin::Date added-->
                                        <td class="text-end">24 Mar, 2022</td>
                                        <!--end::Date added-->
                                        <!--begin::Price-->
                                        <td class="text-end">$1,060</td>
                                        <!--end::Price-->
                                        <!--begin::Status-->
                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-danger">Out of Stock</span>
                                        </td>
                                        <!--end::Status-->
                                        <!--begin::Qty-->
                                        <td class="text-end" data-order="46">
                                            <span class="text-dark fw-bolder">46 PCS</span>
                                        </td>
                                        <!--end::Qty-->
                                    </tr>
                                    <tr>
                                        <!--begin::Item-->
                                        <td>
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">HP Hyper LTR</a>
                                        </td>
                                        <!--end::Item-->
                                        <!--begin::Product ID-->
                                        <td class="text-end">#PXF-778</td>
                                        <!--end::Product ID-->
                                        <!--begin::Date added-->
                                        <td class="text-end">16 Jan, 2022</td>
                                        <!--end::Date added-->
                                        <!--begin::Price-->
                                        <td class="text-end">$4500</td>
                                        <!--end::Price-->
                                        <!--begin::Status-->
                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
                                        </td>
                                        <!--end::Status-->
                                        <!--begin::Qty-->
                                        <td class="text-end" data-order="78">
                                            <span class="text-dark fw-bolder">78 PCS</span>
                                        </td>
                                        <!--end::Qty-->
                                    </tr>
                                    <tr>
                                        <!--begin::Item-->
                                        <td>
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">Dell 32 UltraSharp</a>
                                        </td>
                                        <!--end::Item-->
                                        <!--begin::Product ID-->
                                        <td class="text-end">#XGY-356</td>
                                        <!--end::Product ID-->
                                        <!--begin::Date added-->
                                        <td class="text-end">22 Dec, 2022</td>
                                        <!--end::Date added-->
                                        <!--begin::Price-->
                                        <td class="text-end">$1,060</td>
                                        <!--end::Price-->
                                        <!--begin::Status-->
                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-warning">Low Stock</span>
                                        </td>
                                        <!--end::Status-->
                                        <!--begin::Qty-->
                                        <td class="text-end" data-order="8">
                                            <span class="text-dark fw-bolder">8 PCS</span>
                                        </td>
                                        <!--end::Qty-->
                                    </tr>
                                    <tr>
                                        <!--begin::Item-->
                                        <td>
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">Google Pixel 6 Pro</a>
                                        </td>
                                        <!--end::Item-->
                                        <!--begin::Product ID-->
                                        <td class="text-end">#XVR-425</td>
                                        <!--end::Product ID-->
                                        <!--begin::Date added-->
                                        <td class="text-end">27 Dec, 2022</td>
                                        <!--end::Date added-->
                                        <!--begin::Price-->
                                        <td class="text-end">$1,060</td>
                                        <!--end::Price-->
                                        <!--begin::Status-->
                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
                                        </td>
                                        <!--end::Status-->
                                        <!--begin::Qty-->
                                        <td class="text-end" data-order="124">
                                            <span class="text-dark fw-bolder">124 PCS</span>
                                        </td>
                                        <!--end::Qty-->
                                    </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Table Widget 5-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>

@endsection
@section('scripts')

    {{--    <div id="chart"></div>--}}

{{--    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>--}}
{{--    <script>--}}
{{--        var options = {--}}
{{--            chart: {--}}
{{--                type: 'bar'--}}
{{--            },--}}
{{--            series: [{--}}
{{--                name: 'Mijozlar',--}}
{{--                data: [{{ $dailyCustomers }}, {{ $weeklyCustomers }}, {{ $monthlyCustomers }}, {{ $yearlyCustomers }}]--}}
{{--            }],--}}
{{--            xaxis: {--}}
{{--                categories: ['Kundalik', 'Haftalik', 'Oylik', 'Yillik']--}}
{{--            }--}}
{{--        }--}}

{{--        var chart = new ApexCharts(document.querySelector("#chart"), options);--}}
{{--        chart.render();--}}
{{--    </script>--}}


@endsection
