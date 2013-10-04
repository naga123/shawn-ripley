jQuery(document).ready(function($) {
    var galleryAnimSpeed = 1000;
	if(length == 0){length = 2;}
    var galleryContainer = $('#featured .gallery');
    if (galleryContainer.length) {
        galleryItems = galleryContainer.children().remove();
        galleryContainerTrack = $('<div class="track"/>').appendTo(galleryContainer).append(galleryItems.clone(true)).append(galleryItems).append(galleryItems.clone(true));
        var galleryContainerTrackWidth = 0;
        galleryContainerTrack.children().each(function () {
            galleryContainerTrackWidth += $(this).outerWidth(true);
        });
        galleryContainerTrack.width(galleryContainerTrackWidth);
        var galleryPagingContainer = galleryContainer.parent().find('.pages');
        galleryItems.each(function () {
            galleryPagingContainer.append($('<a href="#" class="page" />').click(function (ev) {
                ev.preventDefault();
                galleryJumpToItem($(galleryItems[galleryPagingContainer.children().index(this)]), galleryAnimSpeed);
            }));
        });
        var galleryAnimInterval = null;
        var gallerySetAutoAnimInterval = function () {
            window.clearInterval(galleryAnimInterval);
            galleryAnimInterval = window.setInterval(function () {
                $('#featured .pagination a.right').trigger('click');
            }, 7000);
			$("div.active div.main-holder").fadeIn(3000).delay(400);
        }
        gallerySetAutoAnimInterval();
        var galleryJumpToItem = function (item, speed) {
            var positionLeft = item.offset().left;
            var galleryContainerCenter = parseInt(galleryContainerTrack.css('left'), 10) + galleryContainer.offset().left + galleryContainer.width() / 2;
            galleryContainerTrack.children().removeClass('active');
            galleryContainerTrack.animate({
                left: galleryContainerCenter - positionLeft - item.addClass('active').width() / 2 + 'px'
            }, speed);
            galleryPagingContainer.children().removeClass('selected');
            $(galleryPagingContainer.children().get(galleryItems.index(item))).addClass('selected');
            gallerySetAutoAnimInterval();
		$("div.active div.main-holder").fadeIn(3000).delay(400);
        };
        galleryJumpToItem($(galleryItems[0]), 0);

        $('#featured .pagination a.left').click(function (ev) {
            ev.preventDefault();
            $("div.track  div.main-holder").fadeOut();
            var currItemIndex = galleryPagingContainer.children().index(galleryPagingContainer.find('.selected'));
            var selectItem = currItemIndex == 0 ? galleryItems.length - 1 : currItemIndex - 1;
            galleryJumpToItem($(galleryItems[selectItem]), galleryAnimSpeed);
            $("div.active div.main-holder").fadeIn(3000).delay(400);
        });
        $('#featured .pagination a.right').click(function (ev) {
            ev.preventDefault();
            $("div.track  div.main-holder").fadeOut();
            var currItemIndex = galleryPagingContainer.children().index(galleryPagingContainer.find('.selected'));
            var selectItem = galleryItems.length - 1 == currItemIndex ? 0 : currItemIndex + 1;
            galleryJumpToItem($(galleryItems[selectItem]), galleryAnimSpeed);
            $("div.active div.main-holder").fadeIn(3000).delay(400);
        });
        $(window).bind('resize', function () {
            galleryJumpToItem($(galleryItems[0]), 0);
			$("div.active div.main-holder").fadeIn(3000).delay(400);
        });
    }

})(jQuery);