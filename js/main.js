"use strict";

{
    
    window.addEventListener('DOMContentLoaded', function () {

            const header_nav_item_link = document.querySelectorAll('.header_nav_item_link');
            const scroll_top = document.querySelector('.scroll_top');

            //スクロール検知
            window.addEventListener('scroll', function () {
                scroll_200(scroll_top);
                for (let i = 0; i < header_nav_item_link.length; i++) {
                    scroll_200(header_nav_item_link[i]);
                }
            });

            //200pxスクロールされたときの表示
            function scroll_200(el) {
                if (400 < window.scrollY) {
                    el.classList.add('view');
                } else {
                    el.classList.remove('view');
                }
            }
    
            //scroll_topボタンでトップへ移動
            scroll_top.addEventListener('click', function () {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            });


        {
            //product
            const test = localStorage.setItem('key', 'test');
            const remove = localStorage.removeItem('key');
            const item = localStorage.getItem('key');
        }

    });
}



