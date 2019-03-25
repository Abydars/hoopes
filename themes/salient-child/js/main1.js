jQuery(document).ready(function($) {
    $('.accordion-list').each(function(index, el) {
        var $listItems = $(this).find('.accordion-list-item'),
            $toggles = $listItems.find('h5');
        $toggles.on('click', function() {
            var parent = $(this).parent('.accordion-list-item');
            if (parent.hasClass('open')) {
                parent.removeClass('open');
            } else {
                parent.addClass('open');
            }
            return false;
        });
    });
    $('.main-nav-toggle').on('click', function() {
        $('body').toggleClass('main-nav-open');
        $('.main-nav-toggle').toggleClass('icon-menu icon-close');
    });
    $('.main-nav-open #menu-main-nav > li').live('click', function() {
        $(this).find('.sub-menu').slideToggle();
        $(this).toggleClass('open');
    });
    $('.main-nav-open #menu-top-main-menu-1 > li').live('click', function() {
        $(this).find('.sub-menu').slideToggle();
        $(this).toggleClass('open');
    });
    var searchForms = $('.searchform');
    if (searchForms) {
        var SearchForm = function(elem) {
            this.element = elem;
            this.trigger = $('.icon-search-find');
            this.input = $(this.element).find('.search-box');
            this.initialValue = $(this.input).attr('data-placeholder');
            this.submitBtn = $(this.element).find("i[type='submit']");
            this.toggleSearch = function(e) {
                if (e.preventDefault) {
                    e.preventDefault();
                }
                $(this.element).css('display', 'inline-block');
                this.input.focus();
                $('body').click(function(e) {
                    if ($(e.target).attr('id') !== 'searchforminput' && $(e.target).attr('id') !== 'searchform') {
                        this.element.css('display', 'none');
                        $('body').unbind();
                    }
                }.bind(this));
                return false;
            };
            if (this.submitBtn) {
                var ihjq = this.element;
                this.submitBtn.click(function(e) {
                    ihjq.submit();
                });
            }
            this.clearInput = function(e) {
                var target = $(e.currentTarget);
                if (target.val() === this.initialValue) {
                    target.val('');
                }
            };
            this.resetInput = function(e) {
                var target = $(e.currentTarget);
                if (target.val() === '') {
                    target.val(this.initialValue);
                }
            };
            this.input.on('keydown', this.clearInput.bind(this));
            this.input.on('input', this.resetInput.bind(this));
            this.trigger.click(this.toggleSearch.bind(this));
        };
        for (var i = 0; i < searchForms.length; ++i) {
            new SearchForm(searchForms[i]);
        }
    }
    $('.inline-video').on('click', function() {
        var videoUrl = $(this).data('video-url'),
            autoplay;
        if (videoUrl.indexOf('?') === -1) {
            autoplay = '?autoplay=1';
        } else {
            autoplay = '&autoplay=1'
        }
        if (videoUrl) {
            $(this).append('<iframe class="inline-video-iframe" src="' + videoUrl + autoplay + '"" frameborder="0" allowfullscreen></iframe>');
        }
    });
    $('.term-condition').on('click', function() {
        $(".term-condition-div").show();
        $(".overlay").show();
    });
    $('.close-box').on('click', function() {
        $(".term-condition-div").hide();
        $(".overlay").hide();
    });
    $('.item-list-search').on('keyup', function() {
        var $itemList = $(this).closest('.item-list'),
            $filterableItems = $itemList.find('.filterable-item'),
            inputValue = $(this).val();
        if (inputValue.length > 0) {
            $filterableItems.each(function(index, item) {
                var filterableText = ($(item).text()).toLowerCase();
                if (filterableText.indexOf(inputValue.toLowerCase()) > 0) {
                    $(item).removeClass('hide');
                } else {
                    $(item).addClass('hide');
                }
            });
        } else {
            $filterableItems.removeClass('hide');
        }
    });
    $('.page-sub-nav').on('click', function() {
        $(this).find('.options').slideToggle();
    });
    $(document).ready(function() {
        $('.other-option').bind('change', function(e) {
            if ($('.other-option').val() == 'other') {
                $('.other-conditional').show();
            } else {
                $('.other-conditional').hide();
            }
        });
    });
    var doctorSearch = $('#doctorSearch');
    if (doctorSearch.length > 0) {
        doctorSearch.on('click', function() {
            var searchData = {
                address: $('#address').val(),
                radius: $('#radius').val()
            };
            $.ajax({
                url: 'search_doctors',
                type: 'POST',
                data: searchData,
                success: function(doctorList) {
                    console.log(doctorList);
                }
            });
        });
    }
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });
    $('.scrollup').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 500);
        return false;
    });
});

function redirectAfterSubmit() {
    window.location.href = homeUrl + '/thank-you/';
}
