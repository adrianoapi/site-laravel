/*
 * jQuery UI Touch Punch 0.2.2
 *
 * Copyright 2011, Dave Furfero
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 * Depends:
 *  jquery.ui.widget.js
 *  jquery.ui.mouse.js
 */
(function(b){b.support.touch="ontouchend" in document;if(!b.support.touch){return;}var c=b.ui.mouse.prototype,e=c._mouseInit,a;function d(g,h){if(g.originalEvent.touches.length>1){return;}g.preventDefault();var i=g.originalEvent.changedTouches[0],f=document.createEvent("MouseEvents");f.initMouseEvent(h,true,true,window,1,i.screenX,i.screenY,i.clientX,i.clientY,false,false,false,false,0,null);g.target.dispatchEvent(f);}c._touchStart=function(g){var f=this;if(a||!f._mouseCapture(g.originalEvent.changedTouches[0])){return;}a=true;f._touchMoved=false;d(g,"mouseover");d(g,"mousemove");d(g,"mousedown");};c._touchMove=function(f){if(!a){return;}this._touchMoved=true;d(f,"mousemove");};c._touchEnd=function(f){if(!a){return;}d(f,"mouseup");d(f,"mouseout");if(!this._touchMoved){d(f,"click");}a=false;};c._mouseInit=function(){var f=this;f.element.bind("touchstart",b.proxy(f,"_touchStart")).bind("touchmove",b.proxy(f,"_touchMove")).bind("touchend",b.proxy(f,"_touchEnd"));e.call(f);};})(jQuery);

/*
* jQuery PageGuide Plugin
*
* Build interactive visual guides to help users get familiar your web app.
* jQuery PageGuide started as a rewrite of the Tracelytics PageGuide,
* intended to work as a true jQuery plugin. But then I started adding more
* and more functionality, and now it's taken on a life of it's own.
*
* Copyright 2012 Sprint.ly
*
* Author: Ian White <ian@sprint.ly>
* Source: http://github.com/impressiver/jquery.pageguide
*
* Free to use under the MIT license.
* http://www.opensource.org/licenses/mit-license.php
*
* -----
* Based on:
* Tracelytics PageGuide
* Copyright 2012 Tracelytics
*
* Project Home: http://tracelytics.github.com/pageguide/
*
* Free to use under the MIT license.
* http://www.opensource.org/licenses/mit-license.php
*
*/

