$(document).ready(function() {
    $(".slider .owl-carousel").owlCarousel({
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
    });
    owl = $(".slider .owl-carousel");
    $(".slider .owl-carousel .owl-nav .owl-next").click(function() {
        owl.trigger("next.owl.carousel");
    });

    $(".slider .owl-carousel .owl-nav .owl-prev").click(function() {
        owl.trigger("prev.owl.carousel");
    });
    // PRODUCT NEW
    $(".product-new .owl-carousel").owlCarousel({
        margin: 10,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 4
            }
        }
    });
    owlProNew = $(".product-new .owl-carousel");
    $(".product-new .owl-carousel .owl-nav .owl-next").click(function() {
        owlProNew.trigger("next.owl.carousel");
    });

    $(".product-new .owl-carousel .owl-nav .owl-prev").click(function() {
        owlProNew.trigger("prev.owl.carousel");
    });

    // show - hide tab-product-new
    $(".prd-news .tab-nav li").click(function(event) {
        event.preventDefault();
        cateId = $(this).attr("data-cate");
        openPrdNew(cateId);
    });

    function openPrdNew(cateId) {
        tabProductNew = $(".product-new");
        // console.log(tabProductNew);
        $.each(tabProductNew, function() {
            $(this).removeClass("none");
            if (this.id != cateId) {
                $(this).addClass("none");
            }
        });
        tabLink = $(".prd-news .tab-link li");
        $.each(tabLink, function() {
            $(this).removeClass("active");
            if ($(this).attr("data-cate") == cateId) {
                $(this).addClass("active");
            }
        });
    }

    /// PRODUCT TOP HOT

    $(".pro-top-sell .owl-carousel").owlCarousel({
        margin: 10,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 4
            }
        }
    });
    owlTopHot = $(".pro-top-sell .owl-carousel");
    $(".pro-top-sell .owl-carousel .owl-nav .owl-next").click(function() {
        owlTopHot.trigger("next.owl.carousel");
    });

    $(".pro-top-sell .owl-carousel .owl-nav .owl-prev").click(function() {
        owlTopHot.trigger("prev.owl.carousel");
    });

    $(".top-sell .tab-nav li").click(function(event) {
        event.preventDefault();
        cateId = $(this).attr("data-cate");
        openPrdTopHot(cateId);
    });

    function openPrdTopHot(cateId) {
        tabPrdTopSell = $(".pro-top-sell");
        $.each(tabPrdTopSell, function() {
            $(this).removeClass("none");
            if (this.id != cateId) {
                $(this).addClass("none");
            }
        });
        tabLink = $(".top-sell .tab-link li");
        $.each(tabLink, function() {
            $(this).removeClass("active");
            if ($(this).attr("data-cate") == cateId) {
                $(this).addClass("active");
            }
        });
    }
    /// PRODUCT TOP RAting

    $(".pro-top-rating .owl-carousel").owlCarousel({
        margin: 10,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 4
            }
        }
    });
    owlTopSell = $(".pro-top-rating .owl-carousel");
    $(".pro-top-rating .owl-carousel .owl-nav .owl-next").click(function() {
        owlTopSell.trigger("next.owl.carousel");
    });

    $(".pro-top-rating .owl-carousel .owl-nav .owl-prev").click(function() {
        owlTopSell.trigger("prev.owl.carousel");
    });

    $(".top-rating .tab-nav li").click(function(event) {
        event.preventDefault();
        cateId = $(this).attr("data-cate");
        openPrdTopSell(cateId);
    });

    function openPrdTopSell(cateId) {
        tabPrdTopSell = $(".pro-top-rating");
        $.each(tabPrdTopSell, function() {
            $(this).removeClass("none");
            if (this.id != cateId) {
                $(this).addClass("none");
            }
        });
        tabLink = $(".top-rating .tab-link li");
        $.each(tabLink, function() {
            $(this).removeClass("active");
            if ($(this).attr("data-cate") == cateId) {
                $(this).addClass("active");
            }
        });
    }
});
