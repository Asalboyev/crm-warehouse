@extends('layouts.admin')
@section('title')
    Buyurtmalar
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
                                <span class="card-label fw-bolder text-gray-800">Buyurtmalar</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Actions-->
                            <div class="card-toolbar">
                                <!--begin::Filters-->
                                <div class="d-flex flex-stack flex-wrap gap-4">

                                    <div class="d-flex align-items-center fw-bolder mb-3">
                                        <div class="text-gray-400 fs-7 me-2">Status</div>
                                        <select id="statusFilter" class="form-select form-select-transparent text-dark fs-7 lh-1 fw-bolder py-0 ps-3 w-auto">
                                            <option value="all" selected>Barchasi</option>
                                            <option value="Ariza holatida">Ariza holatida</option>
                                            <option value="Yangi">Yangi</option>
                                            <option value="Avto keldi">Avto keldi</option>
                                            <option value="Avto kirdi">Avto kirdi</option>
                                            <option value="Yakunlandi">Yakunlandi</option>
                                            <option value="Qarz">Qarz</option>
                                            <option value="Bekor qilindi">Bekor qilindi</option>
                                        </select>
                                    </div>
                                    <!--end::Status-->
                                    <!--begin::Search-->
                                    <div class="position-relative my-1">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <form method="GET" action="{{ route('order.index') }}">

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
                                               name="search"
                                               id="search-input" value="{{ request('search') }}"
                                               class="form-control w-150px fs-7 ps-12"
                                               placeholder="Search"/>
                                    </div>
                                    </form>

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
                            <table class="table align-middle table-row-dashed fs-6 gy-3" id="ordersTable">
                                <thead>
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px">#</th>
                                    <th class="min-w-100px">Buyurtma vaqti</th>
                                    <th class="text-end min-w-100px">Mijoz</th>
                                    <th class="text-end min-w-125px">Tel raqami</th>
                                    <th class="text-end min-w-100px">Sotuvchi</th>
                                    <th class="text-end min-w-100px">Summa</th>
                                    <th class="text-end min-w-50px">Og’irligi-Tonna</th>
                                    <th class="text-end min-w-50px">Avto nomer</th>
                                    <th class="text-end min-w-50px">Status</th>
                                </tr>
                                </thead>
                                <tbody class="fw-bolder text-gray-600">
                                @foreach($orders as $order)
                                    <tr data-status="{{ $order->statuses->pluck('name')->join(',') }}">
                                        <td>#{{ $loop->iteration }}</td>
                                        <td> <a class="text-end" href="{{route('order.show', $order->id)}}">{{ $order->created_at }}</a></td>
                                        <td class="text-end">{{ $order->client->name }}</td>
                                        <td class="text-end">{{ $order->client->phone }}</td>
                                        <td class="text-end">{{ $order->user->name }}</td>
                                        <td class="text-end">$ {{ $order->total_price }}</td>
                                        <td class="text-end">{{ $order->total_weight }}</td>
                                        <td class="text-end">{{ $order->car_number ?? '--' }}</td>
                                        <td class="text-end">
                                            @foreach($order->statuses as $status)
                                                @php
                                                    // Ranglar xaritasini aniqlash
                                                    $statusColors = [
                                                        'Ariza holatida' => 'badge-light-primary', // Ko'k rang
                                                        'Yangi' => 'badge-light-info', // Kamalak rang
                                                        'Avto keldi' => 'badge-light-success', // Suv rang
                                                        'Avto kirdi' => 'badge-light-warning', // Zangori rang
                                                        'Yakunlandi' => 'badge-light-green', // Yashil rang
                                                        'Qarz' => 'badge-light-danger', // Qizil rang
                                                        'Bekor qilindi' => 'badge-light-dark', // Qora rang
                                                    ];

                                                    // Statusga mos rangni topish
                                                    $badgeClass = $statusColors[$status->name] ?? 'badge-light-secondary'; // Agar mos rang topilmasa, kulrang
                                                @endphp
                                                <span class="badge py-3 px-4 fs-7 {{ $badgeClass }}">
                                                {{ $status->name }}
                                            </span>
                                            @endforeach
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>                            <!--end::Table-->
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
        document.getElementById('statusFilter').addEventListener('change', function () {
            const selectedStatus = this.value.toLowerCase();
            const rows = document.querySelectorAll('#ordersTable tbody tr');

            rows.forEach(row => {
                const rowStatuses = row.getAttribute('data-status').toLowerCase();

                if (selectedStatus === 'all' || rowStatuses.includes(selectedStatus)) {
                    row.style.display = ''; // Ko'rsatish
                } else {
                    row.style.display = 'none'; // Yashirish
                }
            });
        });

    </script>

@endsection