/*
* PageGuide usage:
*
*   PageGuide guides can be defined either as markup (an `OL` in the DOM),
*   or directly in JavaScript to get more flexibility. To see how guides
*   are structured, check out the examples included in the project repo.
*
*   The simplest way to initialize PageGuide is by calling `$.pageguide()`
*   with no arguments. This will set up the default options and prepare the
*   plugin to load individual guides. For convenience, you can load a
*   default guide and set base options during initialization like so:
*   `$.pageguide(guide, options)`, where `guide` is either a CSS selector
*   that identifies the DOM element to use as the guide definition, or a JS
*   object that contains the guide definition. `options` is an optional
*   object that is used to override the default settings.
*
*   To load a guide after initialization, or load a different guide, call
*   `$.pageguide('load', guide, options)`. When loading a guide, the
*   `options` argument will only be applied to that guide.
*
*   In order to update options after initialization that will be applied to
*   all guides, use `$.pageguide('options', options)`. Keep in mind, any
*   options specified when calling `$.pageguide.load()` will still take
*   precedence.
*
*   All of these override methods perform a deep merge between the default
*   options and override options to create the base settings.
*
*
*   Guide Options:
*     defaultGuide: none (String selector, jQuery selector, Object guide)
*       - CSS selector or guide definition object to load when $.pageguide
*         is initialized without a guide as the first argument.
*
*     autoStart: true (true, false)
*       - Whether or not to focus on the first visible item immediately on
*         open.
*
*     autoStartDelay: 0 (int milliseconds)
*       - Add a delay before automatically selecting the first visible item
*         after the guide is opened.
*
*     autoAdvanceInterval: null (int seconds)
*       - Rotate through the visible steps at a regular interval while the
*         guide is open.
*
*     loadingSelector: none (String selector, jQuery selector)
*       - The CSS selector for the DOM element used as a loading indicator.
*         PageGuide will wait until this element is no longer visible
*         before starting up.
*
*     pulse: true (true, false)
*       - Show an animated effect to further highlight the target element
*         whenever a new step is selected. Requires the step shadow to be
*         set to 'true'.
*
*     events: {} (Object {init, ready, load, unload, open, close, previous,
*                next, step, resize, click} callback functions)
*       - Convenience wrapper to specify guide-level event handlers. These
*         events are bound on load, and automatically removed when the
*         guide is unloaded.
*
*   Step Options (options.step):
*     direction: 'left' ('top', 'right', 'bottom', 'left')
*       - Position of the floating step number indicator in relation to the
*         target element.
*
*     margin: {top: 100, bottom: 100} (Object {top, bottom} in px)
*       - Minimum distance the target element must be from top or bottom of
*         the viewport. If the element is outside of this margin, the
*         window will scroll to bring the element into view.
*
*     shadow: true (true, false)
*       - Render a transparent box around the current step's target
*         element.
*
*     shadowPadding: '10px' (String padding, int padding)
*       - Applied to all sides of the shadow to pad the height and width
*         around the target element.
*
*     zIndex: null (int z-index)
*       - Force the base z-index of the step, which is used when rendering
*         the floating step number indicator and the shadow. If set to
*         null, the target element's z-index is used. The shadow is
*         rendered at a z-index of base + 1, and the floating step number
*         indicator is base + 2.
*
*     arrow: {offsetX: 0, offsetY: 0} (Object {offsetX, offsetY} in px)
*       - Additional offset to apply to the floating step indicator to make
*         fine adjustments to positioning.
*
*     events: {} (Object {show, hide, select, deselect} callbacks)
*       - Convenience wrapper to specify step-level event handlers. These
*         events are bound to the individual step on load, and
*         automatically removed when the guide is unloaded.
*
*/

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function($, undefined ) {
    "use strict";

    if ($.pageguide !== undefined) {
        return;
    }

    /**
     *
     * @param {String|jQuerySelector|Object} [guide]   The default guide to load as soon as initialization is complete
     * @param {Object} [options] Override settings for all guides, merged with default options.
     *
     * @class a PageGuide
     */
    var PageGuide = function (guide, options) {
        if(arguments.length == 1) {
            options = guide;
            guide = null;
        }
        options = options || {};
        this.options(options);

        // Make sure $.fn.zIndex is available
        if (!$.fn['zIndex']) $.fn['zIndex'] = this._zIndex;

        this.init();

        var defaultGuide = guide || this.settings.defaultGuide || null;

        if (defaultGuide) {
            if (this.status === 'ready') {
                this.load(defaultGuide);
            } else {
                this.$wrapper.one('ready.pageguide', $.proxy(function () {
                    this.load(defaultGuide);
                }, this));
            }
        }
    };

    $.extend(PageGuide, {
        options: {
            defaultGuide: "#pageGuide",
            autoStart: true,
            autoStartDelay: 0,
            autoAdvanceInterval: null,
            loadingSelector: null,
            pulse: true,
            events: {},
            step: {
                direction: 'left',
                margin: {top: 100, bottom: 100},
                shadow: true,
                shadowPadding: '10px',
                zIndex: null,
                arrow: {
                    offsetX: 0,
                    offsetY: 0
                },
                events: {}
            }
        },
        DIRECTION_REGEX: /pageguide[_-](top|right|bottom|left)(?:\s|$)/i,
        instances: 0,
        uid: function () {
            return PageGuide.instances++;
        },
        prototype: {
            _options: {},               // base options (with default overrides)
            settings: {},               // base options with overrides for current guide
            status: 'uninitialized',

            _guide: null,               // current guide definition
            $guide: null,               // current guide selector

            $wrapper: null,             // #pageGuideWrapper
            $message: null,             // #pageGuideMessage
            $toggle: null,              // #pageGuideToggle
            $shadow: null,              // #pageGuideShadow
            $fwd: null,                 // a.pageguide-fwd
            $back: null,                // a.pageguide-back

            /**
             * Initialize the PageGuide. Creates the navigation DOM elements
             * and triggers a 'ready.pageguide' event when done.
             *
             * @return {[type]}
             */
            init: function() {
                var wrapper = $('<div>', {
                        id: 'pageGuideWrapper'
                    }),
                    message = $('<div>', {
                        id: 'pageGuideMessage'
                    }),
                    toggle = $('<div/>', {
                        id: 'pageGuideToggle',
                        title: 'Launch Page Guide',
                        'class': 'pageguide-toggle-close'
                    }),
                    shadow = $('<div/>', {
                        id: 'pageGuideShadow',
                        'class': 'pageguide-shadow'
                    });

                toggle.append('page guide').append('<div><span class="pageguide-tourtitle"></span></div>').append('<a class="pageguide-close" title="Close Guide">close guide &raquo;</a>');
                message.append('<a class="pageguide-close" title="Close Guide">close</a>').append('<span class="pageguide-index"></span>').append('<div class="pageguide-content"></div>').append('<a class="pageguide-back" title="Previous">Previous</a>').append('<a class="pageguide-fwd" title="Next">Next</a>');
                shadow.append('<span class="pageguide-shadow-pulse"></span>');

                wrapper.append(toggle);
                wrapper.append(message);
                wrapper.append(shadow);
                $('body').append(wrapper);

                this.$wrapper = wrapper;
                this.$toggle = toggle;
                this.$message = message;
                this.$shadow = shadow;

                this.$fwd = $('a.pageguide-fwd', this.$wrapper);
                this.$back = $('a.pageguide-back', this.$wrapper);

                this.status = 'initialized';
                this.$wrapper.trigger('init.pageguide');

                if (this.settings.loadingSelector) {
                    this._wait($.proxy(function () {
                        this._registerWrapperHandlers();
                        this.status = 'ready';
                        this.$wrapper.trigger('ready.pageguide');
                    }, this));
                } else {
                    this._registerWrapperHandlers();
                    this.status = 'ready';
                    this.$wrapper.trigger('ready.pageguide');
                }
            },

            /**
             * Dismantle the UI and clean up event handlers.
             *
             * @return {PageGuide}
             */
            destroy: function () {
                if (this._guide) {
                    this.unload();
                }
                // @@@ handlers removed by jQuery.remove()
                this._removeWrapperHandlers();
                this.$wrapper.remove();

                this.status = 'destroyed';
                return this;
            },

            /**
             * Get or set overrides for base options. If the argument is
             * ommitted, an object containing the current options are returned.
             *
             * @param  {Object} [options] Settings to override for all guides
             * @return {PageGuide}
             */
            options: function(options) {
                if (options === undefined) {
                    return this._options;
                }

                this._options = $.extend(true, {}, PageGuide.options, options);
                this.settings = $.extend(true, {}, PageGuide.options, this.settings || {}, options);

                return this;
            },

            /**
             * Get or load a guide. If the argument is ommitted, the currently loaded
             * guide definition is returned.
             *
             * @param  {String|jQuerySelector|Object} [guide] Guide definition to load
             * @return {PageGuide} Guide definition
             */
            guide: function(guide) {
                if (guide === undefined) {
                    return this._guide;
                }

                this.load(guide, this.settings);

                return this;
            },

            /**
             * Load a guide. Automatically unloads the previous guide (if any).
             *
             * @param  {String|jQuerySelector|Object} guide Guide definition to load
             * @param  {Object} [options] Override options applied only to this guide
             * @return {PageGuide}
             */
            load: function(guide, options) {
                if (!guide || $.isEmptyObject(guide)) {
                  return this;
                }

                if(this._guide) {
                    this.unload();
                }

                // Override guide options
                if (options !== undefined) {
                    this.settings = $.extend(true, {}, PageGuide.options, this._options, options);
                }

                var that = this,
                    $guide = (typeof guide === 'string') ? $(guide) : null;

                if ($guide) {
                    if (!$guide.size()) return this;

                    guide = {
                        title: $guide.data('tourtitle'),
                        steps: []
                    };

                    var $allItems = $('> li', $guide);
                    $.each($allItems, function (i) {
                        var matches = PageGuide.DIRECTION_REGEX.exec($(this).attr('class'));
                        var direction = matches ? matches.pop() : that.settings.step.direction;

                        var step = {
                            target: $(this).data('tourtarget'),
                            content: $(this).html(),
                            direction: direction,
                            options: $.extend(true, {}, $(this).data('options')),
                            elem: this
                        };
                        guide.steps.push(step);
                    });
                } else {
                    $guide = ((guide.id && $('#' + guide.id).size()) ? $('#' + guide.id).empty() : $('<ol/>', {
                      id: guide.id || 'pageGuide' + PageGuide.uid(),
                      'class': 'pageguide-guide'
                    })).data('tourtitle', guide.title);

                    $.each(guide.steps, function (i) {
                        var $li = $('<li/>', {
                            id: 'pageguide-step-' + i,
                            'class': 'pageguide-step pageguide-' + this.direction
                        }).data('tourtarget', this.target);

                        $li.data('options', $.extend({}, this));

                        $('<div/>', {
                            'class': 'pageguide-content'
                        }).html(this.content).appendTo($li);

                        $guide.append($li);
                        this.elem = $li;
                    });
                }

                this._guide = guide;
                this.curIdx = 0;

                this.$wrapper.append($guide);
                this.$guide = $guide;

                this.$allItems = $('> li', this.$guide);
                this.$visibleItems = $();

                this.$toggle.removeClass('.pageguide-toggle-open').addClass('pageguide-toggle-close');
                this.$toggle.find('.pageguide-tourtitle').html(this._guide.title);

                $('body').addClass('pageguide-ready');

                this._registerGuideHandlers();
                this._registerCustomHandlers();
                this._registerCustomStepHandlers();

                this.status = 'loaded';
                this.$wrapper.trigger('load.pageguide', this._guide);

                return this;
            },

            /**
             * Close and disable the current guide. Removes guide event handlers.
             *
             * @return {PageGuide}
             */
            unload: function() {
                if(!this._guide) {
                  return this;
                }

                if(this.isOpen()) {
                    this.close();
                }

                this.$toggle.removeClass('pageguide-toggle-open pageguide-toggle-close');
                $('body').removeClass('pageguide-ready');

                // @@@ Custom handlers should be removed by jQuery.remove()
                this._removeCustomStepHandlers();
                this._removeCustomHandlers();
                this._removeGuideHandlers();

                this.$allItems = $();
                this.$visibleItems = $();

                this.$guide = null;
                this._guide = null;

                this.settings = this.options();

                this.status = 'unloaded';
                this.$wrapper.trigger('unload.pageguide');

                return this;
            },

            /**
             * Start the guide. If `options.autoStart` is true, the first step will be selected automatically.
             *
             * @return {PageGuide}
             */
            open: function() {
                if ($('body').is('.pageguide-open')) return;

                $('body').addClass('pageguide-open');
                this._onExpand();
                this.$visibleItems.toggleClass('expanded', true);

                this.$wrapper.trigger('open.pageguide');
                this.$visibleItems.trigger('show.pageguide');

                return this;
            },

            /**
             * Stop the guide.
             *
             * @return {PageGuide}
             */
            close: function() {
                if (!$('body').is('.pageguide-open')) return this;

                this.autoAdvance(false);

                this.$shadow.removeClass('pageguide-shadow-active').hide();
                this.$allItems.removeClass("pageguide-active").toggleClass('expanded', false);
                var curItem = this.$visibleItems[this.curIdx];
                if(curItem) {
                  $(curItem).trigger('deselect.pageguide');
                }

                this.$toggle.removeClass('pageguide-toggle-open').addClass('pageguide-toggle-close');

                this.$message.animate({
                    height: "0"
                }, 500, function() {
                    $(this).hide();
                });

                /* clear number tags and shading elements */
                $('ins').remove();
                $('body').removeClass('pageguide-open');

                this.$visibleItems.trigger('hide.pageguide');
                this.$wrapper.trigger('close.pageguide');

                return this;
            },

            /**
             * Show the visible step prior to the currently selected step.
             *
             * @return {PageGuide}
             */
            previous: function() {
                if (!$('body').is('.pageguide-open')) return this;
                /*
                 * If -n < x < 0, then the result of x % n will be x, which is
                 * negative. To get a positive remainder, compute (x + n) % n.
                 */
                var newIdx = (this.curIdx + this.$visibleItems.size() - 1) % this.$visibleItems.size();

                this.$wrapper.trigger('previous.pageguide');
                this.showStep(newIdx, 1);

                return this;
            },

            /**
             * Advance the guide to the next visible step.
             *
             * @return {PageGuide}
             */
            next: function() {
                if (!$('body').is('.pageguide-open')) return this;

                var newIdx = (this.curIdx + 1) % this.$visibleItems.size();

                this.$wrapper.trigger('next.pageguide');
                this.showStep(newIdx, -1);

                return this;
            },

            /**
             * Select step by index
             * @param  {[type]} newIdx    The index (0-based) of the step to select
             * @param  {int} [direction]  If negative, the step number in the message field will scroll to the left, if positive it will scroll to the right. If undefined or 0, it's calculated automatically.
             * @return {PageGuide}
             */
            showStep: function(newIdx, direction) {
                var oldIdx = this.curIdx,
                    oldItem = this.$visibleItems[oldIdx],
                    newItem = this.$visibleItems[newIdx],
                    left = (direction && direction !== 0) ? (direction > 0) ? true : false : (oldIdx > newIdx),
                    settings = $.extend(true, {}, this.settings.step, $(newItem).data('options') || {});

                this.curIdx = newIdx;

                $('div', this.$message).html($(newItem).children('div').html());
                this.$visibleItems.removeClass("pageguide-active");
                $(newItem).addClass("pageguide-active");

                if (settings.shadow) {
                    this._showShadow(newItem);
                } else {
                    this.$shadow.removeClass('pageguide-shadow-active').hide();
                }

                if (!this._isScrolledIntoView($(newItem))) {
                    this._scrollIntoView(newItem);
                }

                this.$message.not(':visible').show().animate({
                    'height': '100px'
                }, 500);

                this._rollNumber($('span', this.$message), $(newItem).children('ins').html(), left);

                this.$wrapper.trigger('step.pageguide', newItem);
                if ($(oldItem).data('idx') != $(newItem).data('idx')) $(oldItem).trigger('deselect.pageguide', newItem);
                $(newItem).trigger('select.pageguide', oldItem);

                return this;
            },

            refresh: function() {
                if (!this.isOpen()) return this;

                var that = this;

                this.$visibleItems = this.$allItems.filter(function() {
                    return $($(this).data('tourtarget')).is(':visible');
                });

                // Position the floating indicators
                this.$visibleItems.each(function() {
                    var arrow = $(this),
                        settings = $.extend(true, {}, that.settings.step, $(this).data('options') || {}),
                        target = $(arrow.data('tourtarget')),
                        setLeft = target.offset().left + parseInt(settings.arrow.offsetX, 10),
                        setTop = target.offset().top + parseInt(settings.arrow.offsetY, 10);

                    if (arrow.hasClass("pageguide-top")) {
                        setTop -= 60;
                    } else if (arrow.hasClass("pageguide-bottom")) {
                        setTop += target.outerHeight() + 15;
                    } else {
                        setTop += 5;
                    }

                    if (arrow.hasClass("pageguide-right")) {
                        setLeft += target.outerWidth(false) + 15;
                    } else if (arrow.hasClass("pageguide-left")) {
                        setLeft -= 65;
                    } else {
                        setLeft += 5;
                    }

                    arrow.css({
                        "left": setLeft + "px",
                        "top": setTop + "px"
                    });
                });

                // Position the shadow
                if (this.$shadow.is(':visible')) {
                    this._showShadow(this.$visibleItems[this.curIdx], false);
                }

                return this;
            },

            autoAdvance: function(toggle) {
                if (toggle === undefined || !!toggle) {
                  if (this.advanceTimer) return this;
                  this.advanceTimer = setInterval($.proxy(this.next, this), this.settings.autoAdvanceInterval * 1000);
                } else {
                  clearInterval(this.advanceTimer);
                  this.advanceTimer = null;
                }

                return this;
            },

            /**
             * Check if a guide is currently loaded.
             *
             * @return {Boolean}
             */
            isLoaded: function() {
              return !!this._guide;
            },

            /**
             * Check if the guide is running.
             *
             * @return {Boolean}
             */
            isOpen: function() {
                return $('body').is('.pageguide-open');
            },

            _registerWrapperHandlers: function() {
                /* interaction: open/close PG interface */
                this.$toggle.on('click', $.proxy(function(e) {
                    if ($('body').is('.pageguide-open')) {
                        this.close();
                    } else {
                        this.open();
                    }
                }, this));

                this.$message.on('click', '.pageguide-close', $.proxy(function(e) {
                    this.close();
                }, this));

                this.$message.on('click', '.pageguide-index', $.proxy(function(e) {
                    e.stopPropagation();

                    var item = this.$visibleItems[this.curIdx];
                    if (!this._isScrolledIntoView(item)) {
                        this._scrollIntoView(item);
                    }
                }, this));

                /* interaction: fwd click */
                this.$fwd.on('click', $.proxy(function(e) {
                    e.stopPropagation();

                    this.autoAdvance(false);
                    this.next();
                }, this));

                /* interaction: back click */
                this.$back.on('click', $.proxy(function(e) {
                    e.stopPropagation();

                    this.autoAdvance(false);
                    this.previous();
                }, this));

                /* shadow pulse animation end */
                this.$shadow.on('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', '.pageguide-shadow-pulse', function () {
                    $(this).hide();
                });

                /* register resize callback */
                $(window).resize($.proxy(function() {
                    this._onResize();
                }, this));

                /* register teardown handler */
                this.$wrapper.on("destroyed", $.proxy(this.destroy, this));
            },

            _removeWrapperHandlers: function () {
                this.$wrapper.off();
                this.$toggle.off();
                this.$message.off();
                this.$shadow.off();
                this.$fwd.off();
                this.$back.off();

                $(window).unbind('resize.pageguide');
            },

            _registerGuideHandlers: function() {
                if (!this.$guide) {
                    return false;
                }

                /* interaction: item click */
                this.$guide.on('click', 'li', $.proxy(function(e) {
                    e.stopPropagation();

                    var newIdx = $(e.currentTarget).data('idx');

                    this.$wrapper.trigger('click.pageguide', newIdx);

                    if (this.curIdx == newIdx) {
                        return;
                    }

                    this.showStep(newIdx);
                }, this));
            },

            _removeGuideHandlers: function() {
                this.$guide.off();
            },

            _registerCustomHandlers: function() {
                var that = this,
                    events = $.extend(true, {}, this.settings.events, this._guide.events);

                if (!$.isEmptyObject(events)) {
                    $.each(events, function (i) {
                        that.$wrapper.on(i + '.pageguide', this);
                    });
                }
            },

            _removeCustomHandlers: function() {
                var that = this,
                    events = $.extend(true, {}, this.settings.events, this._guide.events);

                if (!$.isEmptyObject(events)) {
                    $.each(events, function (i) {
                        that.$wrapper.off(i + '.pageguide', this);
                    });
                }
            },

            _registerCustomStepHandlers: function() {
                var that = this;
                $.each(this._guide.steps, function (i) {
                    var $step = $(this.elem),
                        settings = $.extend(true, {}, that.settings.step, this);

                    if ($.isEmptyObject(settings.events)) {
                        return;
                    }

                    for (var j in settings.events) {
                        if (!settings.events.hasOwnProperty(j)) {
                            continue;
                        }

                        $step.on(j + '.pageguide', settings.events[j]);
                    }
                });
            },

            _removeCustomStepHandlers: function() {
                $.each(this.$allItems, function (i) {
                    $(this).off('click.pageguide, show.pageguide, hide.pageguide, select.pageguide, deselect.pageguide');
                });
            },

            _wait: function(callback) {
                var that = this;
                var interval = window.setInterval(function() {
                    if (!$(that.settings.loadingSelector).is(':visible')) {
                        callback();
                        clearInterval(interval);
                    }
                }, 250);
            },

            _rollNumber: function($numWrapper, newText, left) {
                $numWrapper.animate({
                    'text-indent': (left ? '' : '-') + '50px'
                }, 'fast', function() {
                    $numWrapper.html(newText);
                    $numWrapper.css({
                        'text-indent': (left ? '-' : '') + '50px'
                    }, 'fast').animate({
                        'text-indent': "0"
                    }, 'fast');
                });

                return this;
            },

            _scrollIntoView: function(elem) {
                var $t = $(elem).data('tourtarget') ? $($(elem).data('tourtarget')) : $(elem),
                    dvh = $(window).height(),
                    msgh = this.$message.outerHeight(),
                    elh = $t.outerHeight(),
                    dvtop = $(window).scrollTop(),
                    eltop = $t.offset().top,
                    elbtm = eltop + elh,
                    mgn = $(elem).data('options') ? $.extend({}, this.settings.step.margin, $(elem).data('options').margin || {}) : this.settings.step.margin,
                    mgnb = Math.max(mgn.bottom, msgh + 15);

                var scrollTo = ((eltop <= dvtop + mgn.top) || (elh > (dvh - mgnb))) ? eltop - mgn.top : (elbtm - (dvh - mgnb));

                $('html,body').animate({
                  scrollTop: scrollTo
                }, {
                  complete: $.proxy(this._onResize, this),
                  duration: 500
                });
            },

            _isScrolledIntoView: function(elem) {
                var $t = $(elem).data('tourtarget') ? $($(elem).data('tourtarget')) : $(elem),
                    msgh = this.$message.outerHeight(),
                    dvtop = $(window).scrollTop(),
                    dvbtm = dvtop + $(window).height(),
                    eltop = $t.offset().top,
                    elbtm = eltop + $t.outerHeight(),
                    mgn = $(elem).data('options') ? $.extend({}, this.settings.step.margin, $(elem).data('options').margin || {}) : this.settings.step.margin;

                return (eltop >= dvtop + mgn.top) && (elbtm <= dvbtm - Math.max(mgn.bottom, msgh + 15));
            },

            _onExpand: function() {
                /* set up initial state */
                this.refresh();
                this.curIdx = 0;

                /* add number tags and PG shading elements */
                var that = this;
                this.$visibleItems.each(function(i) {
                    var settings = $.extend(true, {}, that.settings.step, $(this).data('options') || {}),
                        zIndex = settings.zIndex ? settings.zIndex : $($(this).data('tourtarget')).zIndex() + 2;

                    $(this).css('z-index', zIndex);
                    $(this).prepend('<ins>' + (i + 1) + '</ins>');
                    $(this).data('idx', i);
                });

                if ((this.settings.autoAdvanceInterval || this.settings.autoStart) && this.$visibleItems.size() > 0) {
                    if (this.settings.autoStartDelay) {
                        setTimeout($.proxy(function () {
                            this.showStep(0);
                        }, this), this.settings.autoStartDelay);
                    } else {
                        this.showStep(0);
                    }
                }
                if (this.settings.autoAdvanceInterval) {
                    this.autoAdvance(true);
                }
            },

            _showShadow: function(elem, pulse) {
                if (pulse === undefined) {
                    pulse = this.settings.pulse;
                }

                var $t = $(elem).data('tourtarget') ? $($(elem).data('tourtarget')) : $(elem),
                    settings = $.extend(true, {}, this.settings.step, $(elem).data('options') || {}),
                    padding = settings.shadowPadding ? parseInt(settings.shadowPadding, 10) : 0,
                    zIndex = $t.zIndex() + 1,
                    $pulse = this.$shadow.children('.pageguide-shadow-pulse');

                if (!!pulse) $pulse.hide();
                this.$shadow.css({
                    height: $t.outerHeight(),
                    width: $t.outerWidth(false),
                    padding: padding,
                    top: $t.offset().top - padding,
                    left: $t.offset().left - padding,
                    zIndex: zIndex
                }).toggleClass('pageguide-shadow-active', true).show();
                if (!!pulse) $pulse.show();

                return this;
            },

            _onResize: function() {
                if (!this.isOpen()) return this;

                this.refresh();

                if($.debounce !== undefined) {
                    $.debounce($.proxy(function() {
                        //noinspection JSPotentiallyInvalidUsageOfThis
                        this.$wrapper.trigger('resize.pageguide');
                    }, 300), this);
                } else {
                    this.$wrapper.trigger('resize.pageguide');
                }
            },

            /* Directly from jQuery UI Core
             * http://code.google.com/p/jquery-ui/source/browse/trunk/ui/jquery.ui.core.js */
            _zIndex: function(zIndex) {
                if (zIndex !== undefined) {
                    return this.css('zIndex', zIndex);
                }

                if (this.length) {
                    var elem = $(this[0]), position, value;
                    while (elem.length && elem[0] !== document) {
                        // Ignore z-index if position is set to a value where z-index is ignored by the browser
                        // This makes behavior of this function consistent across browsers
                        // WebKit always returns auto if the element is positioned
                        position = elem.css('position');
                        if (position == 'absolute' || position == 'relative' || position == 'fixed')
                        {
                            // IE returns 0 when zIndex is not specified
                            // other browsers return a string
                            // we ignore the case of nested elements with an explicit value of 0
                            // <div style="z-index: -10;"><div style="z-index: 0;"></div></div>
                            value = parseInt(elem.css('zIndex'), 10);
                            if (!isNaN(value) && value !== 0) {
                                return value;
                            }
                        }
                        elem = elem.parent();
                    }
                }

                return 0;
            }
        }
    });

    var pg = null;
    $.pageguide = function (fn, options) {
        // Return the PageGuide object, create one if necessary
        if (arguments.length == 0) {
            return pg ? pg : (pg = new PageGuide());
        }

        if (pg && typeof pg[fn] == 'function') {
            if (fn == 'destroy') {
                pg.destroy();
                pg = null;
                return;
            }

            return pg[fn].apply(pg, Array.prototype.slice.call(arguments, 1));
        }

        return pg ? pg.load(fn, options) : (pg = new PageGuide(fn, options));
    };
}));
/**
 * @preserve
 * FullCalendar v1.5.4
 * http://arshaw.com/fullcalendar/
 *
 * Use fullcalendar.css for basic styling.
 * For event drag & drop, requires jQuery UI draggable.
 * For event resizing, requires jQuery UI resizable.
 *
 * Copyright (c) 2011 Adam Shaw
 * Dual licensed under the MIT and GPL licenses, located in
 * MIT-LICENSE.txt and GPL-LICENSE.txt respectively.
 *
 * Date: Tue Sep 4 23:38:33 2012 -0700
 *
 */(function(e,t){function o(t){e.extend(!0,n,t)}function u(n,r,i){function D(e){if(!d)P();else{z();U();et();q(e)}}function P(){v=r.theme?"ui":"fc";n.addClass("fc");r.isRTL&&n.addClass("fc-rtl");r.theme&&n.addClass("ui-widget");d=e("<div class='fc-content' style='position:relative'/>").prependTo(n);h=new a(o,r);p=h.render();p&&n.prepend(p);I(r.defaultView);e(window).resize(X);F()||H()}function H(){setTimeout(function(){!b.start&&F()&&q()},0)}function B(){e(window).unbind("resize",X);h.destroy();d.remove();n.removeClass("fc fc-rtl ui-widget")}function j(){return l.offsetWidth!==0}function F(){return e("body")[0].offsetWidth!==0}function I(t){if(!b||t!=b.name){k++;nt();var n=b,r;if(n){(n.beforeHide||G)();Q(d,d.height());n.element.hide()}else Q(d,1);d.css("overflow","hidden");b=w[t];b?b.element.show():b=w[t]=new s[t](r=T=e("<div class='fc-view fc-view-"+t+"' style='position:absolute'/>").appendTo(d),o);n&&h.deactivateButton(n.name);h.activateButton(t);q();d.css("overflow","");n&&Q(d,1);r||(b.afterShow||G)();k--}}function q(e){if(j()){k++;nt();x===t&&z();var r=!1;if(!b.start||e||L<b.start||L>=b.end){b.render(L,e||0);W(!0);r=!0}else if(b.sizeDirty){b.clearEvents();W();r=!0}else if(b.eventsDirty){b.clearEvents();r=!0}b.sizeDirty=!1;b.eventsDirty=!1;$(r);E=n.outerWidth();h.updateTitle(b.title);var i=new Date;i>=b.start&&i<b.end?h.disableButton("today"):h.enableButton("today");k--;b.trigger("viewDisplay",l)}}function R(){U();if(j()){z();W();nt();b.clearEvents();b.renderEvents(A);b.sizeDirty=!1}}function U(){e.each(w,function(e,t){t.sizeDirty=!0})}function z(){r.contentHeight?x=r.contentHeight:r.height?x=r.height-(p?p.height():0)-V(d):x=Math.round(d.width()/Math.max(r.aspectRatio,.5))}function W(e){k++;b.setHeight(x,e);if(T){T.css("position","relative");T=null}b.setWidth(d.width(),e);k--}function X(){if(!k)if(b.start){var e=++N;setTimeout(function(){if(e==N&&!k&&j()&&E!=(E=n.outerWidth())){k++;R();b.trigger("windowResize",l);k--}},200)}else H()}function $(e){!r.lazyFetching||u(b.visStart,b.visEnd)?J():e&&Z()}function J(){f(b.visStart,b.visEnd)}function K(e){A=e;Z()}function Y(e){Z(e)}function Z(e){et();if(j()){b.clearEvents();b.renderEvents(A,e);b.eventsDirty=!1}}function et(){e.each(w,function(e,t){t.eventsDirty=!0})}function tt(e,n,r){b.select(e,n,r===t?!0:r)}function nt(){b&&b.unselect()}function rt(){q(-1)}function it(){q(1)}function st(){m(L,-1);q()}function ot(){m(L,1);q()}function ut(){L=new Date;q()}function at(e,t,n){e instanceof Date?L=S(e):C(L,e,t,n);q()}function ft(e,n,r){e!==t&&m(L,e);n!==t&&g(L,n);r!==t&&y(L,r);q()}function lt(){return S(L)}function ct(){return b}function ht(e,n){if(n===t)return r[e];if(e=="height"||e=="contentHeight"||e=="aspectRatio"){r[e]=n;R()}}function pt(e,t){if(r[e])return r[e].apply(t||l,Array.prototype.slice.call(arguments,2))}var o=this;o.options=r;o.render=D;o.destroy=B;o.refetchEvents=J;o.reportEvents=K;o.reportEventChange=Y;o.rerenderEvents=Z;o.changeView=I;o.select=tt;o.unselect=nt;o.prev=rt;o.next=it;o.prevYear=st;o.nextYear=ot;o.today=ut;o.gotoDate=at;o.incrementDate=ft;o.formatDate=function(e,t){return O(e,t,r)};o.formatDates=function(e,t,n){return M(e,t,n,r)};o.getDate=lt;o.getView=ct;o.option=ht;o.trigger=pt;c.call(o,r,i);var u=o.isFetchNeeded,f=o.fetchEvents,l=n[0],h,p,d,v,b,w={},E,x,T,N=0,k=0,L=new Date,A=[],_;C(L,r.year,r.month,r.date);r.droppable&&e(document).bind("dragstart",function(t,n){var i=t.target,s=e(i);if(!s.parents(".fc").length){var o=r.dropAccept;if(e.isFunction(o)?o.call(i,s):s.is(o)){_=i;b.dragStart(_,t,n)}}}).bind("dragstop",function(e,t){if(_){b.dragStop(_,e,t);_=null}})}function a(t,n){function u(){o=n.theme?"ui":"fc";var t=n.header;if(t){i=e("<table class='fc-header' style='width:100%'/>").append(e("<tr/>").append(f("left")).append(f("center")).append(f("right")));return i}}function a(){i.remove()}function f(r){var i=e("<td class='fc-header-"+r+"'/>"),u=n.header[r];u&&e.each(u.split(" "),function(r){r>0&&i.append("<span class='fc-header-space'/>");var u;e.each(this.split(","),function(r,a){if(a=="title"){i.append("<span class='fc-header-title'><h2>&nbsp;</h2></span>");u&&u.addClass(o+"-corner-right");u=null}else{var f;t[a]?f=t[a]:s[a]&&(f=function(){h.removeClass(o+"-state-hover");t.changeView(a)});if(f){var l=n.theme?tt(n.buttonIcons,a):null,c=tt(n.buttonText,a),h=e("<span class='fc-button fc-button-"+a+" "+o+"-state-default'>"+"<span class='fc-button-inner'>"+"<span class='fc-button-content'>"+(l?"<span class='fc-icon-wrap'><span class='ui-icon ui-icon-"+l+"'/>"+"</span>":c)+"</span>"+"<span class='fc-button-effect'><span></span></span>"+"</span>"+"</span>");if(h){h.click(function(){h.hasClass(o+"-state-disabled")||f()}).mousedown(function(){h.not("."+o+"-state-active").not("."+o+"-state-disabled").addClass(o+"-state-down")}).mouseup(function(){h.removeClass(o+"-state-down")}).hover(function(){h.not("."+o+"-state-active").not("."+o+"-state-disabled").addClass(o+"-state-hover")},function(){h.removeClass(o+"-state-hover").removeClass(o+"-state-down")}).appendTo(i);u||h.addClass(o+"-corner-left");u=h}}}});u&&u.addClass(o+"-corner-right")});return i}function l(e){i.find("h2").html(e)}function c(e){i.find("span.fc-button-"+e).addClass(o+"-state-active")}function h(e){i.find("span.fc-button-"+e).removeClass(o+"-state-active")}function p(e){i.find("span.fc-button-"+e).addClass(o+"-state-disabled")}function d(e){i.find("span.fc-button-"+e).removeClass(o+"-state-disabled")}var r=this;r.render=u;r.destroy=a;r.updateTitle=l;r.activateButton=c;r.deactivateButton=h;r.disableButton=p;r.enableButton=d;var i=e([]),o}function c(n,r){function w(e,t){return!p||e<p||t>d}function E(e,t){p=e;d=t;y=[];var n=++v,r=h.length;m=r;for(var i=0;i<r;i++)x(h[i],n)}function x(e,t){T(e,function(n){if(t==v){if(n){for(var r=0;r<n.length;r++){n[r].source=e;H(n[r])}y=y.concat(n)}m--;m||a(y)}})}function T(t,r){var s,o=i.sourceFetchers,u;for(s=0;s<o.length;s++){u=o[s](t,p,d,r);if(u===!0)return;if(typeof u=="object"){T(u,r);return}}var a=t.events;if(a)if(e.isFunction(a)){D();a(S(p),S(d),function(e){r(e);P()})}else e.isArray(a)?r(a):r();else{var l=t.url;if(l){var c=t.success,h=t.error,v=t.complete,m=e.extend({},t.data||{}),g=ft(t.startParam,n.startParam),y=ft(t.endParam,n.endParam);g&&(m[g]=Math.round(+p/1e3));y&&(m[y]=Math.round(+d/1e3));D();e.ajax(e.extend({},f,t,{data:m,success:function(t){t=t||[];var n=at(c,this,arguments);e.isArray(n)&&(t=n);r(t)},error:function(){at(h,this,arguments);r()},complete:function(){at(v,this,arguments);P()}}))}else r()}}function N(e){e=C(e);if(e){m++;x(e,v)}}function C(t){e.isFunction(t)||e.isArray(t)?t={events:t}:typeof t=="string"&&(t={url:t});if(typeof t=="object"){B(t);h.push(t);return t}}function L(t){h=e.grep(h,function(e){return!j(e,t)});y=e.grep(y,function(e){return!j(e.source,t)});a(y)}function A(e){var t,n=y.length,r,i=u().defaultEventEnd,s=e.start-e._start,o=e.end?e.end-(e._end||i(e)):0;for(t=0;t<n;t++){r=y[t];if(r._id==e._id&&r!=e){r.start=new Date(+r.start+s);e.end?r.end?r.end=new Date(+r.end+o):r.end=new Date(+i(r)+o):r.end=null;r.title=e.title;r.url=e.url;r.allDay=e.allDay;r.className=e.className;r.editable=e.editable;r.color=e.color;r.backgroudColor=e.backgroudColor;r.borderColor=e.borderColor;r.textColor=e.textColor;H(r)}}H(e);a(y)}function O(e,t){H(e);if(!e.source){if(t){c.events.push(e);e.source=c}y.push(e)}a(y)}function M(t){if(!t){y=[];for(var n=0;n<h.length;n++)e.isArray(h[n].events)&&(h[n].events=[])}else{if(!e.isFunction(t)){var r=t+"";t=function(e){return e._id==r}}y=e.grep(y,t,!0);for(var n=0;n<h.length;n++)e.isArray(h[n].events)&&(h[n].events=e.grep(h[n].events,t,!0))}a(y)}function _(t){if(e.isFunction(t))return e.grep(y,t);if(t){t+="";return e.grep(y,function(e){return e._id==t})}return y}function D(){g++||o("loading",null,!0)}function P(){--g||o("loading",null,!1)}function H(e){var r=e.source||{},i=ft(r.ignoreTimezone,n.ignoreTimezone);e._id=e._id||(e.id===t?"_fc"+l++:e.id+"");if(e.date){e.start||(e.start=e.date);delete e.date}e._start=S(e.start=k(e.start,i));e.end=k(e.end,i);e.end&&e.end<=e.start&&(e.end=null);e._end=e.end?S(e.end):null;e.allDay===t&&(e.allDay=ft(r.allDayDefault,n.allDayDefault));e.className?typeof e.className=="string"&&(e.className=e.className.split(/\s+/)):e.className=[]}function B(e){e.className?typeof e.className=="string"&&(e.className=e.className.split(/\s+/)):e.className=[];var t=i.sourceNormalizers;for(var n=0;n<t.length;n++)t[n](e)}function j(e,t){return e&&t&&F(e)==F(t)}function F(e){return(typeof e=="object"?e.events||e.url:"")||e}var s=this;s.isFetchNeeded=w;s.fetchEvents=E;s.addEventSource=N;s.removeEventSource=L;s.updateEvent=A;s.renderEvent=O;s.removeEvents=M;s.clientEvents=_;s.normalizeEvent=H;var o=s.trigger,u=s.getView,a=s.reportEvents,c={events:[]},h=[c],p,d,v=0,m=0,g=0,y=[];for(var b=0;b<r.length;b++)C(r[b])}function m(e,t,n){e.setFullYear(e.getFullYear()+t);n||E(e);return e}function g(e,t,n){if(+e){var r=e.getMonth()+t,i=S(e);i.setDate(1);i.setMonth(r);e.setMonth(r);n||E(e);while(e.getMonth()!=i.getMonth())e.setDate(e.getDate()+(e<i?1:-1))}return e}function y(e,t,n){if(+e){var r=e.getDate()+t,i=S(e);i.setHours(9);i.setDate(r);e.setDate(r);n||E(e);b(e,i)}return e}function b(e,t){if(+e)while(e.getDate()!=t.getDate())e.setTime(+e+(e<t?1:-1)*d)}function w(e,t){e.setMinutes(e.getMinutes()+t);return e}function E(e){e.setHours(0);e.setMinutes(0);e.setSeconds(0);e.setMilliseconds(0);return e}function S(e,t){return t?E(new Date(+e)):new Date(+e)}function x(){var e=0,t;do t=new Date(1970,e++,1);while(t.getHours());return t}function T(e,t,n){t=t||1;while(!e.getDay()||n&&e.getDay()==1||!n&&e.getDay()==6)y(e,t);return e}function N(e,t){return Math.round((S(e,!0)-S(t,!0))/p)}function C(e,n,r,i){if(n!==t&&n!=e.getFullYear()){e.setDate(1);e.setMonth(0);e.setFullYear(n)}if(r!==t&&r!=e.getMonth()){e.setDate(1);e.setMonth(r)}i!==t&&e.setDate(i)}function k(e,n){if(typeof e=="object")return e;if(typeof e=="number")return new Date(e*1e3);if(typeof e=="string"){if(e.match(/^\d+(\.\d+)?$/))return new Date(parseFloat(e)*1e3);n===t&&(n=!0);return L(e,n)||(e?new Date(e):null)}return null}function L(e,t){var n=e.match(/^([0-9]{4})(-([0-9]{2})(-([0-9]{2})([T ]([0-9]{2}):([0-9]{2})(:([0-9]{2})(\.([0-9]+))?)?(Z|(([-+])([0-9]{2})(:?([0-9]{2}))?))?)?)?)?$/);if(!n)return null;var r=new Date(n[1],0,1);if(t||!n[13]){var i=new Date(n[1],0,1,9,0);if(n[3]){r.setMonth(n[3]-1);i.setMonth(n[3]-1)}if(n[5]){r.setDate(n[5]);i.setDate(n[5])}b(r,i);n[7]&&r.setHours(n[7]);n[8]&&r.setMinutes(n[8]);n[10]&&r.setSeconds(n[10]);n[12]&&r.setMilliseconds(Number("0."+n[12])*1e3);b(r,i)}else{r.setUTCFullYear(n[1],n[3]?n[3]-1:0,n[5]||1);r.setUTCHours(n[7]||0,n[8]||0,n[10]||0,n[12]?Number("0."+n[12])*1e3:0);if(n[14]){var s=Number(n[16])*60+(n[18]?Number(n[18]):0);s*=n[15]=="-"?1:-1;r=new Date(+r+s*60*1e3)}}return r}function A(e){if(typeof e=="number")return e*60;if(typeof e=="object")return e.getHours()*60+e.getMinutes();var t=e.match(/(\d+)(?::(\d+))?\s*(\w+)?/);if(t){var n=parseInt(t[1],10);if(t[3]){n%=12;t[3].toLowerCase().charAt(0)=="p"&&(n+=12)}return n*60+(t[2]?parseInt(t[2],10):0)}}function O(e,t,n){return M(e,null,t,n)}function M(e,t,r,i){i=i||n;var s=e,o=t,u,a=r.length,f,l,c,h="";for(u=0;u<a;u++){f=r.charAt(u);if(f=="'"){for(l=u+1;l<a;l++)if(r.charAt(l)=="'"){if(s){l==u+1?h+="'":h+=r.substring(u+1,l);u=l}break}}else if(f=="("){for(l=u+1;l<a;l++)if(r.charAt(l)==")"){var p=O(s,r.substring(u+1,l),i);parseInt(p.replace(/\D/,""),10)&&(h+=p);u=l;break}}else if(f=="["){for(l=u+1;l<a;l++)if(r.charAt(l)=="]"){var d=r.substring(u+1,l),p=O(s,d,i);p!=O(o,d,i)&&(h+=p);u=l;break}}else if(f=="{"){s=t;o=e}else if(f=="}"){s=e;o=t}else{for(l=a;l>u;l--)if(c=_[r.substring(u,l)]){s&&(h+=c(s,i));u=l-1;break}l==u&&s&&(h+=f)}}return h}function D(e){return e.end?P(e.end,e.allDay):y(S(e.start),1)}function P(e,t){e=S(e);return t||e.getHours()||e.getMinutes()?y(e,1):E(e)}function H(e,t){return(t.msLength-e.msLength)*100+(e.event.start-t.event.start)}function B(e,t){return e.end>t.start&&e.start<t.end}function j(e,t,n,r){var i=[],s,o=e.length,u,a,f,l,c,h,p;for(s=0;s<o;s++){u=e[s];a=u.start;f=t[s];if(f>n&&a<r){if(a<n){l=S(n);h=!1}else{l=a;h=!0}if(f>r){c=S(r);p=!1}else{c=f;p=!0}i.push({event:u,start:l,end:c,isStart:h,isEnd:p,msLength:c-l})}}return i.sort(H)}function F(e){var t=[],n,r=e.length,i,s,o,u;for(n=0;n<r;n++){i=e[n];s=0;for(;;){o=!1;if(t[s])for(u=0;u<t[s].length;u++)if(B(t[s][u],i)){o=!0;break}if(!o)break;s++}t[s]?t[s].push(i):t[s]=[i]}return t}function I(n,r,i){n.unbind("mouseover").mouseover(function(n){var s=n.target,o,u,a;while(s!=this){o=s;s=s.parentNode}if((u=o._fci)!==t){o._fci=t;a=r[u];i(a.event,a.element,a);e(n.target).trigger(n)}n.stopPropagation()})}function q(t,n,r){for(var i=0,s;i<t.length;i++){s=e(t[i]);s.width(Math.max(0,n-U(s,r)))}}function R(t,n,r){for(var i=0,s;i<t.length;i++){s=e(t[i]);s.height(Math.max(0,n-V(s,r)))}}function U(e,t){return z(e)+X(e)+(t?W(e):0)}function z(t){return(parseFloat(e.css(t[0],"paddingLeft",!0))||0)+(parseFloat(e.css(t[0],"paddingRight",!0))||0)}function W(t){return(parseFloat(e.css(t[0],"marginLeft",!0))||0)+(parseFloat(e.css(t[0],"marginRight",!0))||0)}function X(t){return(parseFloat(e.css(t[0],"borderLeftWidth",!0))||0)+(parseFloat(e.css(t[0],"borderRightWidth",!0))||0)}function V(e,t){return $(e)+K(e)+(t?J(e):0)}function $(t){return(parseFloat(e.css(t[0],"paddingTop",!0))||0)+(parseFloat(e.css(t[0],"paddingBottom",!0))||0)}function J(t){return(parseFloat(e.css(t[0],"marginTop",!0))||0)+(parseFloat(e.css(t[0],"marginBottom",!0))||0)}function K(t){return(parseFloat(e.css(t[0],"borderTopWidth",!0))||0)+(parseFloat(e.css(t[0],"borderBottomWidth",!0))||0)}function Q(e,t){t=typeof t=="number"?t+"px":t;e.each(function(e,n){n.style.cssText+=";min-height:"+t+";_height:"+t})}function G(){}function Y(e,t){return e-t}function Z(e){return Math.max.apply(Math,e)}function et(e){return(e<10?"0":"")+e}function tt(e,n){if(e[n]!==t)return e[n];var r=n.split(/(?=[A-Z])/),i=r.length-1,s;for(;i>=0;i--){s=e[r[i].toLowerCase()];if(s!==t)return s}return e[""]}function nt(e){return e.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/'/g,"&#039;").replace(/"/g,"&quot;").replace(/\n/g,"<br />")}function rt(e){return e.id+"/"+e.className+"/"+e.style.cssText.replace(/(^|;)\s*(top|left|width|height)\s*:[^;]*/ig,"")}function it(e){e.attr("unselectable","on").css("MozUserSelect","none").bind("selectstart.ui",function(){return!1})}function st(e){e.children().removeClass("fc-first fc-last").filter(":first-child").addClass("fc-first").end().filter(":last-child").addClass("fc-last")}function ot(e,t){e.each(function(e,n){n.className=n.className.replace(/^fc-\w*/,"fc-"+h[t.getDay()])})}function ut(e,t){var n=e.source||{},r=e.color,i=n.color,s=t("eventColor"),o=e.backgroundColor||r||n.backgroundColor||i||t("eventBackgroundColor")||s,u=e.borderColor||r||n.borderColor||i||t("eventBorderColor")||s,a=e.textColor||n.textColor||t("eventTextColor"),f=[];o&&f.push("background-color:"+o);u&&f.push("border-color:"+u);a&&f.push("color:"+a);return f.join(";")}function at(t,n,r){e.isFunction(t)&&(t=[t]);if(t){var i,s;for(i=0;i<t.length;i++)s=t[i].apply(n,r)||s;return s}}function ft(){for(var e=0;e<arguments.length;e++)if(arguments[e]!==t)return arguments[e]}function lt(e,t){function o(e,t){if(t){g(e,t);e.setDate(1)}var o=S(e,!0);o.setDate(1);var u=g(S(o),1),a=S(o),f=S(u),l=r("firstDay"),c=r("weekends")?0:1;if(c){T(a);T(f,-1,!0)}y(a,-((a.getDay()-Math.max(l,c)+7)%7));y(f,(7-f.getDay()+Math.max(l,c))%7);var h=Math.round((f-a)/(p*7));if(r("weekMode")=="fixed"){y(f,(6-h)*7);h=6}n.title=s(o,r("titleFormat"));n.start=o;n.end=u;n.visStart=a;n.visEnd=f;i(6,h,c?5:7,!0)}var n=this;n.render=o;pt.call(n,e,t,"month");var r=n.opt,i=n.renderBasic,s=t.formatDate}function ct(e,t){function o(e,t){t&&y(e,t*7);var o=y(S(e),-((e.getDay()-r("firstDay")+7)%7)),u=y(S(o),7),a=S(o),f=S(u),l=r("weekends");if(!l){T(a);T(f,-1,!0)}n.title=s(a,y(S(f),-1),r("titleFormat"));n.start=o;n.end=u;n.visStart=a;n.visEnd=f;i(1,1,l?7:5,!1)}var n=this;n.render=o;pt.call(n,e,t,"basicWeek");var r=n.opt,i=n.renderBasic,s=t.formatDates}function ht(e,t){function o(e,t){if(t){y(e,t);r("weekends")||T(e,t<0?-1:1)}n.title=s(e,r("titleFormat"));n.start=n.visStart=S(e,!0);n.end=n.visEnd=y(S(n.start),1);i(1,1,1,!1)}var n=this;n.render=o;pt.call(n,e,t,"basicDay");var r=n.opt,i=n.renderBasic,s=t.formatDate}function pt(t,n,r){function I(e,t,n,r){k=t;L=n;R();var i=!d;i?U(e,r):u();z(i)}function R(){_=s("isRTL");if(_){D=-1;P=L-1}else{D=1;P=0}H=s("firstDay");B=s("weekends")?0:1;j=s("theme")?"ui":"fc";F=s("columnFormat")}function U(n,r){var i,s=j+"-widget-header",o=j+"-widget-content",u,a,f;i="<table class='fc-border-separate' style='width:100%' cellspacing='0'><thead><tr>";for(u=0;u<L;u++)i+="<th class='fc- "+s+"'/>";i+="</tr></thead><tbody>";for(u=0;u<n;u++){i+="<tr class='fc-week"+u+"'>";for(a=0;a<L;a++)i+="<td class='fc- "+o+" fc-day"+(u*L+a)+"'>"+"<div>"+(r?"<div class='fc-day-number'/>":"")+"<div class='fc-day-content'>"+"<div style='position:relative'>&nbsp;</div>"+"</div>"+"</div>"+"</td>";i+="</tr>"}i+="</tbody></table>";f=e(i).appendTo(t);h=f.find("thead");p=h.find("th");d=f.find("tbody");v=d.find("tr");m=d.find("td");g=m.filter(":first-child");b=v.eq(0).find("div.fc-day-content div");st(h.add(h.find("tr")));st(v);v.eq(0).addClass("fc-first");$(m);w=e("<div style='position:absolute;z-index:8;top:0;left:0'/>").appendTo(t)}function z(t){var n=t||k==1,r=i.start.getMonth(),s=E(new Date),o,u,a;n&&p.each(function(t,n){o=e(n);u=pt(t);o.html(c(u,F));ot(o,u)});m.each(function(t,i){o=e(i);u=pt(t);u.getMonth()==r?o.removeClass("fc-other-month"):o.addClass("fc-other-month");+u==+s?o.addClass(j+"-state-highlight fc-today"):o.removeClass(j+"-state-highlight fc-today");o.find("div.fc-day-number").text(u.getDate());n&&ot(o,u)});v.each(function(t,n){a=e(n);if(t<k){a.show();t==k-1?a.addClass("fc-last"):a.removeClass("fc-last")}else a.hide()})}function W(t){T=t;var n=T-h.height(),r,i,o;if(s("weekMode")=="variable")r=i=Math.floor(n/(k==1?2:6));else{r=Math.floor(n/k);i=n-r*(k-1)}g.each(function(t,n){if(t<k){o=e(n);Q(o.find("> div"),(t==k-1?i:r)-V(o))}})}function X(e){x=e;M.clear();C=Math.floor(x/L);q(p.slice(0,-1),C)}function $(e){e.click(J).mousedown(l)}function J(e){if(!s("selectable")){var t=parseInt(this.className.match(/fc\-day(\d+)/)[1]),n=pt(t);o("dayClick",this,n,!0,e)}}function K(e,t,n){n&&A.build();var r=S(i.visStart),s=y(S(r),L);for(var o=0;o<k;o++){var u=new Date(Math.max(r,e)),a=new Date(Math.min(s,t));if(u<a){var f,l;if(_){f=N(a,r)*D+P+1;l=N(u,r)*D+P+1}else{f=N(u,r);l=N(a,r)}$(G(o,f,o,l-1))}y(r,7);y(s,7)}}function G(e,n,r,i){var s=A.rect(e,n,r,i,t);return a(s,t)}function Y(e,t){return S(e)}function Z(e,t,n){K(e,y(S(t),1),!0)}function et(){f()}function tt(e,t,n){var r=lt(e),i=m[r.row*L+r.col];o("dayClick",i,e,t,n)}function nt(e,t,n){O.start(function(e){f();e&&G(e.row,e.col,e.row,e.col)},t)}function rt(e,t,n){var r=O.stop();f();if(r){var i=ct(r);o("drop",e,i,!0,t,n)}}function ut(e){return S(e.start)}function at(e){return M.left(e)}function ft(e){return M.right(e)}function lt(e){return{row:Math.floor(N(e,i.visStart)/7),col:vt(e.getDay())}}function ct(e){return ht(e.row,e.col)}function ht(e,t){return y(S(i.visStart),e*7+t*D+P)}function pt(e){return ht(Math.floor(e/L),e%L)}function vt(e){return(e-Math.max(H,B)+L)%L*D+P}function mt(e){return v.eq(e)}function gt(e){return{left:0,right:x}}var i=this;i.renderBasic=I;i.setHeight=W;i.setWidth=X;i.renderDayOverlay=K;i.defaultSelectionEnd=Y;i.renderSelection=Z;i.clearSelection=et;i.reportDayClick=tt;i.dragStart=nt;i.dragStop=rt;i.defaultEventEnd=ut;i.getHoverListener=function(){return O};i.colContentLeft=at;i.colContentRight=ft;i.dayOfWeekCol=vt;i.dateCell=lt;i.cellDate=ct;i.cellIsAllDay=function(){return!0};i.allDayRow=mt;i.allDayBounds=gt;i.getRowCnt=function(){return k};i.getColCnt=function(){return L};i.getColWidth=function(){return C};i.getDaySegmentContainer=function(){return w};wt.call(i,t,n,r);xt.call(i);St.call(i);dt.call(i);var s=i.opt,o=i.trigger,u=i.clearEvents,a=i.renderOverlay,f=i.clearOverlays,l=i.daySelectionMousedown,c=n.formatDate,h,p,d,v,m,g,b,w,x,T,C,k,L,A,O,M,_,D,P,H,B,j,F;it(t.addClass("fc-grid"));A=new Tt(function(t,n){var r,i,s;p.each(function(t,o){r=e(o);i=r.offset().left;t&&(s[1]=i);s=[i];n[t]=s});s[1]=i+r.outerWidth();v.each(function(n,o){if(n<k){r=e(o);i=r.offset().top;n&&(s[1]=i);s=[i];t[n]=s}});s[1]=i+r.outerHeight()});O=new Nt(A);M=new kt(function(e){return b.eq(e)})}function dt(){function E(e,t){o(e);b(T(e),t)}function x(){u();h().empty()}function T(n){var r=m(),i=g(),s=S(t.visStart),o=y(S(s),i),u=e.map(n,D),a,f,l,c,h,p,d=[];for(a=0;a<r;a++){f=F(j(n,u,s,o));for(l=0;l<f.length;l++){c=f[l];for(h=0;h<c.length;h++){p=c[h];p.row=a;p.level=l;d.push(p)}}y(s,7);y(o,7)}return d}function N(e,t,n){i(e)&&C(e,t);n.isEnd&&s(e)&&w(e,t,n);a(e,t)}function C(e,t){var i=p(),s;t.draggable({zIndex:9,delay:50,opacity:n("dragOpacity"),revertDuration:n("dragRevertDuration"),start:function(o,u){r("eventDragStart",t,e,o,u);l(e,t);i.start(function(r,i,o,u){t.draggable("option","revert",!r||!o&&!u);v();if(r){s=o*7+u*(n("isRTL")?-1:1);d(y(S(e.start),s),y(D(e),s))}else s=0},o,"drag")},stop:function(n,o){i.stop();v();r("eventDragStop",t,e,n,o);if(s)c(this,e,s,0,e.allDay,n,o);else{t.css("filter","");f(e,t)}}})}var t=this;t.renderEvents=E;t.compileDaySegs=T;t.clearEvents=x;t.bindDaySeg=N;Et.call(t);var n=t.opt,r=t.trigger,i=t.isEventDraggable,s=t.isEventResizable,o=t.reportEvents,u=t.reportEventClear,a=t.eventElementHandlers,f=t.showEvents,l=t.hideEvents,c=t.eventDrop,h=t.getDaySegmentContainer,p=t.getHoverListener,d=t.renderDayOverlay,v=t.clearOverlays,m=t.getRowCnt,g=t.getColCnt,b=t.renderDaySegs,w=t.resizableDayEvent}function vt(e,t){function o(e,t){t&&y(e,t*7);var o=y(S(e),-((e.getDay()-r("firstDay")+7)%7)),u=y(S(o),7),a=S(o),f=S(u),l=r("weekends");if(!l){T(a);T(f,-1,!0)}n.title=s(a,y(S(f),-1),r("titleFormat"));n.start=o;n.end=u;n.visStart=a;n.visEnd=f;i(l?7:5)}var n=this;n.render=o;gt.call(n,e,t,"agendaWeek");var r=n.opt,i=n.renderAgenda,s=t.formatDates}function mt(e,t){function o(e,t){if(t){y(e,t);r("weekends")||T(e,t<0?-1:1)}var o=S(e,!0),u=y(S(o),1);n.title=s(e,r("titleFormat"));n.start=n.visStart=o;n.end=n.visEnd=u;i(1)}var n=this;n.render=o;gt.call(n,e,t,"agendaDay");var r=n.opt,i=n.renderAgenda,s=t.formatDate}function gt(n,r,i){function bt(e){et=e;Et();m?a():Ct();Lt()}function Et(){ft=o("theme")?"ui":"fc";ct=o("weekends")?0:1;lt=o("firstDay");if(ht=o("isRTL")){pt=-1;dt=et-1}else{pt=1;dt=0}vt=A(o("minTime"));mt=A(o("maxTime"));gt=o("columnFormat")}function Ct(){var t=ft+"-widget-header",r=ft+"-widget-content",i,s,u,a,f,l=o("slotMinutes")%15==0;i="<table style='width:100%' class='fc-agenda-days fc-border-separate' cellspacing='0'><thead><tr><th class='fc-agenda-axis "+t+"'>&nbsp;</th>";for(s=0;s<et;s++)i+="<th class='fc- fc-col"+s+" "+t+"'/>";i+="<th class='fc-agenda-gutter "+t+"'>&nbsp;</th>"+"</tr>"+"</thead>"+"<tbody>"+"<tr>"+"<th class='fc-agenda-axis "+t+"'>&nbsp;</th>";for(s=0;s<et;s++)i+="<td class='fc- fc-col"+s+" "+r+"'>"+"<div>"+"<div class='fc-day-content'>"+"<div style='position:relative'>&nbsp;</div>"+"</div>"+"</div>"+"</td>";i+="<td class='fc-agenda-gutter "+r+"'>&nbsp;</td>"+"</tr>"+"</tbody>"+"</table>";m=e(i).appendTo(n);g=m.find("thead");b=g.find("th").slice(1,-1);T=m.find("tbody");C=T.find("td").slice(0,-1);k=C.find("div.fc-day-content div");L=C.eq(0);O=L.find("> div");st(g.add(g.find("tr")));st(T.add(T.find("tr")));U=g.find("th:first");z=m.find(".fc-agenda-gutter");M=e("<div style='position:absolute;z-index:2;left:0;width:100%'/>").appendTo(n);if(o("allDaySlot")){_=e("<div style='position:absolute;z-index:8;top:0;left:0'/>").appendTo(M);i="<table style='width:100%' class='fc-agenda-allday' cellspacing='0'><tr><th class='"+t+" fc-agenda-axis'>"+o("allDayText")+"</th>"+"<td>"+"<div class='fc-day-content'><div style='position:relative'/></div>"+"</td>"+"<th class='"+t+" fc-agenda-gutter'>&nbsp;</th>"+"</tr>"+"</table>";D=e(i).appendTo(M);P=D.find("tr");Pt(P.find("td"));U=U.add(D.find("th:first"));z=z.add(D.find("th.fc-agenda-gutter"));M.append("<div class='fc-agenda-divider "+t+"'>"+"<div class='fc-agenda-divider-inner'/>"+"</div>")}else _=e([]);H=e("<div style='position:absolute;width:100%;overflow-x:hidden;overflow-y:auto'/>").appendTo(M);B=e("<div style='position:relative;width:100%;overflow:hidden'/>").appendTo(H);j=e("<div style='position:absolute;z-index:8;top:0;left:0'/>").appendTo(B);i="<table class='fc-agenda-slots' style='width:100%' cellspacing='0'><tbody>";u=x();a=w(S(u),mt);w(u,vt);tt=0;for(s=0;u<a;s++){f=u.getMinutes();i+="<tr class='fc-slot"+s+" "+(f?"fc-minor":"")+"'>"+"<th class='fc-agenda-axis "+t+"'>"+(!l||!f?v(u,o("axisFormat")):"&nbsp;")+"</th>"+"<td class='"+r+"'>"+"<div style='position:relative'>&nbsp;</div>"+"</td>"+"</tr>";w(u,o("slotMinutes"));tt++}i+="</tbody></table>";F=e(i).appendTo(B);I=F.find("div:first");Ht(F.find("td"));U=U.add(F.find("th:first"))}function Lt(){var e,t,n,r,i=E(new Date);for(e=0;e<et;e++){r=Wt(e);t=b.eq(e);t.html(v(r,gt));n=C.eq(e);+r==+i?n.addClass(ft+"-state-highlight fc-today"):n.removeClass(ft+"-state-highlight fc-today");ot(t.add(n),r)}}function At(e,n){e===t&&(e=$);$=e;at={};var r=T.position().top,i=H.position().top,s=Math.min(e-r,F.height()+i+1);O.height(s-V(L));M.css("top",r);H.height(s-i-1);G=I.height()+1;n&&Mt()}function Ot(t){X=t;ut.clear();J=0;q(U.width("").each(function(t,n){J=Math.max(J,e(n).outerWidth())}),J);var n=H[0].clientWidth;Q=H.width()-n;if(Q){q(z,Q);z.show().prev().removeClass("fc-last")}else z.hide().prev().addClass("fc-last");K=Math.floor((n-J)/et);q(b.slice(0,-1),K)}function Mt(){function r(){H.scrollTop(n)}var e=x(),t=S(e);t.setHours(o("firstHour"));var n=$t(e,t)+1;r();setTimeout(r,0)}function _t(){Z=H.scrollTop()}function Dt(){H.scrollTop(Z)}function Pt(e){e.click(Bt).mousedown(p)}function Ht(e){e.click(Bt).mousedown(tn)}function Bt(e){if(!o("selectable")){var t=Math.min(et-1,Math.floor((e.pageX-m.offset().left-J)/K)),n=Wt(t),r=this.parentNode.className.match(/fc-slot(\d+)/);if(r){var i=parseInt(r[1])*o("slotMinutes"),s=Math.floor(i/60);n.setHours(s);n.setMinutes(i%60+vt);u("dayClick",C[t],n,!1,e)}else u("dayClick",C[t],n,!0,e)}}function jt(e,t,n){n&&nt.build();var r=S(s.visStart),i,o;if(ht){i=N(t,r)*pt+dt+1;o=N(e,r)*pt+dt+1}else{i=N(e,r);o=N(t,r)}i=Math.max(0,i);o=Math.min(et,o);i<o&&Pt(Ft(0,i,0,o-1))}function Ft(e,t,n,r){var i=nt.rect(e,t,n,r,M);return f(i,M)}function It(e,t){var n=S(s.visStart),r=y(S(n),1);for(var i=0;i<et;i++){var o=new Date(Math.max(n,e)),u=new Date(Math.min(r,t));if(o<u){var a=i*pt+dt,l=nt.rect(0,a,0,a,B),c=$t(n,o),h=$t(n,u);l.top=c;l.height=h-c;Ht(f(l,B))}y(n,1);y(r,1)}}function qt(e){return ut.left(e)}function Rt(e){return ut.right(e)}function Ut(e){return{row:Math.floor(N(e,s.visStart)/7),col:Vt(e.getDay())}}function zt(e){var t=Wt(e.col),n=e.row;o("allDaySlot")&&n--;n>=0&&w(t,vt+n*o("slotMinutes"));return t}function Wt(e){return y(S(s.visStart),e*pt+dt)}function Xt(e){return o("allDaySlot")&&!e.row}function Vt(e){return(e-Math.max(lt,ct)+et)%et*pt+dt}function $t(e,n){e=S(e,!0);if(n<w(S(e),vt))return 0;if(n>=w(S(e),mt))return F.height();var r=o("slotMinutes"),i=n.getHours()*60+n.getMinutes()-vt,s=Math.floor(i/r),u=at[s];u===t&&(u=at[s]=F.find("tr:eq("+s+") td div")[0].offsetTop);return Math.max(0,Math.round(u-1+G*(i%r/r)))}function Jt(){return{left:J,right:X-Q}}function Kt(e){return P}function Qt(e){var t=S(e.start);return e.allDay?t:w(t,o("defaultEventMinutes"))}function Gt(e,t){return t?S(e):w(S(e),o("slotMinutes"))}function Yt(e,t,n){n?o("allDaySlot")&&jt(e,y(S(t),1),!0):Zt(e,t)}function Zt(t,n){var r=o("selectHelper");nt.build();if(r){var i=N(t,s.visStart)*pt+dt;if(i>=0&&i<et){var u=nt.rect(0,i,0,i,B),a=$t(t,t),f=$t(t,n);if(f>a){u.top=a;u.height=f-a;u.left+=2;u.width-=5;if(e.isFunction(r)){var l=r(t,n);if(l){u.position="absolute";u.zIndex=8;W=e(l).css(u).appendTo(B)}}else{u.isStart=!0;u.isEnd=!0;W=e(d({title:"",start:t,end:n,className:["fc-select-helper"],editable:!1},u));W.css("opacity",o("dragOpacity"))}if(W){Ht(W);B.append(W);q(W,u.width,!0);R(W,u.height,!0)}}}}else It(t,n)}function en(){l();if(W){W.remove();W=null}}function tn(t){if(t.which==1&&o("selectable")){h(t);var n;rt.start(function(e,t){en();if(e&&e.col==t.col&&!Xt(e)){var r=zt(t),i=zt(e);n=[r,w(S(r),o("slotMinutes")),i,w(S(i),o("slotMinutes"))].sort(Y);Zt(n[0],n[3])}else n=null},t);e(document).one("mouseup",function(e){rt.stop();if(n){+n[0]==+n[1]&&nn(n[0],!1,e);c(n[0],n[3],!1,e)}})}}function nn(e,t,n){u("dayClick",C[Vt(e.getDay())],e,t,n)}function rn(e,t,n){rt.start(function(e){l();if(e)if(Xt(e))Ft(e.row,e.col,e.row,e.col);else{var t=zt(e),n=w(S(t),o("defaultEventMinutes"));It(t,n)}},t)}function sn(e,t,n){var r=rt.stop();l();r&&u("drop",e,zt(r),Xt(r),t,n)}var s=this;s.renderAgenda=bt;s.setWidth=Ot;s.setHeight=At;s.beforeHide=_t;s.afterShow=Dt;s.defaultEventEnd=Qt;s.timePosition=$t;s.dayOfWeekCol=Vt;s.dateCell=Ut;s.cellDate=zt;s.cellIsAllDay=Xt;s.allDayRow=Kt;s.allDayBounds=Jt;s.getHoverListener=function(){return rt};s.colContentLeft=qt;s.colContentRight=Rt;s.getDaySegmentContainer=function(){return _};s.getSlotSegmentContainer=function(){return j};s.getMinMinute=function(){return vt};s.getMaxMinute=function(){return mt};s.getBodyContent=function(){return B};s.getRowCnt=function(){return 1};s.getColCnt=function(){return et};s.getColWidth=function(){return K};s.getSlotHeight=function(){return G};s.defaultSelectionEnd=Gt;s.renderDayOverlay=jt;s.renderSelection=Yt;s.clearSelection=en;s.reportDayClick=nn;s.dragStart=rn;s.dragStop=sn;wt.call(s,n,r,i);xt.call(s);St.call(s);yt.call(s);var o=s.opt,u=s.trigger,a=s.clearEvents,f=s.renderOverlay,l=s.clearOverlays,c=s.reportSelection,h=s.unselect,p=s.daySelectionMousedown,d=s.slotSegHtml,v=r.formatDate,m,g,b,T,C,k,L,O,M,_,D,P,H,B,j,F,I,U,z,W,X,$,J,K,Q,G,Z,et,tt,nt,rt,ut,at={},ft,lt,ct,ht,pt,dt,vt,mt,gt;it(n.addClass("fc-agenda"));nt=new Tt(function(t,n){function l(e){return Math.max(a,Math.min(f,e))}var r,i,s;b.each(function(t,o){r=e(o);i=r.offset().left;t&&(s[1]=i);s=[i];n[t]=s});s[1]=i+r.outerWidth();if(o("allDaySlot")){r=P;i=r.offset().top;t[0]=[i,i+r.outerHeight()]}var u=B.offset().top,a=H.offset().top,f=a+H.outerHeight();for(var c=0;c<tt;c++)t.push([l(u+G*c),l(u+G*(c+1))])});rt=new Nt(nt);ut=new kt(function(e){return k.eq(e)})}function yt(){function $(e,t){a(e);var n,i=e.length,s=[],o=[];for(n=0;n<i;n++)e[n].allDay?s.push(e[n]):o.push(e[n]);if(r("allDaySlot")){T(K(s),t);c()}Y(Q(o),t)}function J(){f();h().empty();p().empty()}function K(t){var r=F(j(t,e.map(t,D),n.visStart,n.visEnd)),i,s=r.length,o,u,a,f=[];for(i=0;i<s;i++){o=r[i];for(u=0;u<o.length;u++){a=o[u];a.row=0;a.level=i;f.push(a)}}return f}function Q(t){var r=C(),i=g(),s=m(),o=w(S(n.visStart),i),u=e.map(t,G),a,f,l,c,h,p,d=[];for(a=0;a<r;a++){f=F(j(t,u,o,w(S(o),s-i)));bt(f);for(l=0;l<f.length;l++){c=f[l];for(h=0;h<c.length;h++){p=c[h];p.col=a;p.level=l;d.push(p)}}y(o,1,!0)}return d}function G(e){return e.end?S(e.end):w(S(e.start),r("defaultEventMinutes"))}function Y(n,s){var o,u=n.length,a,f,l,c,h,d,v,m,g,y,w,S,T="",N,k,L,A={},M={},_,D,P,H,B=p(),j,F,q,R=C();if(j=r("isRTL")){F=-1;q=R-1}else{F=1;q=0}for(o=0;o<u;o++){a=n[o];f=a.event;c=b(a.start,a.start);h=b(a.start,a.end);d=a.col;v=a.level;m=a.forward||0;g=E(d*F+q);y=x(d*F+q)-g;y=Math.min(y-6,y*.95);v?w=y/(v+m+1):m?w=(y/(m+1)-6)*2:w=y;S=g+y/(v+m+1)*v*F+(j?y-w:0);a.top=c;a.left=S;a.outerWidth=w;a.outerHeight=h-c;T+=Z(f,a)}B[0].innerHTML=T;N=B.children();for(o=0;o<u;o++){a=n[o];f=a.event;k=e(N[o]);L=i("eventRender",f,f,k);if(L===!1)k.remove();else{if(L&&L!==!0){k.remove();k=e(L).css({position:"absolute",top:a.top,left:a.left}).appendTo(B)}a.element=k;f._id===s?tt(f,k,a):k[0]._fci=o;O(f,k)}}I(B,n,tt);for(o=0;o<u;o++){a=n[o];if(k=a.element){D=A[_=a.key=rt(k[0])];a.vsides=D===t?A[_]=V(k,!0):D;D=M[_];a.hsides=D===t?M[_]=U(k,!0):D;P=k.find("div.fc-event-content");P.length&&(a.contentTop=P[0].offsetTop)}}for(o=0;o<u;o++){a=n[o];if(k=a.element){k[0].style.width=Math.max(0,a.outerWidth-a.hsides)+"px";H=Math.max(0,a.outerHeight-a.vsides);k[0].style.height=H+"px";f=a.event;if(a.contentTop!==t&&H-a.contentTop<10){k.find("div.fc-event-time").text(W(f.start,r("timeFormat"))+" - "+f.title);k.find("div.fc-event-title").remove()}i("eventAfterRender",f,f,k)}}}function Z(e,t){var n="<",i=e.url,u=ut(e,r),a=u?" style='"+u+"'":"",f=["fc-event","fc-event-skin"
,"fc-event-vert"];s(e)&&f.push("fc-event-draggable");t.isStart&&f.push("fc-corner-top");t.isEnd&&f.push("fc-corner-bottom");f=f.concat(e.className);e.source&&(f=f.concat(e.source.className||[]));i?n+="a href='"+nt(e.url)+"'":n+="div";n+=" class='"+f.join(" ")+"'"+" style='position:absolute;z-index:8;top:"+t.top+"px;left:"+t.left+"px;"+u+"'"+">"+"<div class='fc-event-inner fc-event-skin'"+a+">"+"<div class='fc-event-head fc-event-skin'"+a+">"+"<div class='fc-event-time'>"+nt(X(e.start,e.end,r("timeFormat")))+"</div>"+"</div>"+"<div class='fc-event-content'>"+"<div class='fc-event-title'>"+nt(e.title)+"</div>"+"</div>"+"<div class='fc-event-bg'></div>"+"</div>";t.isEnd&&o(e)&&(n+="<div class='ui-resizable-handle ui-resizable-s'>=</div>");n+="</"+(i?"a":"div")+">";return n}function et(e,t,n){s(e)&&it(e,t,n.isStart);n.isEnd&&o(e)&&N(e,t,n);l(e,t)}function tt(e,t,n){var r=t.find("div.fc-event-time");s(e)&&st(e,t,r);n.isEnd&&o(e)&&ot(e,t,r);l(e,t)}function it(e,t,n){function m(){if(!u){t.width(s).height("").draggable("option","grid",null);u=!0}}var s,o,u=!0,a,f=r("isRTL")?-1:1,l=d(),c=k(),h=L(),p=g();t.draggable({zIndex:9,opacity:r("dragOpacity","month"),revertDuration:r("dragRevertDuration"),start:function(p,d){i("eventDragStart",t,e,p,d);_(e,t);s=t.width();l.start(function(i,s,l,p){q();if(i){o=!1;a=p*f;if(!i.row){B(y(S(e.start),a),y(D(e),a));m()}else if(n){if(u){t.width(c-10);R(t,h*Math.round((e.end?(e.end-e.start)/v:r("defaultEventMinutes"))/r("slotMinutes")));t.draggable("option","grid",[c,1]);u=!1}}else o=!0;o=o||u&&!a}else{m();o=!0}t.draggable("option","revert",o)},p,"drag")},stop:function(n,s){l.stop();q();i("eventDragStop",t,e,n,s);if(o){m();t.css("filter","");M(e,t)}else{var f=0;u||(f=Math.round((t.offset().top-A().offset().top)/h)*r("slotMinutes")+p-(e.start.getHours()*60+e.start.getMinutes()));P(this,e,a,f,u,n,s)}}})}function st(e,t,n){function m(t){var i=w(S(e.start),t),s;e.end&&(s=w(S(e.end),t));n.text(X(i,s,r("timeFormat")))}function g(){if(o){n.css("display","");t.draggable("option","grid",[p,v]);o=!1}}var s,o=!1,u,a,f,l=r("isRTL")?-1:1,c=d(),h=C(),p=k(),v=L();t.draggable({zIndex:9,scroll:!1,grid:[p,v],axis:h==1?"y":!1,opacity:r("dragOpacity"),revertDuration:r("dragRevertDuration"),start:function(h,p){i("eventDragStart",t,e,h,p);_(e,t);s=t.position();a=f=0;c.start(function(i,s,a,f){t.draggable("option","revert",!i);q();if(i){u=f*l;if(r("allDaySlot")&&!i.row){if(!o){o=!0;n.hide();t.draggable("option","grid",null)}B(y(S(e.start),u),y(D(e),u))}else g()}},h,"drag")},drag:function(e,t){a=Math.round((t.position.top-s.top)/v)*r("slotMinutes");if(a!=f){o||m(a);f=a}},stop:function(n,r){var f=c.stop();q();i("eventDragStop",t,e,n,r);if(f&&(u||a||o))P(this,e,u,o?0:a,o,n,r);else{g();t.css("filter","");t.css(s);m(0);M(e,t)}}})}function ot(e,t,n){var s,o,a=L();t.resizable({handles:{s:"div.ui-resizable-s"},grid:a,start:function(n,r){s=o=0;_(e,t);t.css("z-index",9);i("eventResizeStart",this,e,n,r)},resize:function(i,f){s=Math.round((Math.max(a,t.height())-f.originalSize.height)/a);if(s!=o){n.text(X(e.start,!s&&!e.end?null:w(u(e),r("slotMinutes")*s),r("timeFormat")));o=s}},stop:function(n,o){i("eventResizeStop",this,e,n,o);if(s)H(this,e,0,r("slotMinutes")*s,n,o);else{t.css("z-index",8);M(e,t)}}})}var n=this;n.renderEvents=$;n.compileDaySegs=K;n.clearEvents=J;n.slotSegHtml=Z;n.bindDaySeg=et;Et.call(n);var r=n.opt,i=n.trigger,s=n.isEventDraggable,o=n.isEventResizable,u=n.eventEnd,a=n.reportEvents,f=n.reportEventClear,l=n.eventElementHandlers,c=n.setHeight,h=n.getDaySegmentContainer,p=n.getSlotSegmentContainer,d=n.getHoverListener,m=n.getMaxMinute,g=n.getMinMinute,b=n.timePosition,E=n.colContentLeft,x=n.colContentRight,T=n.renderDaySegs,N=n.resizableDayEvent,C=n.getColCnt,k=n.getColWidth,L=n.getSlotHeight,A=n.getBodyContent,O=n.reportEventElement,M=n.showEvents,_=n.hideEvents,P=n.eventDrop,H=n.eventResize,B=n.renderDayOverlay,q=n.clearOverlays,z=n.calendar,W=z.formatDate,X=z.formatDates}function bt(e){var t,n,r,i,s,o;for(t=e.length-1;t>0;t--){i=e[t];for(n=0;n<i.length;n++){s=i[n];for(r=0;r<e[t-1].length;r++){o=e[t-1][r];B(s,o)&&(o.forward=Math.max(o.forward||0,(s.forward||0)+1))}}}}function wt(e,n,r){function h(e,t){var n=c[e];return typeof n=="object"?tt(n,t||r):n}function p(e,t){return n.trigger.apply(n,[e,t||i].concat(Array.prototype.slice.call(arguments,2),[i]))}function d(e){return m(e)&&!h("disableDragging")}function v(e){return m(e)&&!h("disableResizing")}function m(e){return ft(e.editable,(e.source||{}).editable,h("editable"))}function g(e){a={};var t,n=e.length,r;for(t=0;t<n;t++){r=e[t];a[r._id]?a[r._id].push(r):a[r._id]=[r]}}function b(e){return e.end?S(e.end):s(e)}function E(e,t){f.push(t);l[e._id]?l[e._id].push(t):l[e._id]=[t]}function x(){f=[];l={}}function T(e,t){t.click(function(n){if(!t.hasClass("ui-draggable-dragging")&&!t.hasClass("ui-resizable-resizing"))return p("eventClick",this,e,n)}).hover(function(t){p("eventMouseover",this,e,t)},function(t){p("eventMouseout",this,e,t)})}function N(e,t){k(e,t,"show")}function C(e,t){k(e,t,"hide")}function k(e,t,n){var r=l[e._id],i,s=r.length;for(i=0;i<s;i++)(!t||r[i][0]!=t[0])&&r[i][n]()}function L(e,t,n,r,i,s,o){var f=t.allDay,l=t._id;O(a[l],n,r,i);p("eventDrop",e,t,n,r,i,function(){O(a[l],-n,-r,f);u(l)},s,o);u(l)}function A(e,t,n,r,i,s){var o=t._id;M(a[o],n,r);p("eventResize",e,t,n,r,function(){M(a[o],-n,-r);u(o)},i,s);u(o)}function O(e,n,r,i){r=r||0;for(var s,u=e.length,a=0;a<u;a++){s=e[a];i!==t&&(s.allDay=i);w(y(s.start,n,!0),r);s.end&&(s.end=w(y(s.end,n,!0),r));o(s,c)}}function M(e,t,n){n=n||0;for(var r,i=e.length,s=0;s<i;s++){r=e[s];r.end=w(y(b(r),t,!0),n);o(r,c)}}var i=this;i.element=e;i.calendar=n;i.name=r;i.opt=h;i.trigger=p;i.isEventDraggable=d;i.isEventResizable=v;i.reportEvents=g;i.eventEnd=b;i.reportEventElement=E;i.reportEventClear=x;i.eventElementHandlers=T;i.showEvents=N;i.hideEvents=C;i.eventDrop=L;i.eventResize=A;var s=i.defaultEventEnd,o=n.normalizeEvent,u=n.reportEventChange,a={},f=[],l={},c=n.options}function Et(){function O(e,t){var n=T(),r,i=h(),s=p(),o=0,u,a,f,l,c=e.length,d,v,m;n[0].innerHTML=_(e);D(e,n.children());P(e);H(e,n,t);B(e);j(e);F(e);r=q();for(u=0;u<i;u++){a=0;f=[];for(l=0;l<s;l++)f[l]=0;while(o<c&&(d=e[o]).row==u){v=Z(f.slice(d.startCol,d.endCol));d.top=v;v+=d.outerHeight;for(m=d.startCol;m<d.endCol;m++)f[m]=v;o++}r[u].height(Z(f))}z(e,R(r))}function M(t,n,r){var i=e("<div/>"),s,o=T(),u,a=t.length,f;i[0].innerHTML=_(t);s=i.children();o.append(s);D(t,s);B(t);j(t);F(t);z(t,R(q()));s=[];for(u=0;u<a;u++){f=t[u].element;if(f){t[u].row===n&&f.css("top",r);s.push(f[0])}}return e(s)}function _(e){var t=r("isRTL"),n,i=e.length,u,a,f,l,c=m(),h=c.left,p=c.right,d,v,y,E,S,x="";for(n=0;n<i;n++){u=e[n];a=u.event;l=["fc-event","fc-event-skin","fc-event-hori"];s(a)&&l.push("fc-event-draggable");if(t){u.isStart&&l.push("fc-corner-right");u.isEnd&&l.push("fc-corner-left");d=w(u.end.getDay()-1);v=w(u.start.getDay());y=u.isEnd?g(d):h;E=u.isStart?b(v):p}else{u.isStart&&l.push("fc-corner-left");u.isEnd&&l.push("fc-corner-right");d=w(u.start.getDay());v=w(u.end.getDay()-1);y=u.isStart?g(d):h;E=u.isEnd?b(v):p}l=l.concat(a.className);a.source&&(l=l.concat(a.source.className||[]));f=a.url;S=ut(a,r);f?x+="<a href='"+nt(f)+"'":x+="<div";x+=" class='"+l.join(" ")+"'"+" style='position:absolute;z-index:8;left:"+y+"px;"+S+"'"+">"+"<div"+" class='fc-event-inner fc-event-skin'"+(S?" style='"+S+"'":"")+">";!a.allDay&&u.isStart&&(x+="<span class='fc-event-time'>"+nt(C(a.start,a.end,r("timeFormat")))+"</span>");x+="<span class='fc-event-title'>"+nt(a.title)+"</span>"+"</div>";u.isEnd&&o(a)&&(x+="<div class='ui-resizable-handle ui-resizable-"+(t?"w":"e")+"'>"+"&nbsp;&nbsp;&nbsp;"+"</div>");x+="</"+(f?"a":"div")+">";u.left=y;u.outerWidth=E-y;u.startCol=d;u.endCol=v+1}return x}function D(t,n){var r,s=t.length,o,u,a,f;for(r=0;r<s;r++){o=t[r];u=o.event;a=e(n[r]);f=i("eventRender",u,u,a);if(f===!1)a.remove();else{if(f&&f!==!0){f=e(f).css({position:"absolute",left:o.left});a.replaceWith(f);a=f}o.element=a}}}function P(e){var t,n=e.length,r,i;for(t=0;t<n;t++){r=e[t];i=r.element;i&&a(r.event,i)}}function H(e,t,n){var r,i=e.length,s,o,u;for(r=0;r<i;r++){s=e[r];o=s.element;if(o){u=s.event;u._id===n?N(u,o,s):o[0]._fci=r}}I(t,e,N)}function B(e){var n,r=e.length,i,s,o,u,a={};for(n=0;n<r;n++){i=e[n];s=i.element;if(s){o=i.key=rt(s[0]);u=a[o];u===t&&(u=a[o]=U(s,!0));i.hsides=u}}}function j(e){var t,n=e.length,r,i;for(t=0;t<n;t++){r=e[t];i=r.element;i&&(i[0].style.width=Math.max(0,r.outerWidth-r.hsides)+"px")}}function F(e){var n,r=e.length,i,s,o,u,a={};for(n=0;n<r;n++){i=e[n];s=i.element;if(s){o=i.key;u=a[o];u===t&&(u=a[o]=J(s));i.outerHeight=s[0].offsetHeight+u}}}function q(){var e,t=h(),n=[];for(e=0;e<t;e++)n[e]=v(e).find("td:first div.fc-day-content > div");return n}function R(e){var t,n=e.length,r=[];for(t=0;t<n;t++)r[t]=e[t][0].offsetTop;return r}function z(e,t){var n,r=e.length,s,o,u;for(n=0;n<r;n++){s=e[n];o=s.element;if(o){o[0].style.top=t[s.row]+(s.top||0)+"px";u=s.event;i("eventAfterRender",u,u,o)}}}function W(t,s,o){var a=r("isRTL"),d=a?"w":"e",v=s.find("div.ui-resizable-"+d),m=!1;it(s);s.mousedown(function(e){e.preventDefault()}).click(function(e){if(m){e.preventDefault();e.stopImmediatePropagation()}});v.mousedown(function(r){function P(n){i("eventResizeStop",this,t,n);e("body").css("cursor","");v.stop();L();C&&c(this,t,C,0,n);setTimeout(function(){m=!1},0)}if(r.which!=1)return;m=!0;var v=n.getHoverListener(),g=h(),b=p(),w=a?-1:1,T=a?b-1:0,N=s.css("top"),C,O,_=e.extend({},t),D=E(t.start);A();e("body").css("cursor",d+"-resize").one("mouseup",P);i("eventResizeStart",this,t,r);v.start(function(e,n){if(e){var r=Math.max(D.row,e.row),i=e.col;g==1&&(r=0);r==D.row&&(a?i=Math.min(D.col,i):i=Math.max(D.col,i));C=r*7+i*w+T-(n.row*7+n.col*w+T);var s=y(u(t),C,!0);if(C){_.end=s;var c=O;O=M(x([_]),o.row,N);O.find("*").css("cursor",d+"-resize");c&&c.remove();l(t)}else if(O){f(t);O.remove();O=null}L();k(t.start,y(S(s),1))}},r)})}var n=this;n.renderDaySegs=O;n.resizableDayEvent=W;var r=n.opt,i=n.trigger,s=n.isEventDraggable,o=n.isEventResizable,u=n.eventEnd,a=n.reportEventElement,f=n.showEvents,l=n.hideEvents,c=n.eventResize,h=n.getRowCnt,p=n.getColCnt,d=n.getColWidth,v=n.allDayRow,m=n.allDayBounds,g=n.colContentLeft,b=n.colContentRight,w=n.dayOfWeekCol,E=n.dateCell,x=n.compileDaySegs,T=n.getDaySegmentContainer,N=n.bindDaySeg,C=n.calendar.formatDates,k=n.renderDayOverlay,L=n.clearOverlays,A=n.clearSelection}function St(){function a(e,t,n){f();t||(t=i(e,n));s(e,t,n);l(e,t,n)}function f(e){if(u){u=!1;o();r("unselect",null,e)}}function l(e,t,n,i){u=!0;r("select",null,e,t,n,i)}function c(r){var i=t.cellDate,u=t.cellIsAllDay,a=t.getHoverListener(),c=t.reportDayClick;if(r.which==1&&n("selectable")){f(r);var h=this,p;a.start(function(e,t){o();if(e&&u(e)){p=[i(t),i(e)].sort(Y);s(p[0],p[1],!0)}else p=null},r);e(document).one("mouseup",function(e){a.stop();if(p){+p[0]==+p[1]&&c(p[0],!0,e);l(p[0],p[1],!0,e)}})}}var t=this;t.select=a;t.unselect=f;t.reportSelection=l;t.daySelectionMousedown=c;var n=t.opt,r=t.trigger,i=t.defaultSelectionEnd,s=t.renderSelection,o=t.clearSelection,u=!1;n("selectable")&&n("unselectAuto")&&e(document).mousedown(function(t){var r=n("unselectCancel");if(r&&e(t.target).parents(r).length)return;f(t)})}function xt(){function i(t,i){var s=r.shift();s||(s=e("<div class='fc-cell-overlay' style='position:absolute;z-index:3'/>"));s[0].parentNode!=i[0]&&s.appendTo(i);n.push(s.css(t).show());return s}function s(){var e;while(e=n.shift())r.push(e.hide().unbind())}var t=this;t.renderOverlay=i;t.clearOverlays=s;var n=[],r=[]}function Tt(e){var t=this,n,r;t.build=function(){n=[];r=[];e(n,r)};t.cell=function(e,t){var i=n.length,s=r.length,o,u=-1,a=-1;for(o=0;o<i;o++)if(t>=n[o][0]&&t<n[o][1]){u=o;break}for(o=0;o<s;o++)if(e>=r[o][0]&&e<r[o][1]){a=o;break}return u>=0&&a>=0?{row:u,col:a}:null};t.rect=function(e,t,i,s,o){var u=o.offset();return{top:n[e][0]-u.top,left:r[t][0]-u.left,width:r[s][1]-r[t][0],height:n[i][1]-n[e][0]}}}function Nt(t){function u(e){Ct(e);var n=t.cell(e.pageX,e.pageY);if(!n!=!o||n&&(n.row!=o.row||n.col!=o.col)){if(n){s||(s=n);i(n,s,n.row-s.row,n.col-s.col)}else i(n,s);o=n}}var n=this,r,i,s,o;n.start=function(n,a,f){i=n;s=o=null;t.build();u(a);r=f||"mousemove";e(document).bind(r,u)};n.stop=function(){e(document).unbind(r,u);return o}}function Ct(e){if(e.pageX===t){e.pageX=e.originalEvent.pageX;e.pageY=e.originalEvent.pageY}}function kt(e){function o(t){return r[t]=r[t]||e(t)}var n=this,r={},i={},s={};n.left=function(e){return i[e]=i[e]===t?o(e).position().left:i[e]};n.right=function(e){return s[e]=s[e]===t?n.left(e)+o(e).width():s[e]};n.clear=function(){r={};i={};s={}}}var n={defaultView:"month",aspectRatio:1.35,header:{left:"title",center:"",right:"today prev,next"},weekends:!0,allDayDefault:!0,ignoreTimezone:!0,lazyFetching:!0,startParam:"start",endParam:"end",titleFormat:{month:"MMMM yyyy",week:"MMM d[ yyyy]{ '&#8212;'[ MMM] d yyyy}",day:"dddd, MMM d, yyyy"},columnFormat:{month:"ddd",week:"ddd M/d",day:"dddd M/d"},timeFormat:{"":"h(:mm)t"},isRTL:!1,firstDay:0,monthNames:["January","February","March","April","May","June","July","August","September","October","November","December"],monthNamesShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],dayNames:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],dayNamesShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],buttonText:{prev:"&nbsp;&#9668;&nbsp;",next:"&nbsp;&#9658;&nbsp;",prevYear:"&nbsp;&lt;&lt;&nbsp;",nextYear:"&nbsp;&gt;&gt;&nbsp;",today:"today",month:"month",week:"week",day:"day"},theme:!1,buttonIcons:{prev:"circle-triangle-w",next:"circle-triangle-e"},unselectAuto:!0,dropAccept:"*"},r={header:{left:"next,prev today",center:"",right:"title"},buttonText:{prev:"&nbsp;&#9658;&nbsp;",next:"&nbsp;&#9668;&nbsp;",prevYear:"&nbsp;&gt;&gt;&nbsp;",nextYear:"&nbsp;&lt;&lt;&nbsp;"},buttonIcons:{prev:"circle-triangle-e",next:"circle-triangle-w"}},i=e.fullCalendar={version:"1.5.4"},s=i.views={};e.fn.fullCalendar=function(i){if(typeof i=="string"){var s=Array.prototype.slice.call(arguments,1),o;this.each(function(){var n=e.data(this,"fullCalendar");if(n&&e.isFunction(n[i])){var r=n[i].apply(n,s);o===t&&(o=r);i=="destroy"&&e.removeData(this,"fullCalendar")}});return o!==t?o:this}var a=i.eventSources||[];delete i.eventSources;if(i.events){a.push(i.events);delete i.events}i=e.extend(!0,{},n,i.isRTL||i.isRTL===t&&n.isRTL?r:{},i);this.each(function(t,n){var r=e(n),s=new u(r,i,a);r.data("fullCalendar",s);s.render()});return this};i.sourceNormalizers=[];i.sourceFetchers=[];var f={dataType:"json",cache:!1},l=1;i.addDays=y;i.cloneDate=S;i.parseDate=k;i.parseISO8601=L;i.parseTime=A;i.formatDate=O;i.formatDates=M;var h=["sun","mon","tue","wed","thu","fri","sat"],p=864e5,d=36e5,v=6e4,_={s:function(e){return e.getSeconds()},ss:function(e){return et(e.getSeconds())},m:function(e){return e.getMinutes()},mm:function(e){return et(e.getMinutes())},h:function(e){return e.getHours()%12||12},hh:function(e){return et(e.getHours()%12||12)},H:function(e){return e.getHours()},HH:function(e){return et(e.getHours())},d:function(e){return e.getDate()},dd:function(e){return et(e.getDate())},ddd:function(e,t){return t.dayNamesShort[e.getDay()]},dddd:function(e,t){return t.dayNames[e.getDay()]},M:function(e){return e.getMonth()+1},MM:function(e){return et(e.getMonth()+1)},MMM:function(e,t){return t.monthNamesShort[e.getMonth()]},MMMM:function(e,t){return t.monthNames[e.getMonth()]},yy:function(e){return(e.getFullYear()+"").substring(2)},yyyy:function(e){return e.getFullYear()},t:function(e){return e.getHours()<12?"a":"p"},tt:function(e){return e.getHours()<12?"am":"pm"},T:function(e){return e.getHours()<12?"A":"P"},TT:function(e){return e.getHours()<12?"AM":"PM"},u:function(e){return O(e,"yyyy-MM-dd'T'HH:mm:ss'Z'")},S:function(e){var t=e.getDate();return t>10&&t<20?"th":["st","nd","rd"][t%10-1]||"th"}};i.applyAll=at;s.month=lt;s.basicWeek=ct;s.basicDay=ht;o({weekMode:"fixed"});s.agendaWeek=vt;s.agendaDay=mt;o({allDaySlot:!0,allDayText:"all-day",firstHour:6,slotMinutes:30,defaultEventMinutes:120,axisFormat:"h(:mm)tt",timeFormat:{agenda:"h:mm{ - h:mm}"},dragOpacity:{agenda:.5},minTime:0,maxTime:24})})(jQuery);