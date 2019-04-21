jQuery(function ($) {
    var scenes = $('.product__features__scene'),
        captions = $('.features_caption'),
        containerOffset = -75,
        sceneTransition = 200,
        fullSceneTransition = 200,
        shortSceneTransition = 100,
        sceneCrossover = 75,
        scenePadding = 200,
        captionOffset = 200,
        captionLength = 600,
        showSceneCaptionsAtOnce = true,
        pinnedSceneProps = {
            triggerElement: '#product__features__container',
            triggerHook: 0,
            offset: containerOffset,
            duration: getTotalScenesLength(scenes)
        },
        pinnedScene;

    window.initFeaturedProducts = function () {
        createPinnedScene();
        $(window).on('resize', $.debounce(50, refreshPinnedElement));

        scenes.each(function (i, scene) {
            var last = $(scenes[i - 1]),
                sceneCaptions = $(scene).find('.features_caption'),
                detailedImages = $(scene).find('.detailed_image'),
                trigger = '#product__features__container',
                transition = $(scene).data('transition'),
                isOverFade = transition === 'fade-into',
                sceneStart = getSceneOffset(i - 1) + (i * sceneTransition) + containerOffset,
                sceneEnd = getSceneEnd(scene, transition, sceneStart),
                fadeInProps = { autoAlpha: 0 },
                fadeOutProps = { autoAlpha: 0 },
                fadeIn, fadeOut;

            if (scenes.length > 1) {

                if (last.length && last.data('transition') === 'fade-out') {
                    fadeInProps.top = 50;
                }

                if (!isOverFade) {
                    fadeOutProps.bottom = 50;
                }

                fadeIn = TweenMax.from(scene, 1, fadeInProps);
                fadeOut = TweenMax.to(scene, 1, fadeOutProps);

                // no need to fade in the first scene
                if (i > 0) {
                    sectionScene = createScene({
                            triggerElement: trigger,
                            triggerHook: 0,
                            offset: sceneStart,
                            duration: sceneTransition // isOverFade ? sceneTransition * 2 : sceneTransition
                        },
                        fadeIn // , null, null, true
                    );
                }

                // no need to fade out the last scene
                if (i < scenes.length - 1) {
                    sectionScene = createScene({
                            triggerElement: trigger,
                            triggerHook: 0,
                            offset: sceneEnd,
                            duration: sceneTransition
                        },
                        fadeOut // , null, null, true
                    );
                }
            }

            loadCaptions(i, sceneStart);
            if (detailedImages.length) loadDetailedImages(detailedImages, sceneStart, sceneEnd);
        });
    };

    function createPinnedScene() {
        pinnedScene = createScene(
            pinnedSceneProps,
            null,
            '#product__features__container' // , null, true
        );
    }

    function refreshPinnedElement() {
        if (!pinnedScene) return;

        pinnedScene.destroy(true);
        createPinnedScene();
    }

    function getSceneEnd(scene, transition, sceneStart) {
        switch (transition) {
            case 'fade-out':
                return sceneStart + getSceneLength(scene) + (fullSceneTransition / 7);
            case 'fade-into':
                return sceneStart + getSceneLength(scene) + (fullSceneTransition * 2);
        }
    }

    function loadCaptions(i, sceneStart) {
        var scene = scenes[i],
            sceneCaptions = $(scene).find('.features_caption'),
            currentCaptionOffset;

        sceneCaptions.each(function (i, caption) {
            currentCaptionOffset = sceneStart + scenePadding;

            if (!showSceneCaptionsAtOnce) {
                currentCaptionOffset += (captionLength * i) + (captionOffset * i);
            }

            createScene({
                    triggerElement: '#product__features__container',
                    triggerHook: 0,
                    offset: currentCaptionOffset,
                    duration: captionLength
                },
                null, null,
                ['#' + caption.id, 'display']
            );

            createScene({
                    triggerElement: '#product__features__container',
                    triggerHook: 0,
                    offset: currentCaptionOffset + 20,
                    duration: captionLength - 20
                },
                null, null,
                ['#' + caption.id + '__pointer', 'pointing']
            );
        });
    }

    function loadDetailedImages(images, sceneStart, sceneEnd) {
        images.each(function (i, image) {
            var offset = 40, // + (i * 30),

                fadeIn = TweenMax.from(image, 1, {
                    autoAlpha: 0,
                    bottom: '-15%',
                    scale: 0.95
                }),

                fadeOut = TweenMax.to(image, 1, {
                    bottom: '-5%',
                    scale: 0.95
                });

            createScene({
                    triggerElement: '#product__features__container',
                    triggerHook: 0,
                    offset: sceneStart + offset,
                    duration: 60
                },
                fadeIn
            );

            createScene({
                    triggerElement: '#product__features__container',
                    triggerHook: 0,
                    offset: sceneEnd - offset,
                    duration: 120
                },
                fadeOut
            );
        });
    }

    function getTotalScenesLength(scenes) {
        var length = sceneTransition * (scenes.length - 2);

        scenes.each(function (i, scene) {
            length += getSceneLength(scene); // + sceneCrossover;
        });

        return length;
    }

    function getSceneLength(scene) {
        var captions = $(scene).find('.features_caption'),
            length = (scenePadding * 2) // scene padding

        if (showSceneCaptionsAtOnce) {
            length += captionLength;
        } else {
            length += (captions.length * captionLength) + // total caption length
                    ((captions.length - 1) * captionOffset); // padding between captions
        }

        return length;
    }

    function getSceneOffset(sceneI) {
        var i = 0,
            offset = containerOffset;

        while (i <= sceneI) {
            offset += getSceneLength(scenes[i]);
            i++;
        }

        return offset;
    }
});
