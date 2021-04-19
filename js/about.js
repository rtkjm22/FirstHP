"use strict";

{
    const item = document.querySelectorAll('.about_item');


    function scroll_display() {
        for (let i=0;i<item.length;i++) {
            const rect = item[i].getBoundingClientRect().top;
            const gap = item[i].clientHeight * .2;
            if (window.innerHeight > rect + gap) {
                item[i].classList.add('scroll_display');
            } 
        }
    }


    window.addEventListener('load', () => {
        scroll_display();
    });

    window.addEventListener('scroll', () => {
        scroll_display();
    });

}