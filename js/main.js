"use strict";

{
    
    window.addEventListener('DOMContentLoaded', function () {

        //ページトップに戻る
        //ボタンの表示
        const to_top = document.querySelector('.send_to_top');

        // to_top.addEventListener('transitionrun', function () {
        //     if (to_top.className !== 'view') {
        //         to_top.style.visibility = 'hidden';
        //     }
        // });
        
        window.addEventListener('scroll', function () {
            if (200 < window.scrollY) {
                to_top.style.visibility = 'visible';
                to_top.style.cursor = 'pointer';
                to_top.classList.add('view');
                // console.log(window.scrollY);
            } else {
                to_top.classList.remove('view');
                to_top.style.cursor = 'default';
            }
        });

        //スクロールでトップへ移動
        to_top.addEventListener('click', function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });













    });
}
