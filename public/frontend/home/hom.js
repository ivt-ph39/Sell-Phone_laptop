// $(document).ready(function () {
$('.slider .owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})
owl = $('.owl-carousel')
$('.slider .owl-carousel .owl-nav .owl-next').click(function () {
    owl.trigger('next.owl.carousel');
})

$('.slider .owl-carousel .owl-nav .owl-prev').click(function () {
    owl.trigger('prev.owl.carousel');
})
// })
