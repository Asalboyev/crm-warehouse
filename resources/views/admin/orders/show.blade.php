@extends('layouts.admin')
@section('title')
    Order show
@endsection
@section('style')
<style>
    .photos {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .photo {
        max-width: 100px;
        height: auto;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
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
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">

            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <!--end::Col-->
                <!--begin::Col-->
                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                    <!--begin::Order details-->
                    <!--end::Order details-->
                    <!--begin::Customer details-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Buyurtma haqida</h2>
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
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z" fill="currentColor"></path>
                                                    <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                                Sana
                                            </div>
                                        </td>
                                        <td class="fw-bolder text-end">{{$order->id}}</td>
                                    </tr>
                                    <!--begin::Customer name-->
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor"></path>
                                                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                                Sotuvchi
                                            </div>
                                        </td>
                                        <td class="fw-bolder text-end">
                                            <div class="d-flex align-items-center justify-content-end">
                                                <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">

                                                </div>
                                                <a class="text-gray-600 text-hover-primary">{{$order->user->name}}</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor"></path>
                                                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                                Ombor xodimi
                                            </div>
                                        </td>
                                        <td class="fw-bolder text-end">
                                            <div class="d-flex align-items-center justify-content-end">
                                                <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">

                                                </div>
                                                <a class="text-gray-600 text-hover-primary">{{$order->user->namet ?? "--"}}</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor"></path>
                                                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                                Yuk tashish sanasi
                                            </div>
                                        </td>
                                        <td class="fw-bolder text-end">
                                            <div class="d-flex align-items-center justify-content-end">
                                                <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">

                                                </div>
                                                <a class="text-gray-600 text-hover-primary">{{$order->user->namee ?? "--"}}</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor"></path>
                                                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                                Summa
                                            </div>
                                        </td>
                                        <td class="fw-bolder text-end">
                                            <div class="d-flex align-items-center justify-content-end">
                                                <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">

                                                </div>
                                                <a class="text-gray-600 text-hover-primary">{{$order->total_price}}</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor"></path>
                                                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                                Massa
                                            </div>
                                        </td>
                                        <td class="fw-bolder text-end">
                                            <div class="d-flex align-items-center justify-content-end">
                                                <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">

                                                </div>
                                                <a class="text-gray-600 text-hover-primary">{{$order->total_weight}}</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--end::Customer name-->
                                    <!--begin::Customer email-->

                                    <!--end::Phone-->
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
                                <h2>Mijoz</h2>
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
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor"></path>
                                                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            Mijoz nomi
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">

                                            </div>
                                            <a class="text-gray-600 text-hover-primary">{{$order->client->name?? "--"}}</a>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor"></path>
                                                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            Telefon raqami
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">

                                            </div>
                                            <a class="text-gray-600 text-hover-primary">{{$order->client->phone?? "--"}}</a>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor"></path>
                                                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            Kompaniya
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">

                                            </div>
                                            <a class="text-gray-600 text-hover-primary">{{$order->client->company?? "--"}}</a>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor"></path>
                                                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            Avto raqami
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">

                                            </div>
                                            <a class="text-gray-600 text-hover-primary">{{$order->client->car_number?? "--"}}</a>
                                        </div>
                                    </td>
                                    </tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor"></path>
                                                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                         RAsim
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <div class="d-flex align-items-center justify-content-end">
                                        <div class="photos">
                                        @foreach ($photos as $photo)
                                            <img src="{{ asset('storage/' . $photo) }}" alt="Order Image" class="photo">
                                        @endforeach
                                    </div>
                                    </td>
                                    </tr>





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
                <div class="col-xl-14 mb-8 mb-xl-15">
                    <!--begin::Table Widget 4-->
                    <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Yuklash uchun mahsulotlar</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                    <!--begin::Table head-->
                                    <thead>
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-175px">Product</th>
                                        <th class="min-w-100px text-end">metr/uzunlik</th>
                                        <th class="min-w-70px text-end">Pochka</th>
                                        <th class="min-w-100px text-end">Dona</th>
                                        <th class="min-w-100px text-end">Kassa narxi</th>
                                        <th class="min-w-100px text-end">Narxi</th>
                                        <th class="min-w-100px text-end">Og’irligi/Summa</th>
                                        <th class="min-w-100px text-end">Status</th>
                                    </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-600">
                                    <!--begin::Product-->
                                    <!--end::Product-->
                                    <!--begin::Product-->
                                    @foreach($order->orderProducts as $orderProduct)

                                        <tr>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <a href="" class="text-gray-600 text-hover-primary">{{$orderProduct->product->product_name}}</a>
                                            </div>
                                        </td>
                                        <td class="fw-bolder text-end">{{$orderProduct->product->length}}/ {{$orderProduct->product->price_per_meter}}M</td>
                                        <td class="fw-bolder text-end">{{$orderProduct->product->total_packages}}</td>
                                        <td class="fw-bolder text-end">{{$orderProduct->product->total_units}}</td>
                                        <td class="fw-bolder text-end">{{$orderProduct->product->price_per_tonn ?? "--"}}</td>
                                        <td class="text-end">{{$orderProduct->total_price}}$</td>
                                        <td class="text-end">{{$orderProduct->product->price_per_ton }}$</td>
                                        <td class="text-end"> @foreach($order->statuses as $status)
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
                                    <!--end::Product-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Table Widget 4-->
                </div>
            </div>
        </div>
        <!--end::Container-->
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

