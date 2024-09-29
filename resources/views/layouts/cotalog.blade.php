@foreach($otherProducts as $otherProduct)
<div class="products-item">
    <div class="products-item__wrap">
        <div class="products-item__img">
            @if (!empty($otherProduct['images']) && count($otherProduct['images']) > 0)
            @php($firstImage = $otherProduct['images'][0])
            <img alt="product" src="{{ asset('site/images/products/' . $firstImage) }}">
            @endif
        </div>
        <div class="products-item__buttons">
            <button class="products-item__zoom">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.5819 12.0019C15.5819 13.9819 13.9819 15.5819 12.0019 15.5819C10.0219 15.5819 8.42188 13.9819 8.42188 12.0019C8.42188 10.0219 10.0219 8.42188 12.0019 8.42188C13.9819 8.42188 15.5819 10.0219 15.5819 12.0019Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12.0037 20.2688C15.5337 20.2688 18.8238 18.1887 21.1138 14.5887C22.0138 13.1787 22.0138 10.8087 21.1138 9.39875C18.8238 5.79875 15.5337 3.71875 12.0037 3.71875C8.47375 3.71875 5.18375 5.79875 2.89375 9.39875C1.99375 10.8087 1.99375 13.1787 2.89375 14.5887C5.18375 18.1887 8.47375 20.2688 12.0037 20.2688Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <button class="products-item__basket">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.39612 6.5H15.5961C18.9961 6.5 19.3361 8.09 19.5661 10.03L20.4661 17.53C20.7561 19.99 19.9961 22 16.4961 22H7.50612C3.99612 22 3.23612 19.99 3.53612 17.53L4.43612 10.03C4.65612 8.09 4.99612 6.5 8.39612 6.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8 8V4.5C8 3 9 2 10.5 2H13.5C15 2 16 3 16 4.5V8M20.41 17.03H8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <button class="products-item__like">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.62 20.8116C12.28 20.9316 11.72 20.9316 11.38 20.8116C8.48 19.8216 2 15.6916 2 8.69156C2 5.60156 4.49 3.10156 7.56 3.10156C9.38 3.10156 10.99 3.98156 12 5.34156C12.5138 4.64744 13.183 4.08329 13.954 3.69431C14.725 3.30532 15.5764 3.10232 16.44 3.10156C19.51 3.10156 22 5.60156 22 8.69156C22 15.6916 15.52 19.8216 12.62 20.8116Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>
    <div class="products-item__name">
        {{ $otherProduct['name_'.\App::getLocale()]  }}
    </div>
    <div class="products-item__mark">
        @for($i=0; $i<$otherProduct->numberofstars; $i++)
            <img src="/img/icons/star.svg" alt="ico">
            @endfor
    </div>
    <a href="{{ route('productDetail',$otherProduct->name_uz) }}" class="products-item__link"></a>
</div>

@endforeach