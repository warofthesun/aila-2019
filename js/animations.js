jQuery(function ($) {
    window.Animations = function () {

        this.animateHeroLines = function () {
            var trigger = 'body';

            // Top Right Lines //
            drawOut($('#hero_1'), {
                triggerElement: trigger,
                triggerHook: 0,
                offset: 30,
                duration: 1000,
                tweenChanges: true
            });

            drawOut($('#hero_7'), {
                triggerElement: trigger,
                triggerHook: 0,
                duration: 270,
                tweenChanges: true
            });


            drawOut($('#hero_2'), {
                triggerElement: trigger,
                triggerHook: 0,
                offset: 320,
                duration: 320,
                tweenChanges: true
            });

            // Bottom Left Bend //
            drawOut($('#hero_3'), {
                triggerElement: trigger,
                triggerHook: 0,
                offset: 240,
                duration: 80,
                tweenChanges: true
            });

            drawOut($('#hero_4'), {
                triggerElement: trigger,
                triggerHook: 0,
                offset: 80,
                duration: 160,
                tweenChanges: true
            });

            drawOut($('#hero_5'), {
                triggerElement: trigger,
                triggerHook: 0,
                duration: 80,
                tweenChanges: true
            });

            // Bottom Left Line //
            drawOut($('#hero_6'), {
                triggerElement: trigger,
                triggerHook: 0,
                offset: 110,
                duration: 460,
                tweenChanges: true
            });

            // drawOnLoad([
            //     [line_2, 0.3, 0],
            //     [line_3, 0.2, 300],
            //     [line_4, 0.3, 500],
            //     [line_5, 0.2, 800],
            //     [line_6, 0.4, 1000],
            //     [line_1, 0.7, 600],
            //     [line_7, 0.9, 1400]
            // ]);
        };

        this.animateHomeLines = function () {
            var trigger_1 = '#home_intro__wrapper',
                trigger_2 = '#home_products__wrapper',
                trigger_3 = '#home__industries';

            // Intro Section Lines //
            drawIn($('#home_1'), {
                triggerElement: trigger_1,
                triggerHook: 0.05,
                duration: 200,
                tweenChanges: true
            });

            drawIn($('#home_2'), {
                triggerElement: trigger_1,
                triggerHook: 0.05,
                offset: 200,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#home_3'), {
                triggerElement: trigger_1,
                triggerHook: 0.05,
                offset: 300,
                duration: 200,
                tweenChanges: true
            });

            drawIn($('#home_4'), {
                triggerElement: trigger_1,
                triggerHook: 0.05,
                offset: 200,
                duration: 250,
                tweenChanges: true
            });

            // Product Section Lines //
            drawIn($('#home_5'), {
                triggerElement: trigger_2,
                triggerHook: 0.85,
                duration: 200,
                tweenChanges: true
            });

            drawIn($('#home_6'), {
                triggerElement: trigger_2,
                triggerHook: 0.85,
                offset: 200,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#home_7'), {
                triggerElement: trigger_2,
                triggerHook: 0.85,
                offset: 300,
                duration: 200,
                tweenChanges: true
            });

            drawIn($('#home_8'), {
                triggerElement: trigger_2,
                triggerHook: 0.85,
                offset: 300,
                duration: 300,
                tweenChanges: true
            });

            // Industries Section Lines //
            drawIn($('#home_9'), {
                triggerElement: trigger_3,
                triggerHook: 0.9,
                duration: 300,
                tweenChanges: true
            });

            drawIn($('#home_12'), {
                triggerElement: trigger_3,
                triggerHook: 0.9,
                duration: 200,
                offset: 100,
                tweenChanges: true
            });

            drawIn($('#home_11'), {
                triggerElement: trigger_3,
                triggerHook: 0.9,
                duration: 100,
                offset: 300,
                tweenChanges: true
            });

            drawIn($('#home_10'), {
                triggerElement: trigger_3,
                triggerHook: 0.9,
                duration: 200,
                offset: 400,
                tweenChanges: true
            });
        };

        this.animateProductSections = function () {
            var section_1 = '#product__imager',
                section_2 = '#product__kisok',
                section_3 = '#product__truescan',
                contentTween_1, contentTween_2, contentTween_3,
                imageTween_1, imageTween_2, imageTween_3;

            // Content //

            contentTween_1 = TweenMax.from('#product__imager .product_section__content', 1, {
                autoAlpha: 0,
                paddingTop: 25,
            });

            contentTween_2 = TweenMax.from('#product__kisok .product_section__content', 1, {
                autoAlpha: 0,
                paddingTop: 25,
            });

            contentTween_3 = TweenMax.from('#product__truescan .product_section__content', 1, {
                autoAlpha: 0,
                paddingTop: 25,
            });

            createScene({
                triggerElement: section_1,
                triggerHook: 0.8,
                duration: 170,
            }, contentTween_1, null, null, false);

            createScene({
                triggerElement: section_2,
                triggerHook: 0.65,
                duration: 170,
            }, contentTween_2, null, null, false);

            createScene({
                triggerElement: section_3,
                triggerHook: 0.6,
                duration: 170,
            }, contentTween_3, null, null, false);

            // Images //

            imageTween_1 = TweenMax.from('#product__imager img', 1, {
                autoAlpha: 0,
                paddingTop: 25,
                // paddingRight: 20
            });

            imageTween_2 = TweenMax.from('#product__kisok img', 1, {
                autoAlpha: 0,
                paddingTop: 25,
                // paddingLeft: 20
            });

            imageTween_3 = TweenMax.from('#product__truescan img', 1, {
                autoAlpha: 0,
                paddingTop: 25,
                // paddingRight: 20
            });

            createScene({
                triggerElement: section_1,
                triggerHook: 0.425,
                duration: 200,
            }, imageTween_1, null, null, false);

            createScene({
                triggerElement: section_2,
                triggerHook: 0.45,
                duration: 200,
            }, imageTween_2, null, null, false);

            createScene({
                triggerElement: section_3,
                triggerHook: 0.4,
                duration: 200,
            }, imageTween_3, null, null, false);


            // Section 1 //
            drawIn($('#products_1'), {
                triggerElement: section_1,
                triggerHook: 0.9,
                duration: 200,
                tweenChanges: true
            });

            drawIn($('#products_2'), {
                triggerElement: section_1,
                triggerHook: 0.9,
                offset: 200,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#products_3'), {
                triggerElement: section_1,
                triggerHook: 0.9,
                offset: 300,
                duration: 270,
                tweenChanges: true
            });

            drawIn($('#products_4'), {
                triggerElement: section_1,
                triggerHook: 1,
                offset: 150,
                duration: 300,
                tweenChanges: true
            });

            drawIn($('#products_5'), {
                triggerElement: section_1,
                triggerHook: 0.1,
                duration: 300,
                tweenChanges: true
            });

            drawIn($('#products_6'), {
                triggerElement: section_1,
                triggerHook: 0.1,
                offset: 150,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#products_7'), {
                triggerElement: section_1,
                triggerHook: 0.1,
                offset: 250,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#products_8'), {
                triggerElement: section_1,
                triggerHook: 0.1,
                offset: 400,
                duration: 200,
                tweenChanges: true
            });

            drawIn($('#products_9'), {
                triggerElement: section_1,
                triggerHook: 0.1,
                offset: 600,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#products_10'), {
                triggerElement: section_1,
                triggerHook: 0.1,
                offset: 700,
                duration: 300,
                tweenChanges: true
            });

            // Section 2 //
            drawIn($('#products_11'), {
                triggerElement: section_2,
                triggerHook: 0.3,
                duration: 600,
                tweenChanges: true
            });

            drawIn($('#products_12'), {
                triggerElement: section_2,
                triggerHook: 0.54,
                offset: 380,
                duration: 400,
                tweenChanges: true
            });

            drawIn($('#products_13'), {
                triggerElement: section_2,
                triggerHook: 0.54,
                offset: 780,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#products_14'), {
                triggerElement: section_2,
                triggerHook: 0.54,
                offset: 880,
                duration: 200,
                tweenChanges: true
            });

            // Section 3 //
            drawIn($('#products_15'), {
                triggerElement: section_3,
                triggerHook: 0.75,
                duration: 200,
                tweenChanges: true
            });

            drawIn($('#products_16'), {
                triggerElement: section_3,
                triggerHook: 0.65,
                // offset: 150,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#products_17'), {
                triggerElement: section_3,
                triggerHook: 0.65,
                offset: 150,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#products_18'), {
                triggerElement: section_3,
                triggerHook: 0.65,
                offset: 250,
                duration: 150,
                tweenChanges: true
            });
        };

        this.animateQuoteLines = function () {
            var trigger = '.quote_section';

            // Top Center Line //
            drawIn($('#quote_1'), {
                triggerElement: trigger,
                triggerHook: 0.92,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#quote_2'), {
                triggerElement: trigger,
                triggerHook: 0.92,
                offset: 150,
                duration: 150,
                tweenChanges: true
            });

            // Bottom Center Line //
            drawIn($('#quote_3'), {
                triggerElement: trigger,
                triggerHook: 0.92,
                offset: 600,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#quote_4'), {
                triggerElement: trigger,
                triggerHook: 0.92,
                offset: 750,
                duration: 150,
                tweenChanges: true
            });
        };

        this.animateContactFormLines = function () {
            var trigger = '#contact_form';

            drawIn($('#contact_1'), {
                triggerElement: trigger,
                triggerHook: 0.75,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#contact_2'), {
                triggerElement: trigger,
                triggerHook: 0.75,
                offset: 150,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#contact_3'), {
                triggerElement: trigger,
                triggerHook: 0.75,
                offset: 250,
                duration: 180,
                tweenChanges: true
            });

            drawIn($('#contact_4'), {
                triggerElement: trigger,
                triggerHook: 0.15,
                offset: 200,
                duration: 180,
                tweenChanges: true
            });

            drawIn($('#contact_5'), {
                triggerElement: trigger,
                triggerHook: 0.1,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#contact_6'), {
                triggerElement: trigger,
                triggerHook: 0.1,
                offset: 150,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#contact_7'), {
                triggerElement: trigger,
                triggerHook: 0.1,
                offset: 250,
                duration: 150,
                tweenChanges: true
            });
        };

        this.animateFullCtaLines = function () {
            var trigger = '.cta_banner';

            // Top Center Line //
            drawIn($('#cta_1'), {
                triggerElement: trigger,
                triggerHook: 0.92,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#cta_2'), {
                triggerElement: trigger,
                triggerHook: 0.92,
                offset: 150,
                duration: 150,
                tweenChanges: true
            });

            // Bottom Left Bend //
            drawIn($('#cta_3'), {
                triggerElement: trigger,
                triggerHook: 0.6,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#cta_4'), {
                triggerElement: trigger,
                triggerHook: 0.6,
                offset: 150,
                duration: 80,
                tweenChanges: true
            });

            drawIn($('#cta_5'), {
                triggerElement: trigger,
                triggerHook: 0.6,
                offset: 230,
                duration: 150,
                tweenChanges: true
            });

            // Bottom Left Line //
            drawIn($('#cta_6'), {
                triggerElement: trigger,
                triggerHook: 0.5,
                duration: 200,
                tweenChanges: true
            });

            // Bottom right Bend //
            drawIn($('#cta_9'), {
                triggerElement: trigger,
                triggerHook: 0.4,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#cta_8'), {
                triggerElement: trigger,
                triggerHook: 0.4,
                offset: 150,
                duration: 80,
                tweenChanges: true
            });

            drawIn($('#cta_7'), {
                triggerElement: trigger,
                triggerHook: 0.4,
                offset: 230,
                duration: 150,
                tweenChanges: true
            });

            // Bottom Right Line //
            drawIn($('#cta_10'), {
                triggerElement: trigger,
                triggerHook: 0.55,
                duration: 150,
                tweenChanges: true
            });
        };

        this.animateCaseStudiesLines = function () {
            var trigger = '.installations__container';

            drawIn($('#studies_1'), {
                triggerElement: trigger,
                triggerHook: 0.15,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#studies_2'), {
                triggerElement: trigger,
                triggerHook: 0.1,
                duration: 120,
                tweenChanges: true
            });

            drawIn($('#studies_3'), {
                triggerElement: trigger,
                triggerHook: 0.1,
                offset: 120,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#studies_4'), {
                triggerElement: trigger,
                triggerHook: 0.1,
                offset: 220,
                duration: 120,
                tweenChanges: true
            });
        };

        this.animateCaseStudyLines = function () {
            var solution = '#case_study__solution',
                download = '#case_study__download';

            drawIn($('#study_1'), {
                triggerElement: solution,
                triggerHook: 0.85,
                duration: 300,
                tweenChanges: true
            });

            drawIn($('#study_2'), {
                triggerElement: download,
                triggerHook: 1,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#study_3'), {
                triggerElement: download,
                triggerHook: 1,
                offset: 150,
                duration: 180,
                tweenChanges: true
            });

            drawIn($('#study_4'), {
                triggerElement: download,
                triggerHook: 0.97,
                duration: 70,
                tweenChanges: true
            });

            drawIn($('#study_5'), {
                triggerElement: download,
                triggerHook: 0.97,
                offset: 70,
                duration: 230,
                tweenChanges: true
            });

            drawIn($('#study_6'), {
                triggerElement: download,
                triggerHook: 0.8,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#study_7'), {
                triggerElement: download,
                triggerHook: 0.8,
                offset: 150,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#study_8'), {
                triggerElement: download,
                triggerHook: 0.45,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#study_9'), {
                triggerElement: download,
                triggerHook: 0.45,
                offset: 150,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#study_10'), {
                triggerElement: download,
                triggerHook: 0.45,
                offset: 250,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#study_11'), {
                triggerElement: download,
                triggerHook: 0.35,
                duration: 220,
                tweenChanges: true
            });
        };

        this.animateBannerLines = function () {
            var trigger = '.banner_container';

            drawIn($('#banner_1'), {
                triggerElement: trigger,
                triggerHook: 0.8,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#banner_2'), {
                triggerElement: trigger,
                triggerHook: 0.8,
                offset: 150,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#banner_3'), {
                triggerElement: trigger,
                triggerHook: 0.8,
                offset: 250,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#banner_4'), {
                triggerElement: trigger,
                triggerHook: 0.95,
                duration: 300,
                tweenChanges: true
            });

            drawIn($('#banner_5'), {
                triggerElement: trigger,
                triggerHook: 0.95,
                offset: 300,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#banner_6'), {
                triggerElement: trigger,
                triggerHook: 0.95,
                offset: 400,
                duration: 20,
                tweenChanges: true
            });

            drawIn($('#banner_7'), {
                triggerElement: trigger,
                triggerHook: 0.95,
                offset: 420,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#banner_8'), {
                triggerElement: trigger,
                triggerHook: 0.6,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#banner_9'), {
                triggerElement: trigger,
                triggerHook: 0.6,
                offset: 150,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#banner_10'), {
                triggerElement: trigger,
                triggerHook: 0.6,
                offset: 250,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#banner_11'), {
                triggerElement: trigger,
                triggerHook: 0.6,
                offset: 400,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#banner_12'), {
                triggerElement: trigger,
                triggerHook: 0.6,
                offset: 450,
                duration: 200,
                tweenChanges: true
            });

            drawIn($('#banner_13'), {
                triggerElement: trigger,
                triggerHook: 0.5,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#banner_14'), {
                triggerElement: trigger,
                triggerHook: 0.5,
                offset: 150,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#banner_15'), {
                triggerElement: trigger,
                triggerHook: 0.5,
                offset: 250,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#banner_16'), {
                triggerElement: trigger,
                triggerHook: 0.5,
                offset: 50,
                duration: 250,
                tweenChanges: true
            });
        };

        this.animateCompanyLines = function () {
            var trigger_1 = '#company__story',
                trigger_2 = '#company__leadership';

            drawIn($('#company_1'), {
                triggerElement: trigger_1,
                triggerHook: 0.7,
                duration: 50,
                tweenChanges: true
            });

            drawIn($('#company_2'), {
                triggerElement: trigger_1,
                triggerHook: 0.7,
                offset: 50,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#company_3'), {
                triggerElement: trigger_1,
                triggerHook: 0.7,
                offset: 200,
                duration: 200,
                tweenChanges: true
            });

            drawIn($('#company_4'), {
                triggerElement: trigger_1,
                triggerHook: 0.7,
                offset: 150,
                duration: 250,
                tweenChanges: true
            });

            drawIn($('#company_5'), {
                triggerElement: trigger_2,
                triggerHook: 0.85,
                duration: 250,
                tweenChanges: true
            });

            drawIn($('#company_6'), {
                triggerElement: trigger_2,
                triggerHook: 0.85,
                offset: 250,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#company_7'), {
                triggerElement: trigger_2,
                triggerHook: 0.85,
                offset: 400,
                duration: 100,
                tweenChanges: true
            });

            drawIn($('#company_8'), {
                triggerElement: trigger_2,
                triggerHook: 0.85,
                offset: 150,
                duration: 250,
                tweenChanges: true
            });
        };

        this.animateFooterLines = function () {
            var trigger = 'footer';

            drawIn($('#footer_3'), {
                triggerElement: trigger,
                offset: -370,
                duration: 150,
                tweenChanges: true
            });

            drawIn($('#footer_2'), {
                triggerElement: trigger,
                offset: -260,
                duration: 80,
                tweenChanges: true
            });

            drawIn($('#footer_1'), {
                triggerElement: trigger,
                offset: -180,
                duration: 150,
                tweenChanges: true
            });
        }

        this.animateHoverTable = function () {
            var table = $('.hover_table, .press_articles'),
                cells = table.find('td'),
                hook = $('#product__solutions').is('.no_top_padding') ? 0.85 : 0.55;

            cells.each(function (i, cell) {
                var delay = i * 70,

                    tween = TweenMax.from(cell, 1, {
                        autoAlpha: 0,
                        bottom: -10,
                        scale: 0.98
                    });

                if (table.is('.hover_table')) {
                    createScene({
                        triggerElement: '#product__solutions',
                        triggerHook: hook,
                        offset: delay,
                        duration: 60,
                    }, tween);
                } else {
                    createScene({
                        triggerElement: '#press',
                        triggerHook: 0.55,
                        offset: delay + 60,
                        duration: 60,
                    }, tween);
                }
            });
        };

        this.animateSingleHeroFade = function () {
            var tween;

            if (typeof $('.banner_bg_overlay').data('no-fade') !== 'undefined') return;

            tween = TweenMax.to('.banner_bg_overlay', 1, {
                autoAlpha: 0.6
            });

            createScene({
                triggerElement: 'body',
                triggerHook: 0,
                duration: 500,
            }, tween, null, null, false);
        };

        this.checkSvgSupport = function () {
            var svg = $('svg'),
                path = svg.find('line, path');

            if (!path.length) return false;

            if (typeof path[0].getTotalLength === 'undefined') {
                $('body').addClass('no_svg_support');

                return false;
            }

            return true;
        }

        this.init = function () {
            if ($('body').is('.mobile') || $(window).width() <= 950) return;
            if ($('#hero').is('.blog_single')) this.animateSingleHeroFade();
            if (window.hasFeaturedProducts) window.initFeaturedProducts();

            if (!this.checkSvgSupport()) return;

            if (window.hasProductsAnimation) this.animateProductSections();

            if (window.hasHeroLines) this.animateHeroLines();
            if (window.hasHomeLines) this.animateHomeLines();
            if (window.hasQuoteLines) this.animateQuoteLines();
            if (window.hasContactFormLines) this.animateContactFormLines();
            if (window.hasFullCtaLines) this.animateFullCtaLines();
            if (window.hasCaseStudiesLines) this.animateCaseStudiesLines();
            if (window.hasCaseStudyLines) this.animateCaseStudyLines();
            if (window.hasCompanyLines) this.animateCompanyLines();
            if (window.hasBannerLines) this.animateBannerLines();
            if (window.hasFooterLines) this.animateFooterLines();
            if (window.hasHoverTableBlocks) this.animateHoverTable();
        };
    }
});
