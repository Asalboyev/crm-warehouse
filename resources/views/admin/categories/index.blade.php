@extends('layouts.admin')
@section('title')
    Categories
@endsection
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('content')

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
                        <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Categories List</h1>
                        <!--end::Title-->
                        <!--begin::Separator-->
                        <span class="h-20px border-gray-300 border-start mx-4"></span>
                        <!--end::Separator-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="{{route('dashboard')}}" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-300 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Categories Management</li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-300 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Categories</li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-300 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-dark">Categories List</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Toolbar-->
            <!--begin::Post-->
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <!--begin::Container-->
                <div id="kt_content_container" class="container-xxl">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card header-->
                        <div class="card-header border-0 pt-6">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <form class="d-flex align-items-center position-relative my-1" id="search-form"
                                      action="{{ route('categories.index') }}" method="GET">

                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                          transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                                    <!--end::Svg Icon-->
                                    <input data-kt-user-table-filter="search"
                                           class="form-control form-control-solid w-250px ps-14" type="text" name="search"
                                           id="search-input" value="{{ request('search') }}" placeholder="Search users">
                                </form>
                                <!--end::Search-->
                            </div>
                            <!--begin::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                                    <!--end::Export-->
                                    <!--begin::Add user-->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_add_user">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                        <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                              transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor">
                                        </rect>
                                    </svg>
                                </span>
                                        <!--end::Svg Icon-->Add Category</button>
                                    <!--end::Add user-->
                                </div>

                                <!--end::Modal - New Card-->
                                <!--begin::Modal - Add task-->
                                <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                                    <!--begin::Modal dialog-->
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <!--begin::Modal content-->
                                        <div class="modal-content">
                                            <!--begin::Modal header-->
                                            <div class="modal-header" id="kt_modal_add_user_header">
                                                <!--begin::Modal title-->
                                                <h2 class="fw-bolder">Add Category</h2>
                                                <!--end::Modal title-->
                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                     data-kt-users-modal-action="close">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                    <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                                          transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                          transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                </svg>
                                            </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Close-->
                                            </div>
                                            <!--end::Modal header-->
                                            <!--begin::Modal body-->
                                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                                <!--begin::Form-->
                                                <form id="kt_modal_add_user_form"
                                                      class="form fv-plugins-bootstrap5 fv-plugins-framework"
                                                      action="{{route('categories.store')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <!--begin::Scroll-->
                                                    <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                                         id="kt_modal_add_user_scroll" data-kt-scroll="true"
                                                         data-kt-scroll-activate="{default: false, lg: true}"
                                                         data-kt-scroll-max-height="auto"
                                                         data-kt-scroll-dependencies="#kt_modal_add_user_header"
                                                         data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
                                                         data-kt-scroll-offset="300px" style="max-height: 276px;">
                                                        <!--begin::Input group-->
                                                        <div class="fv-row mb-7">
                                                            <!--begin::Label-->
                                                            <label class="d-block fw-bold fs-6 mb-5">Photo</label>
                                                            <!--end::Label-->
                                                            <!--begin::Image input-->
                                                            <div class="card-body  pt-0">
                                                                <div class="image-input image-input-empty image-input-outline mb-3"
                                                                     data-kt-image-input="true"
                                                                     style="background-image: url(assets/media/svg/files/blank-image.svg)">
                                                                    <div id="my-dropzone" class="dropzone">
                                                                        <div class="fallback">
                                                                            <input name="file" type="file" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!--end::Image input-->
                                                            <!--begin::Hint-->
                                                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                                            <!--end::Hint-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <!--begin::Label-->
                                                            <label class="required fw-bold fs-6 mb-2">Full Name</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="text" name="name"
                                                                   class="form-control form-control-solid mb-3 mb-lg-0"
                                                                   placeholder="Full name">
                                                            <!--end::Input-->
                                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                                        </div>
                                                    </div>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>

                                                    <div class="text-center pt-15">
                                                        <button type="reset" class="btn btn-light me-3"
                                                                data-kt-users-modal-action="cancel">Discard</button>
                                                        <button type="submit" class="btn btn-primary"
                                                                data-kt-users-modal-action="submit">
                                                            <span class="indicator-label">Submit</span>
                                                            </span>
                                                        </button>
                                                    </div>
                                                    <!--end::Actions-->
                                                    <div>
                                                        <input type="hidden" name="photo" id="image_name">

                                                </form>
                                            </div>
                                            <!--end::Modal body-->
                                        </div>
                                        <!--end::Modal content-->
                                    </div>
                                    <!--end::Modal dialog-->
                                </div>
                                <!--end::Modal - Add task-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body py-4">
                            <!--begin::Table-->
                            <div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                           id="kt_table_users">
                                        <!--begin::Table head-->
                                        <thead>
                                        <!--begin::Table row-->
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label="



													" style="width: 29.25px;">
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    #
                                                </div>
                                            </th>
                                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"
                                                rowspan="1" colspan="1" aria-label="User: activate to sort column ascending"
                                                style="width: 288.641px;">photo</th>
                                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"
                                                rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending"
                                                style="width: 160.516px;">Name</th>
                                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"
                                                rowspan="1" colspan="1"
                                                aria-label="Last login: activate to sort column ascending"
                                                style="width: 160.516px;">Joined Date </th>


                                            <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1"
                                                aria-label="Actions" style="width: 129px;">Actions</th>
                                        </tr>
                                        <!--end::Table row-->
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-600 fw-bold">

                                        @foreach($categories as $category)
                                            <tr class="odd">
                                                <!--begin::Checkbox-->
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        {{$loop->iteration}}
                                                        {{-- <input class="form-check-input" type="checkbox" value="1">--}}
                                                    </div>
                                                </td>
                                                <!--end::Checkbox-->
                                                <!--begin::User=-->
                                                <td class="d-flex align-items-center">
                                                    <!--begin:: Avatar -->
                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                        <a href="#">
                                                            <div class="symbol-label">
                                                                <img src="{{ asset(($category->photo ?? 'default.png')) }}"
                                                                     alt="" class="w-100">
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::User details-->

                                                    <!--begin::User details-->
                                                </td>
                                                <td data-order="2022-07-25T18:05:00+05:00">{{$category->name}}</td>


                                                <td data-order="2022-07-25T18:05:00+05:00">{{$category->created_at}}</td>
                                                <td class="text-end">
                                                    <form class="" action="{{ route('category.destroy', $category->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('categories.edit', $category->id) }}"
                                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3"
                                                                  d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                                  fill="currentColor"></path>
                                                            <path
                                                                d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                        <button type="submit"
                                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                                onclick="return confirm('Do you want to delete?')">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                                fill="currentColor" />
                                                            <path opacity="0.5"
                                                                  d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                                  fill="currentColor" />
                                                            <path opacity="0.5"
                                                                  d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                                  fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                        </button>
                                                    </form>
                                                </td> <!--end::Action=-->
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                </div>
                                <div class="row">
                                    <div
                                        class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                        <div class="dataTables_paginate paging_simple_numbers" id="kt_table_users_paginate">
                                            <ul class="pagination">{{$categories->links()}}</ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
    @endsection
    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
        <script>
            Dropzone.autoDiscover = false;
            $(document).ready(function () {
                var csrfToken = $('meta[name="csrf-token"]').attr('content'); var myDropzone = new Dropzone("#my-dropzone", {
                    url: "{{ route('categories.ajax') }}", // Upload yo'lini kiritish
                    paramName: "file", // serverga fayl nomi
                    maxFilesize: 5, // maksimal fayl hajmi (MB)
                    acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp", // qo'llaniladigan fayl turlari
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    maxFiles: 1, // faqat bitta rasm yuklash imkoniyati
                    addRemoveLinks: true, // x tugmasi qo'shish
                    init: function () {
                        this.on("success", function (file, response) {
                            if (response.success) {
                                // Dropzone orqali yuklangan rasm yo'lini formaga qo'shamiz
                                $('#image_name').val(response.success);
                            } else {
                                console.log(response);
                            }
                        });
                        console.log(response);
                        this.on("error", function (file, response) {
                            if (typeof response === 'object') {
                                alert(JSON.stringify(response));
                            } else {
                                alert(response);
                            }
                        });

                        this.on("removedfile", function (file) {
                            // Rasm o'chirilganda yashirin inputni tozalaymiz
                            $('#image_name').val('');
                        });

                        // Eski rasmni ko'rsatish uchun
                        var existingPhotoUrl = $('#image_name').val();
                        if (existingPhotoUrl) {
                            var mockFile = {
                                name: existingPhotoUrl,
                                size: 12345
                            };
                            this.emit("addedfile", mockFile);
                            this.emit("thumbnail", mockFile, '{{ asset('storage') }}/' + existingPhotoUrl);
                            this.emit("complete", mockFile);
                        }
                    }
                });
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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