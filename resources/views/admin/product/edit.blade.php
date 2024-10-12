@extends('layouts.admin')
@section('title')
    Product Edit
@endsection
@section('style')
@endsection
@section('content')

    @include('admin.success-file')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <form id="product-form" action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data"
                  class="form d-flex flex-column flex-lg-row">
                @csrf
                @method("PUT")
                <!--begin::Aside column-->

                <!--end::Aside column-->
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
                        <!--begin:::Tab item-->


                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin::Tab content-->
                    <div class="tab-content">

                        <div class="card card-flush py-4">
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Umumiy malumotlar</h2>
                                    </div>
                                </div>

                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div id="kt_ecommerce_add_category_conditions">
                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <div data-repeater-list="kt_ecommerce_add_category_conditions"
                                                 class="d-flex flex-column gap-3">
                                                <div data-repeater-item="" class="form-group d-flex flex-wrap gap-5">
                                                    <div class="w-100 w-md-200px">
                                                        <!--begin::Label-->
                                                        <label class="form-label">Mahsulot nomi</label>
                                                        <input id="kt_ecommerce_add_category_meta_keywords"
                                                               name="product_name" value="{{$product->product_name}}"
                                                               class="form-control mb-2" placeholder="maxsulot nomi:">
                                                    </div>
                                                    <div class="w-100 w-md-200px">
                                                        <!--begin::Select2-->
                                                        <label class="form-label">Category</label>

                                                        <select  class="form-select mb-2" data-control="select2"
                                                                 name="category_id" required
                                                                 id="kt_ecommerce_add_category_status_select">
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="w-100 w-md-200px">
                                                        <!--begin::Select2-->
                                                        <label class="form-label">Davlati:</label>

                                                        <select  class="form-select mb-2"
                                                                 name="country" required
                                                                 id="kt_ecommerce_add_category_status_select">
                                                            <option value="O'zbekiston" {{ $product->country === 'O\'zbekiston' ? 'selected' : '' }}>O'zbekiston</option>
                                                            <option value="Rossiya" {{ $product->country === 'Rossiya' ? 'selected' : '' }}>Rossiya</option>

                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="separator separator-dashed my-5"></div>
                                    </div>
                                    <div class="card-title">
                                        <h2>Parametrlar</h2>
                                    </div>
                                    <div class="mt-10" data-kt-ecommerce-catalog-add-category="auto-options">
                                        <div id="kt_ecommerce_add_category_conditions">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="kt_ecommerce_add_category_conditions"
                                                     class="d-flex flex-column gap-3">
                                                    <div data-repeater-item="" class="form-group d-flex flex-wrap gap-5">
                                                        <div class="w-100 w-md-200px">
                                                            <!--begin::Label-->
                                                            <label class="form-label">Qalinligi (Стенка)</label>
                                                            <input id="kt_ecommerce_add_category_meta_keywords"
                                                                   name="thickness" value="{{$product->thickness}}"
                                                                   class="form-control mb-2" placeholder="qalinligi">
                                                        </div>
                                                        <div class="w-100 w-md-200px">
                                                            <!--begin::Label-->
                                                            <label class="form-label">Uzunligi</label>
                                                            <input id="kt_ecommerce_add_category_meta_keywords"
                                                                   name="length" value="{{$product->length}}"
                                                                   class="form-control mb-2" placeholder="uzunligi">
                                                        </div>
                                                        <div class="w-100 w-md-200px">
                                                            <label class="form-label">Rangi:</label>
                                                            <select  class="form-select mb-2"
                                                                     name="metal_type" required
                                                                     id="kt_ecommerce_add_category_status_select">
                                                                <option value="Qora" {{ $product->metal_type === 'Qora' ? 'selected' : '' }}>Qora</option>
                                                                <option value="Oq" {{ $product->metal_type === 'Oq' ? 'selected' : '' }}>Oq</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="separator separator-dashed my-5"></div>
                                    </div>
                                    <div class="card-title">
                                        <h2>Narxi</h2>
                                    </div>
                                    <div class="mt-10" data-kt-ecommerce-catalog-add-category="auto-options">
                                        <div id="kt_ecommerce_add_category_conditions">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="kt_ecommerce_add_category_conditions"
                                                     class="d-flex flex-column gap-3">
                                                    <div data-repeater-item="" class="form-group d-flex flex-wrap gap-5">
                                                        <div class="w-100 w-md-200px">
                                                            <!--begin::Label-->
                                                            <label class="form-label">1 tonna narxi</label>
                                                            <input id="kt_ecommerce_add_category_meta_keywords"
                                                                   name="price_per_ton" value="{{$product->price_per_ton}}"
                                                                   class="form-control mb-2" placeholder="1 tonna narxi">
                                                        </div>
                                                        <div class="w-100 w-md-200px">
                                                            <!--begin::Label-->
                                                            <label class="form-label">1 tonna uzunligi:</label>
                                                            <input id="kt_ecommerce_add_category_meta_keywords"
                                                                   name="length_per_ton" value="{{$product->length_per_ton}}"
                                                                   class="form-control mb-2" placeholder="1 tonna uzunligi:">
                                                        </div>
                                                        <div class="w-100 w-md-200px">
                                                            <!--begin::Label-->
                                                            <label class="form-label">1 Metr uchun narx:</label>
                                                            <input id="kt_ecommerce_add_category_meta_keywords"
                                                                   name="price_per_meter" value="{{$product->price_per_meter}}"
                                                                   class="form-control mb-2" placeholder="1 metr uchun narx:">
                                                        </div>
                                                        <div class="w-100 w-md-200px">
                                                            <!--begin::Label-->
                                                            <label class="form-label">1 Dona uchun narx:</label>
                                                            <input id="kt_ecommerce_add_category_meta_keywords"
                                                                   name="price_per_item" value="{{$product->price_per_item}}"
                                                                   class="form-control mb-2" placeholder="1 dona uchun narx:">
                                                        </div>
                                                        <div class="w-100 w-md-200px">
                                                            <!--begin::Label-->
                                                            <label class="form-label">1 Pochka narxi:</label>
                                                            <input id="kt_ecommerce_add_category_meta_keywords"
                                                                   name="price_per_package" value="{{$product->price_per_package}}"
                                                                   class="form-control mb-2" placeholder="1 pochka narxi:">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="separator separator-dashed my-5"></div>
                                    </div>
                                    <div class="card-title">
                                        <h2>Qiymatlari</h2>
                                    </div>
                                    <div class="mt-10" data-kt-ecommerce-catalog-add-category="auto-options">
                                        <div id="kt_ecommerce_add_category_conditions">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="kt_ecommerce_add_category_conditions"
                                                     class="d-flex flex-column gap-3">
                                                    <div data-repeater-item="" class="form-group d-flex flex-wrap gap-5">
                                                        <div class="w-100 w-md-200px">
                                                            <!--begin::Label-->
                                                            <label class="form-label">1 pochkadagi soni:</label>
                                                            <input id="kt_ecommerce_add_category_meta_keywords"
                                                                   name="items_per_package" value="{{$product->items_per_package  }}"
                                                                   class="form-control mb-2" placeholder="1 pochkadagi soni:">
                                                        </div>
                                                        <div class="w-100 w-md-200px">
                                                            <!--begin::Label-->
                                                            <label class="form-label">1 pochkaning og’irligi</label>
                                                            <input id="kt_ecommerce_add_category_meta_keywords"
                                                                   name="package_weight" value="{{$product->package_weight}}"
                                                                   class="form-control mb-2" placeholder="1 pochkaning og’irligi">
                                                        </div>
                                                        <div class="w-100 w-md-200px">
                                                            <!--begin::Label-->
                                                            <label class="form-label">1 pochka uzunligi:</label>
                                                            <input id="kt_ecommerce_add_category_meta_keywords"
                                                                   name="package_length" value="{{$product->package_length}}"
                                                                   class="form-control mb-2" placeholder="1 pochka uzunligi:">
                                                        </div>
                                                        <div class="w-100 w-md-200px">
                                                            <!--begin::Label-->
                                                            <label class="form-label">1 metr og‘riligi:</label>
                                                            <input id="kt_ecommerce_add_category_meta_keywords"
                                                                   name="weight_per_meter" value="{{$product->weight_per_meter}}"
                                                                   class="form-control mb-2" placeholder="1 metr og‘riligi:">
                                                        </div>
                                                        <div class="w-100 w-md-200px">
                                                            <!--begin::Label-->
                                                            <label class="form-label">1 Dona og‘riligi:</label>
                                                            <input id="kt_ecommerce_add_category_meta_keywords"
                                                                   name="weight_per_item" value="{{$product->weight_per_item}}"
                                                                   class="form-control mb-2" placeholder="1 dona og‘riligi:">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">Save Changes</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>

                        </div>
                    </div>

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
                                <div class="d-flex align-items-center gap-2 gap-lg-3">
                                    <button type="submit" class="btn btn-sm btn-primary">Add</button>
                                    <!--end::Primary button-->
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Container-->
                        </div>

                    </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
