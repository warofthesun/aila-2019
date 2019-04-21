jQuery(function ($) {
    var Aila = function () {
        var self = this,
            animations;
            // count = 0,
            // direction = 1;

        this.breakpoints = {
            tablet: 1050,
        };

        this.IS_TOUCH = false;

        this.windowWidth = $(window).width();
        this.isMobile = this.windowWidth <= this.breakpoints.tablet;

        this.registerHandlers = function () {
            var events = new EventBinder([
                {event: 'touchstart', selector: window, handler: this.handlers.isTouch},
                {event: 'scroll', selector: window, handler: $.debounce(50, this.handlers.onPageScroll.bind(this))},
                {event: 'click', selector: '.main_menu .no_link > a', handler: this.handlers.preventDefault},
                {event: 'click', selector: '#main_menu_top, #main_menu_sticky', handler: this.handlers.stopPropagation},
                {event: 'click', selector: '.modal, .modal_overlay', handler: this.handlers.stopPropagation},
                {event: 'click', selector: 'body', handler: this.handlers.closeStickyMenu},
                {event: 'click', selector: '#main_menu_top .no_link > a', handler: this.handlers.toggleMobileSubmenu},
                {event: 'touchstart', selector: '#main_menu_top .no_link > a', handler: this.handlers.toggleMobileSubmenu},
                {event: 'vclick', selector: '#hotdogs_main, #hotdogs_sticky', handler: this.handlers.toggleMobileNav},
                {event: 'click', selector: '#top_nav_close, #top_nav_overlay', handler: this.handlers.toggleMobileNav},
                {event: 'wpcf7mailsent', selector: document, handler: this.handlers.displayThankYouModal.bind(this)},
                {event: 'change', selector: '.categories_selector select', handler: this.handlers.filterPostCategory},
                {event: 'click', selector: '.close_modal, .modal_overlay', handler: this.handlers.closeModal},
                {event: 'click', selector: '.resource__block', handler: this.handlers.openResourceModal.bind(this)},
                {event: 'click', selector: '.view_bio', handler: this.handlers.openLeaderBioModal.bind(this)},
                {event: 'click', selector: '.solutions__title__block', handler: this.handlers.toggleSolutionsBlocks},
                {event: 'click', selector: '#solutions__blocks__title_blocks .closer', handler: this.handlers.closeSolutionsBlocks},
                {event: 'click', selector: '.button, .download_button', handler: this.handlers.onButtonClick.bind(this)},
                {event: 'click', selector: '.scroll_button', handler: this.handlers.scrollToSection},
                {event: 'click', selector: '.case_studies_hero .down_arrow', handler: this.handlers.scrollToId},
                {event: 'click', selector: '.video_cover_image', handler: this.handlers.openVideoModal.bind(this)},
                {
                    event: 'focus',
                    selector: '.form_row input, .form_row textarea, .form_row select',
                    handler: this.handlers.focusFormLabel
                },
                {
                    event: 'click',
                    selector: '.form_row label, .form_row input, .form_row textarea, .form_row select',
                    handler: this.handlers.focusFormLabel
                },
                {
                    event: 'blur',
                    selector: '.form_row input, .form_row textarea, .form_row select',
                    handler: this.handlers.blurFormLabel
                },
            ]).bind();
        };

        this.handlers = {
            preventDefault: function (e) {
                e.preventDefault();
            },

            stopPropagation: function (e) {
                e.stopPropagation();
            },

            isTouch: function (e) {
                self.IS_TOUCH = true;
                $('#main_menu_top .no_link > a').addClass('touch');
                $('#company .company__leader').addClass('touch');
            },

            resizeReset: function (e) {
                self.windowWidth = $(window).width();
                self.isMobile = self.windowWidth <= self.breakpoints.tablet;

                if (!self.isMobile) {
                    $('#top_nav_drawer').show();
                }
            },

            onPageScroll: function (e) {
                var scrollPos = $(window).scrollTop();
                this.toggleStickyNav(scrollPos);
            },

            scrollToSection: function (e) {
                var button = $(this),
                    target = button.data('target'),
                    targetEl = $(target),
                    isMobile = $(window).width() <= 750,
                    offset;

                switch (target) {
                    case '#product_sections':
                        offset = isMobile ? 120 : 140;
                        break;
                    case '#home_intro':
                        offset = isMobile ? 0 : 140;
                        break;
                    default:
                        offset = 120;
                }

                if (targetEl.length) {
                    e.preventDefault();

                    $('html, body').animate({
                        scrollTop: targetEl.offset().top - offset
                    }, 500);
                }
            },

            scrollToId: function (e) {
                var isMobile = $(window).width() <= 750,
                    offset = 120,
                    targetEl = $('#case_studies__container');

                if (targetEl.length) {
                    e.preventDefault();

                    $('html, body').animate({
                        scrollTop: targetEl.offset().top - offset
                    }, 500);
                }
            },

            onButtonClick: function (e) {
                var button = $(e.target),
                    type = button.data('modal'),
                    file = button.data('file'),
                    fileName = button.data('file-name'),
                    overlay = button.next('.modal_overlay')
                    modal = overlay.length ? overlay.find('.modal').first() : null;

                if (typeof type === 'undefined' || !modal || !modal.length) return;

                e.preventDefault();

                if (type === 'download') {
                    if (!downloadCookieExists()) {
                        modal.data({
                            file: file,
                            fileName: fileName
                        });
                        modal.find('input[name="file-name"]').val(fileName);
                        this.openModal(modal);
                    } else {
                        this.downloadFile(modal, file, fileName);
                        this.sendDownloadMail(fileName);
                    }
                } else {
                    this.openModal(modal);
                }
            },

            // Nav //

            closeStickyMenu: function (e) {
                $('#main_menu_sticky').find('.sub-menu')
                    .fadeOut(250)
                    .removeClass('transform');
            },

            // Mobile Nav //

            toggleMobileNav: function (e) {
                var drawer = $('#top_nav_drawer');

                if (drawer.is('.open')) {
                    setTimeout(function () {
                        drawer.hide();
                    }, 400);
                } else {
                    drawer.show();
                }

                setTimeout(function () {
                    drawer.toggleClass('open');
                    $('#top_nav_overlay').fadeToggle(400);
                }, 10);
            },

            toggleMobileSubmenu: function (e) {
                var subMenu = $(this).next('.sub-menu'),
                    isOpening = !subMenu.is(':visible');

                if (self.IS_TOUCH && e.type === 'click' || !self.isMobile) return;

                $('#main_menu_top .no_link').removeClass('open');
                $('#main_menu_top .sub-menu').slideUp(250);

                if (isOpening) {
                    subMenu.closest('.no_link').addClass('open');
                    subMenu.slideDown(250);
                }
            },

            // Forms //

            focusFormLabel: function (e) {
                var row = $(this).closest('.form_row'),
                    input = row.find('input, textarea');

                if (row.is('.focused')) return;

                row.addClass('focused');
                input.focus();
            },

            blurFormLabel: function (e) {
                var input = $(this),
                    row = input.closest('.form_row');

                if (input.val().length === 0) {
                    row.removeClass('focused');
                }
            },

            // Modals //

            openVideoModal: function (e) {
                var coverImage = $(e.target).closest('.video_cover_image'),
                    modal = coverImage.next('.modal_overlay').find('.modal');

                this.openModal(modal);
            },

            displayThankYouModal: function (e) {
                var form = $(e.target),
                    modal = form.closest('.modal'),
                    file, fileName;

                if (!modal.length) {
                    this.openModal($('#modal__contact_thanks'));

                    dataLayer.push({event: 'contactFormSubmission'});

                } else if (modal.is('[data-type="contact"]')) {
                    this.openModal(modal.next('.thank_you'));

                    dataLayer.push({event: 'contactFormSubmission'});

                } else if (modal.is('[data-type="download"]')) {
                    file = modal.data('file');
                    fileName = modal.data('fileName');

                    this.downloadFile(modal, file, fileName);
                    this.openModal(modal.next('.thank_you'));

                    if (!downloadCookieExists()) createDownloadCookie(e.detail.inputs);

                    dataLayer.push({event: 'downloadFormSubmission'});
                }

                $('.form_row').removeClass('focused');
            },

            closeModal: function (e) {
                var stickyNav = $('#top_nav_sticky');

                if ($(this).is('#password_modal')) return;

                $('.modal_overlay').fadeOut(150);
                $('body').removeClass('modal_open');

                setTimeout(function () {
                    $('.modal')
                        .data('file', null)
                        .removeClass('open')
                        .hide();

                    stickyNav.css('z-index', 20000);
                }, 150);
            },

            openResourceModal: function (e) {
                var block = $(e.target).closest('.resource__block'),
                    id = block.data('block'),
                    resourceContents = $('.resource__modal_content'),
                    resourceContent = resourceContents.filter('[data-modal="' + id + '"]');

                if (typeof id === 'undefined') return;

                resourceContents.hide();
                resourceContent.show();

                this.openModal($('#resource__modal'));
            },

            openLeaderBioModal: function (e) {
                this.openModal($(e.target).closest('.company__leader').next('.modal_overlay').find('.modal'));
            },

            // Filters //

            filterPostCategory: function (e) {
                var category = $(this).val(),
                    type = $(this).closest('.categories_selector').data('type'),
                    url;

                switch (type) {
                    case 'categories':
                        url = category.length ? '/blog/categories/' : '/blog/';
                        break;
                    case 'tags':
                        url = category.length ? '/blog/tags/' : '/blog/';
                        break;
                    case 'products':
                        url = category.length ? '/tools/products/' : '/tools/';
                        break;
                }

                window.location.href = url + $(this).val();
            },

            filterPostTag: function (e) {
                var tag = $(this).val(),
                    url = tag.length ? '/blog/tags/' : '/blog/';
                window.location.href = url + $(this).val();
            },

            filterToolsProduct: function (e) {

            },

            // Solutions //

            toggleSolutionsBlocks: function (e) {
                var block = $(this),
                    blocks = $('.solutions__title__block'),
                    parent = $('#solutions__blocks'),
                    closer = $('#solutions__blocks__title_blocks .closer'),
                    type = block.data('block-type'),
                    isMobile = block.is('.mobile'),
                    isOpen = block.is('.opened'),
                    areOpen = blocks.is('.opened'),
                    containerSelector = '.solutions__blocks__container',
                    delay = 0,
                    fadeSpeed = 70,
                    slideSpeed = 280,
                    containers, container;

                if (isMobile) {
                    containerSelector += '.mobile';
                } else {
                    containerSelector += ':not(.mobile)';
                }

                containers = $(containerSelector);
                container = containers.filter('[data-type="' + type + '"]');

                if (areOpen && !isMobile) {
                    blocks.removeClass('opened');

                    if (isOpen) {
                        container.slideUp(slideSpeed);
                        closer.fadeOut(250);
                    } else {
                        containers.fadeOut(fadeSpeed);

                        setTimeout(function () {
                            container.fadeIn(fadeSpeed);
                        }, fadeSpeed);

                        block.addClass('opened');
                    }
                } else if (isOpen && isMobile) {
                    block.removeClass('opened');
                    container.slideUp(slideSpeed);
                    closer.fadeOut(250);
                } else {
                    block.addClass('opened');
                    container.slideDown(slideSpeed);
                    closer.fadeIn(250);

                    $('html, body').animate({
                        scrollTop: container.offset().top - (isMobile ? 60 : 100)
                    }, 500);
                }
            },

            closeSolutionsBlocks: function (e) {
                $('.solutions__title__block').removeClass('opened');
                $('.solutions__blocks__container').slideUp(400);
                $('#solutions__blocks__title_blocks .closer').fadeOut(250);

                $('html, body').animate({
                    scrollTop: $('#solutions__blocks').offset().top - 140
                }, 500);
            }
        };

        this.toggleStickyNav = function (scrollPos) {
            var hero = $('#hero'),
                heroHeight = hero.outerHeight(),
                stickyNav = $('#top_nav_sticky');

            if ($('body').is('.case-study-template-default')) heroHeight = 500;

            if (scrollPos >= heroHeight && !stickyNav.is(':visible')) {
                stickyNav.fadeIn(250);
            } else if (scrollPos < heroHeight && stickyNav.is(':visible')) {
                stickyNav.fadeOut(250);

                $(stickyNav).find('.sub-menu')
                    .hide()
                    .removeClass('transform');
            }
        };

        this.openModal = function (modal) {
            var overlay = modal.closest('.modal_overlay'),
                stickyNav = $('#top_nav_sticky');

            $('.modal').hide();
            $('body').addClass('modal_open');

            overlay.fadeIn(250);
            modal.fadeIn(200);
            stickyNav.css('z-index', 2);

            setTimeout(function () {
                modal.addClass('open');
            }, 50);
        };

        this.downloadFile = function (modal, file, fileName) {
            $('#file_download').attr('src', file);
            // this.openModal(modal.next('.thank_you'));

            dataLayer.push({
                event: 'fileDownload',
                downloadedFileName: fileName
            });
        };

        this.sendDownloadMail = function (fileName) {
            var cookies = getCookieData(),
                form = $('#file_download_form form');

            if (!cookies) return;

            cookies.forEach(function (cookie) {
                var input = form.find('[name="' + cookie.name + '"]');

                if (!input) return;

                if (cookie.name === 'file-name') input.val(fileName);
                else input.val(cookie.value);
            });

            form.submit();
        };

        this.cementHeights = function (elements) {
            elements.forEach(function (element) {
                var el = $(element),
                    height = el.outerHeight();

                el.css('height', String(height) + 'px');
            });
        };

        this.initMenu = function () {
            self.toggleStickyNav($(window).scrollTop());

            $('#main_menu_top > li, #main_menu_sticky > li').hover(
                function () {
                    openMenu(this);
                },
                function () {
                    closeMenu(this);
                }
            );

            $('#main_menu_top > li > a, #main_menu_sticky > li > a').on('click', function (e) {
                var menu = $(this).parent('li'),
                    subMenu = $(this).next('ul');

                if (!subMenu.is(':visible')) {
                    openMenu(menu, true);
                } else {
                    closeMenu(menu);
                }
            });

            function openMenu(menu, sticky) {
                var subMenu = $(menu).find('.sub-menu'),
                    width = subMenu.outerWidth();

                if (self.isMobile) {
                    subMenu.css('margin-left', '0px');
                    return;
                }

                if (sticky) closeAllMenus('#top_nav_sticky');

                if (!subMenu.is(':visible')) {
                    subMenu
                        .css('margin-left', String(-(width / 2)) + 'px')
                        .fadeIn(250)
                        .addClass('transform');
                }
            }

            function closeMenu(menu) {
                if (self.isMobile) return;
                closeAllMenus(menu);
            }

            function closeAllMenus(context) {
                if (!context) context = document;

                $(context).find('.sub-menu')
                    .fadeOut(250)
                    .removeClass('transform');
            }
        };

        this.setProductPointerWidths = function () {
            // position right facing pointers to the right of the caption heading //
            var pointers = $('.features_caption__pointer');

            pointers.each(function (i, pointer) {
                var bar = $(pointer).find('.bar'),
                    pointer = bar.closest('.features_caption__pointer'),
                    caption = pointer.next('.features_caption'),
                    heading = caption.find('h4'),
                    headingWidth = heading.outerWidth(),
                    pointerLeft = getPxValue(pointer, 'left'),
                    pointerWidth = getPxValue(pointer, 'width');

                if (bar.css('left') !== '0px' || !headingWidth) return;

                pointer.css({
                    left: (pointerLeft + headingWidth + 15) + 'px',
                    width: (pointerWidth - headingWidth - 15) + 'px'
                })
            });
        };

        this.initMobileProductSlider = function () {
            $('#product__features__mobile_slider').slick({
                dots: true,
                arrows: false,
                // prevArrow: '<i class="prev_arrow"></i>',
                // nextArrow: '<i class="next_arrow"></i>'
            });
        };

        this.initCounters = function () {
            window.counters.forEach(function (counter) {
                var numAnim = new CountUp(
                        counter.id,
                        parseInt(counter.startingNumber, 10),
                        parseInt(counter.endingNumber, 10)
                    ),
                    shouldStart = true;

                checkCount();
                $(document).on('scroll', checkCount);

                function checkCount() {
                    if ($('#' + counter.id).visible(true) && !numAnim.error && shouldStart) {
                        numAnim.start();
                        shouldStart = false;
                    }
                }
            });
        };

        this.initVideos = function () {
            var hero = $('#hero.home'),
                intro = $('video#intro'),
                loop = $('video#loop'),
                pauseAt;

            if (hero.is('.is_mobile')) return;

            intro.get(0).play();

            intro.on('loadedmetadata', function (e) {
                pauseAt = this.duration - 0.2;
            });

            intro.on('playing', function (e) {
                var video = this,
                    interval;

                interval = setInterval(function () {
                    if (video.currentTime > pauseAt) {
                        video.pause();
                        loop.get(0).play();
                        intro.hide();
                        clearInterval(interval);
                    }
                }, 10);

                self.displayHeroContent();
            });

            setTimeout(function () {
                hero.addClass('loop');
                loop.show();
            }, 1000);
        };

        this.displayHeroContent = function (isMobile) {
            var hero = $('#hero.home'),
                logo = $('#top_nav_aila_logo'),
                heroContent = hero.find('#hero_content'),
                heroButton = heroContent.find('.button_container'),
                arrow = hero.find('.down_arrow'),
                logoDuration = 100,
                contentDuration = 100,
                buttonDuration = 100;
                // logoDuration = isMobile ? 900 : 2200,
                // contentDuration = isMobile ? 600 : 2000,
                // buttonDuration = isMobile ? 1500 : 3000;

            display(logo, logoDuration);
            display(heroContent, contentDuration);
            display(heroButton, buttonDuration);
            display(arrow, buttonDuration);

            function display(el, duration) {
                setTimeout(function () {
                    el.addClass('display');
                }, duration);
            }
        }

        this.detectIE = function () {
            var agent = window.navigator.userAgent,
                msie = agent.indexOf('MSIE '), // ie <= 10
                trident = agent.indexOf('Trident/'), // ie 11
                edge = agent.indexOf('Edge/'); //edge

            return (
                msie !== -1 ||
                trident !== -1 ||
                edge !== -1
            );
        }

        this.init = function () {
            $(window).resize($.debounce(100, this.handlers.resizeReset));

            if (this.detectIE()) $('body').addClass('ie');

            if ($('body').is('.mobile')) {
                this.displayHeroContent(true);
                $('#hero').addClass('loop');
            }

            // if ($('video#intro').length) this.initVideos();
            this.displayHeroContent();

            this.registerHandlers();
            this.initMenu();
            this.cementHeights([
                '#hero'
            ]);

            if (window.hasFeaturedProducts) {
                this.setProductPointerWidths();
                this.initMobileProductSlider();
            }
            if (window.counters && window.counters.length) this.initCounters();

            animations = new window.Animations().init();

            $('.form_row.full.title').hide();
        }
    }

    var EventBinder = function (eventsArray) {
        this.eventsArray = eventsArray;

        this.bindEvents = function (eventsArray) {
            for (var i in eventsArray) {
                $(document).on(eventsArray[i].event, eventsArray[i].selector, eventsArray[i].handler);
            }
        };

        this.bind = function () {
            this.bindEvents(this.eventsArray);
        };
    };

    new Aila().init();
});
