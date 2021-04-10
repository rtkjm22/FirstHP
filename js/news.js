"use strict";

{
    const news_contents = [
        {
            img: 'https://placehold.jp/8dc4c7/ffffff/150x150.png?text=1',
            date: '2020-10-10',
            title: '美味しいパンケーキ1', 
            caption: '美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。'
        },
        {
            img: 'https://placehold.jp/d68dca/ffffff/150x150.png?text=2',
            date: '2020-10-11',
            title: '美味しいパンケーキ2', 
            caption: '美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。'
        },
        {
            img: 'https://placehold.jp/b9d9be/ffffff/150x150.png?text=3',
            date: '2020-10-12',
            title: '美味しいパンケーキ3', 
            caption: '美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。'
        },
        {
            img: 'https://placehold.jp/a69eff/ffffff/150x150.png?text=4',
            date: '2020-10-13',
            title: '美味しいパンケーキ4', 
            caption: '美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。'
        },
        {
            img: 'https://placehold.jp/f0adad/ffffff/150x150.png?text=5',
            date: '2020-10-14',
            title: '美味しいパンケーキ5', 
            caption: '美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。'
        },
        {
            img: 'https://placehold.jp/f6faa3/ffffff/150x150.png?text=6',
            date: '2020-10-15',
            title: '美味しいパンケーキ6', 
            caption: '美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。美味しいパンケーキを作りました。食べてみてね。'
        },
    ];

    const news_items = document.querySelector('.news_items');

    const template = document.getElementById('news_template');
    
    for (let i=news_contents.length-1;i>=0;i--) {
        const clone = template.content.cloneNode(true);

        const news_img = clone.querySelector('.news_img_img');
        const news_date = clone.querySelector('.news_date');
        const news_title = clone.querySelector('.news_title');
        const news_caption = clone.querySelector('.news_caption');
    
        news_img.src = news_contents[i].img;
        news_date.textContent = news_contents[i].date;
        news_title.textContent = news_contents[i].title;
        news_caption.textContent = news_contents[i].caption;
    
        news_items.appendChild(clone);
    }
}