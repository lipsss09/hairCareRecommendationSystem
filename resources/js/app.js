import './bootstrap';

import $ from 'jquery';
import anime from 'animejs';
window.$ = window.jQuery = $;

// IMPORT SELECT2 DENGAN BENAR
import select2 from 'select2';
select2();

// CSS
import 'select2/dist/css/select2.min.css';

$(function () {
    $('#categories').select2({
        placeholder: 'Pilih Kategori',
        allowClear: true,
        width: '20%',
    });
    $('#categories').on('change', function () {
        currentCategory = $(this).val();
        loadProducts();
    });
});
let currentCategory = '';
let currentSort = '';
let currentFilter = '';
function loadProducts() {
    let params = new URLSearchParams();

    if (currentCategory) {
        params.append('category_id', currentCategory);
    }

    if (currentSort) {
        params.append('sort', currentSort);
    }
    if (currentFilter) {
        params.append('filter', currentFilter);
    }

    fetch(`/get-products?${params.toString()}`)
        .then(response => response.json())
        .then(data => {

            let grid = document.getElementById('product-grid');
            grid.innerHTML = '';

            data.forEach(product => {

                let card = `
                    <div class="card card-shadow rounded-xl p-4 bg-pink-50">
                        <div class="animate-item product-card">
                            <div class="relative overflow-hidden rounded-xl mb-3">
                                <img src="${product.image_url}"
                                     alt="${product.name}"
                                     class="w-full h-min object-cover">
                            </div>

                            <h3 class="font-semibold text-gray-800 mb-1">
                                ${product.name}
                            </h3>

                            <p class="text-sm text-gray-500 mb-1">
                                ${product.category ? product.category.name : ''}
                            </p>

                            <a href="${product.source}" class="text-pink-500 text-sm mb-2 block">Lihat Detail Produk</a>

                            <div class="flex items-center justify-between mt-2">
                                <p class="text-lg font-bold text-gray-800">
                                    Rp ${Number(product.price).toLocaleString('id-ID')}
                                </p>
                                <button
                                    onclick="addToCart('${product.product_id}', this)"
                                    class="bg-pink-500 hover:bg-pink-600 text-white p-2 rounded-lg transition-colors">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                grid.innerHTML += card;
                if (data.length === 0) {
                    grid.innerHTML = '<p class="col-span-4 text-center">Produk tidak ditemukan</p>';
                }
            });
            initScrollAnimation();



        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function initScrollAnimation() {
    const items = document.querySelectorAll('.animate-item');

    const observer = new IntersectionObserver((entries) => {

        const visibleItems = entries
            .filter(entry => entry.isIntersecting)
            .map(entry => entry.target);

        if (visibleItems.length > 0) {

            anime({
                targets: visibleItems,
                opacity: [0, 1],
                translateY: [60, 0],
                translateX: [60, 0],
                rotate: [-8, 0],
                scale: [0.95, 1],
                duration: 900,
                delay: anime.stagger(200),
                easing: 'easeOutExpo'
            });

            visibleItems.forEach(item => observer.unobserve(item));
        }

    }, { threshold: 0.3 });

    items.forEach(item => {
        item.style.opacity = 0;
        observer.observe(item);
    });
}
document.addEventListener("DOMContentLoaded", function () {
    let ascending = document.getElementById("priceAsc");
    let descending = document.getElementById("priceDesc");
    let filterAll = document.getElementById("showAllProducts");

    if (filterAll) {
        filterAll.addEventListener("click", function () {
            currentFilter = 'all';
            loadProducts();
        });
    }

    if (ascending) {
        ascending.addEventListener("click", function () {
            currentSort = 'asc';
            loadProducts();
        });
    }

    if (descending) {
        descending.addEventListener("click", function () {
            currentSort = 'desc';
            loadProducts();
        });
    }

    initScrollAnimation();
});
