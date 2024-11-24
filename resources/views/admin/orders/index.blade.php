@extends('layouts.admin')
@section('title')
    Products
@endsection
@section('style')
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
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">

            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-14 mb-8 mb-xl-15">
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
                                        <select
                                            class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bolder py-0 ps-3 w-auto"
                                            data-control="select2" data-hide-search="true"
                                            data-dropdown-css-class="w-150px"
                                            data-placeholder="Select an option">
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
                                        <select
                                            class="form-select form-select-transparent text-dark fs-7 lh-1 fw-bolder py-0 ps-3 w-auto"
                                            data-control="select2" data-hide-search="true"
                                            data-dropdown-css-class="w-150px"
                                            data-placeholder="Select an option" data-kt-table-widget-4="filter_status">
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
                                        <span
                                            class="svg-icon svg-icon-2 position-absolute top-50 translate-middle-y ms-4">
																<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none">
																	<rect opacity="0.5" x="17.0365" y="15.1223"
                                                                          width="8.15546" height="2" rx="1"
                                                                          transform="rotate(45 17.0365 15.1223)"
                                                                          fill="currentColor"/>
																	<path
                                                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                        fill="currentColor"/>
																</svg>
															</span>
                                        <!--end::Svg Icon-->
                                        <input type="text" data-kt-table-widget-4="search"
                                               class="form-control w-150px fs-7 ps-12"
                                               placeholder="Search"/>
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
                                                <img src="" data-kt-src-path="assets/media/stock/ecommerce/" alt=""
                                                     data-kt-table-widget-4="template_image"/>
                                            </a>
                                            <div class="d-flex flex-column text-muted">
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bolder"
                                                   data-kt-table-widget-4="template_name">Product name</a>
                                                <div class="fs-7" data-kt-table-widget-4="template_description">Product
                                                    description
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="text-gray-800 fs-7">Cost</div>
                                        <div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_cost">
                                            1
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="text-gray-800 fs-7">Qty</div>
                                        <div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_qty">1
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="text-gray-800 fs-7">Total</div>
                                        <div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_total">
                                            name
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="text-gray-800 fs-7 me-3">On hand</div>
                                        <div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_stock">
                                            32
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html"
                                           class="text-gray-800 text-hover-primary">#XGY-346</a>
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
                                        <button type="button"
                                                class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                                data-kt-table-widget-4="expand_row">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                            <span class="svg-icon svg-icon-3 m-0 toggle-off">
																		<svg xmlns="http://www.w3.org/2000/svg"
                                                                             width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none">
																			<rect opacity="0.5" x="11" y="18" width="12"
                                                                                  height="2" rx="1"
                                                                                  transform="rotate(-90 11 18)"
                                                                                  fill="currentColor"/>
																			<rect x="6" y="11" width="12" height="2"
                                                                                  rx="1" fill="currentColor"/>
																		</svg>
																	</span>
                                            <!--end::Svg Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                            <span class="svg-icon svg-icon-3 m-0 toggle-on">
																		<svg xmlns="http://www.w3.org/2000/svg"
                                                                             width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none">
																			<rect x="6" y="11" width="12" height="2"
                                                                                  rx="1" fill="currentColor"/>
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
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        $(document).ready(function () {
            // Search inputda yozish vaqtida qidirish funksiyasi
            $('#search-input').on('keyup', function () {
                var searchQuery = $(this).val();

                // Agar qidiruv maydoni bo'sh bo'lsa, natijalarni tozalash
                if (searchQuery.length === 0) {
                    $('#search-results').html('');
                    return;
                }

                // AJAX orqali qidiruv so'rovi yuboriladi
                $.ajax({
                    url: '{{ route('categories.index') }}', // Backend qidiruv marshruti
                    type: 'GET',
                    data: {
                        search: searchQuery
                    },
                    success: function (response) {
                        // Qidiruv natijalari diviga natijalarni kiritish
                        $('#search-results').html(response);
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

@endsection

