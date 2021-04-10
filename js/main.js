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
                if (200 < window.scrollY) {
                    el.style.visibility = 'visible';
                    el.style.pointerEvents = 'auto';
                    el.style.cursor = 'pointer';
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


{
    const images = [
        'https://placehold.jp/8dc4c7/ffffff/150x150.png?text=1',
        'https://placehold.jp/d68dca/ffffff/150x150.png?text=2',
        'https://placehold.jp/b9d9be/ffffff/150x150.png?text=3',
        'https://placehold.jp/a69eff/ffffff/150x150.png?text=4',
        'https://placehold.jp/f0adad/ffffff/150x150.png?text=5',
    ];


    const product_items = document.querySelector('.product_items');

    function product_item(image, name) {
        const item = document.createElement("div");
        item.classList.add('product_item');

        const thumbnail = document.createElement("div");
        thumbnail.classList.add('product_thumbnail');
        const thumbnail_a = document.createElement("a");
        thumbnail_a.href = '#';
        const thumbnail_a_img = document.createElement("img");
        
        thumbnail_a_img.src = image;
        thumbnail_a.appendChild(thumbnail_a_img);
        thumbnail.appendChild(thumbnail_a);

        const namae = document.createElement("div");
        const namae_p = document.createElement("p");
        namae_p.classList.add('product_name');
        const namae_p_content = document.createTextNode(name);
        namae_p.appendChild(namae_p_content);
        namae.appendChild(namae_p);


        item.appendChild(thumbnail);
        item.appendChild(namae);
        product_items.appendChild(item);
    }

    let flag = 0;

    for (let i=0;i<25;i++) {
        if (flag === 5) {
            flag = 0;
        }
        new product_item(images[flag], "美味しいパンケーキ");
        flag++;
    }
}
