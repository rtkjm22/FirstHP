"use strict";

{
    // const images = [
    //     'https://placehold.jp/8dc4c7/ffffff/150x150.png?text=1',
    //     'https://placehold.jp/d68dca/ffffff/150x150.png?text=2',
    //     'https://placehold.jp/b9d9be/ffffff/150x150.png?text=3',
    //     'https://placehold.jp/a69eff/ffffff/150x150.png?text=4',
    //     'https://placehold.jp/f0adad/ffffff/150x150.png?text=5',
    // ];


    // const product_items = document.querySelector('.product_items');

    // function product_item(image, name) {
    //     const item = document.createElement("div");
    //     item.classList.add('product_item');

    //     const thumbnail = document.createElement("div");
    //     thumbnail.classList.add('product_thumbnail');
    //     const thumbnail_a = document.createElement("a");
    //     thumbnail_a.href = '#';
    //     const thumbnail_a_img = document.createElement("img");
        
    //     thumbnail_a_img.src = image;
    //     thumbnail_a.appendChild(thumbnail_a_img);
    //     thumbnail.appendChild(thumbnail_a);

    //     const namae = document.createElement("div");
    //     const namae_p = document.createElement("p");
    //     namae_p.classList.add('product_name');
    //     const namae_p_content = document.createTextNode(name);
    //     namae_p.appendChild(namae_p_content);
    //     namae.appendChild(namae_p);


    //     item.appendChild(thumbnail);
    //     item.appendChild(namae);
    //     product_items.appendChild(item);
    // }

    // let flag = 0;

    // for (let i=0;i<25;i++) {
    //     if (flag === 5) {
    //         flag = 0;
    //     }
    //     new product_item(images[flag], "美味しいパンケーキ");
    //     flag++;
    // }
}

{
    const items = document.querySelector('.product_items');
    const item = document.querySelectorAll('.product_item');
    const length = item.length % 5;
    
    
    const append_empty_box = (index) => {
        for (let i=0;i<index;i++) {
            const empty_box = document.createElement('div');
            empty_box.className = 'empty_box';
            items.appendChild(empty_box);
        }
    }

    switch (length) {
        case length === 1:
            append_empty_box(4);
            break;
        case length === 2:
            append_empty_box(3);
            break;
        case length === 3:
            append_empty_box(2);
            break;
        case length === 4:
            append_empty_box(1);
            break;
        default:
            break;
    }


}