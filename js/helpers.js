(function (root) {
    root.newController = function () {
        return new ScrollMagic.Controller();
    }

    root.newScene = function (options) {
        return new ScrollMagic.Scene(options);
    };

    root.createScene = function (options, tween, pin, className, debug, controller) {
        var scene = newScene(options);
        if (tween) scene.setTween(tween);
        if (pin) scene.setPin(pin);
        if (className && Array.isArray(className) && className.length > 1) scene.setClassToggle(className[0], className[1]);
        if (debug && typeof scene.addIndicators !== 'undefined') scene.addIndicators();
        if (!controller) controller = newController();
        return scene.addTo(controller);
    };

    root.drawIn = function (el, options) {
        var tween = createToTween(el, {
            strokeDashoffset: 0,
            ease: Linear.easeNone
        });
        prepareSvg(el);
        createScene(options, tween);
    };

    root.drawDebug = function (el, options) {
        var tween = createToTween(el, {
            strokeDashoffset: 0,
            ease: Linear.easeNone
        });
        prepareSvg(el);
        createScene(options, tween,  null, null, true);
    };

    root.drawOut = function (el, options) {
        var path = el.find('line, path'),
            lineLength, tween;

        if (!path.length) return;

        lineLength = path[0].getTotalLength();

        from = {strokeDashoffset: 0};
        to = {strokeDashoffset: lineLength};

        tween = createFromToTween(
            el,
            {strokeDashoffset: 0},
            {strokeDashoffset: lineLength}
        );

        prepareSvg(el, true);
        drawOnLoad([[el, 0, 0]]);
        createScene(options, tween);
    };

    root.drawOnLoad = function (arr) {
        arr.forEach(function (animation) {
            var el = animation[0],
                duration = animation[1],
                delay = animation[2];

            setTimeout(function () {
                createToTween(el, {
                    strokeDashoffset: 0,
                    ease: Linear.easeNone
                }, duration);
            }, delay)
        });
    };

    root.createToTween = function (el, to, duration) {
        if (typeof duration === 'undefined') duration = 0.1;

        return new TimelineMax()
            .add(TweenMax.to(
                el,
                duration,
                to
            ));
    };

    root.createFromToTween = function (el, from, to, duration) {
        if (typeof duration === 'undefined') duration = 0.1;

        return new TimelineMax()
            .add(TweenMax.fromTo(
                el,
                duration,
                from,
                to
            ));
    };

    root.prepareSvg = function (els, backward) {
        if (Array.isArray(els)) {
            els.forEach(function (el) {
                preparePath(el, backward);
            })
        } else {
            preparePath(els, backward);
        }
    }

    root.preparePath = function (el, backward) {
        var path = el.find('line, path'),
            lineLength;

        if (!path.length) return;

        lineLength = path[0].getTotalLength();

        el.css({
            'stroke-dasharray': lineLength,
            'stroke-dashoffset': backward ? 1 : lineLength,
            'opacity': 1
        });
    };

    root.createDownloadCookie = function (inputs) {
        var date = new Date();
        date.setTime(date.getTime() + (24 * 60 * 60 * 1000));
        document.cookie = 'AilaFileDownloaded=true; expires=' + date.toGMTString() + '; path=/';

        inputs.forEach(function (input) {
            document.cookie = 'AilaForm:' + input.name + '=' + input.value + '; expires=' + date.toGMTString() + '; path=/';
        });
    };

    root.downloadCookieExists = function () {
        var cookie = document.cookie;
        return cookie.indexOf('AilaFileDownloaded') !== -1;
    };

    root.getCookieData = function () {
        var cookies = document.cookie.split('; ').filter(function (c) { return c.indexOf('AilaForm') !== -1; })
            data = [];

        if (!cookies.length) return false;

        cookies.forEach(function (cookie) {
            var cookieArray = cookie.split('=');

            data.push({
                name: cookieArray[0].replace('AilaForm:', ''),
                value: cookieArray[1]
            })
        });

        return data;
    };

    root.getPxValue = function (el, prop) {
        return parseInt(
            el.css(prop).replace(/px/g, ''),
            10
        );
    };

})(this);
