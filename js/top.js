"use strict";



//main_content_scroll_up

{ 
    const content = document.querySelectorAll('.top_main_content');

    const scroll_up = (el) => {
        for (let i=0;i<el.length;i++) {
            const rect = el[i].getBoundingClientRect().top;
            const gap = el[i].clientHeight * .2;
            if (window.innerHeight > rect + gap) {
                el[i].classList.add('scroll_up');
            }
        }
    }

    window.addEventListener('load', () => {
        scroll_up(content);
    });

    window.addEventListener('scroll', () => {
        scroll_up(content);
    });
}



//background_img_slideShow

{
    const images = [
        'https://placehold.jp/8dc4c7/ffffff/150x150.png?text=1',
        'https://placehold.jp/d68dca/ffffff/150x150.png?text=2',
        'https://placehold.jp/b9d9be/ffffff/150x150.png?text=3',
        'https://placehold.jp/a69eff/ffffff/150x150.png?text=4',
        'https://placehold.jp/f0adad/ffffff/150x150.png?text=5',
        'https://placehold.jp/8dc4c7/ffffff/150x150.png?text=6',
        'https://placehold.jp/d68dca/ffffff/150x150.png?text=7',
        'https://placehold.jp/b9d9be/ffffff/150x150.png?text=8',
        'https://placehold.jp/a69eff/ffffff/150x150.png?text=9',
        'https://placehold.jp/f0adad/ffffff/150x150.png?text=10',
    ];

    let current = 0;

    let before = current - 1;
    let after = current + 1;

    if (before < 0) {
        before = images.length -1;
    }
    if (after > 9) {
        after = 0
    }

    

}
