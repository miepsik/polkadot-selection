"use strict";

/* animate on scroll behaviors */
AOS.init({
  // Global settings:
  disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
  startEvent: "DOMContentLoaded", // name of the event dispatched on the document, that AOS should initialize on
  initClassName: "aos-init", // class applied after initialization
  animatedClassName: "aos-animate", // class applied on animation
  useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
  disableMutationObserver: false, // disables automatic mutations' detections (advanced)
  debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
  throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)

  // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
  offset: 120, // offset (in px) from the original trigger point
  delay: 0, // values from 0 to 3000, with step 50ms
  duration: 800, // values from 0 to 3000, with step 50ms
  easing: "ease", // default easing for AOS animations
  once: true, // whether animation should happen only once - while scrolling down
  mirror: false, // whether elements should animate out while scrolling past them
  anchorPlacement: "top-bottom", // defines which position of the element regarding to window should trigger the animation
});

var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $("header").outerHeight();
var navbarSecondaryHeight = $(".navbar--secondary").outerHeight();

$(document).ready(function () {
  // AdjustHeader();
  // HideNotification();
});

$(window).scroll(function (event) {
  // didScroll = true;
  // HideNotification();
  // ShowSupportIcon();
});

setInterval(function () {
  // if (didScroll) {
  //   AdjustHeader();
  //   hasScrolled();
  //   didScroll = false;
  // }
}, 100);

function hasScrolled() {
  var st = $(window).scrollTop();
  if (Math.abs(lastScrollTop - st) <= delta) return;
  if (st > lastScrollTop && st > navbarHeight) {
    // Scroll Down
    $("header").removeClass("nav-down").addClass("nav-up");
  } else {
    // Scroll Up
    if (st + $(window).height() < $(document).height()) {
      $("header").removeClass("nav-up").addClass("nav-down");
    }
  }

  lastScrollTop = st;
}

function AdjustHeader() {
  if ($(window).scrollTop() > navbarSecondaryHeight) {
    if (!$("header").hasClass("nav-primary-fixed")) {
      $("header").addClass("nav-primary-fixed");
    }
  } else {
    $("header").removeClass("nav-primary-fixed");
  }
}

function ShowSupportIcon() {
  if ($(window).scrollTop() > 400) {
    $("#support-icon").addClass("is-visible");
  } else {
    $("#support-icon").removeClass("is-visible");
  }
}

function HideNotification() {
  if ($(".js-notification").length)
    if ($(window).scrollTop() > $("#home-network").offset().top)
      $(".js-notification").removeClass("is-visible");
    else $(".js-notification").addClass("is-visible");
}

if (document.getElementById("main-nav")) {
  NavDotSpeed();
}

function NavDotSpeed() {
  let speed = 542;
  let navLinks = document
    .getElementById("main-nav")
    .querySelectorAll(".nav-link");
  for (let i = 0; i < navLinks.length; i++) {
    let distance = navLinks[i].offsetWidth;
    let duration = distance / speed;
    navLinks[i].style.setProperty("--dot-animation-duration", duration + "s");
  }
}

/* init image gallery */
var images = document.querySelectorAll(".kg-gallery-image img");
if (images && images.length) {
  images.forEach(function (image) {
    var container = image.closest(".kg-gallery-image");
    var width = image.attributes.width.value;
    var height = image.attributes.height.value;
    var ratio = width / height;
    container.style.flex = ratio + " 1 0%";
  });
}

/* hot-change dates format */
var dates = document.querySelectorAll(".date-i18n");
if (dates && dates.length) {
  dates.forEach(function (date) {
    var dateObject = new Date(Date.parse(date.innerHTML));
    var options = { year: "numeric", month: "long", day: "numeric" };
    var language = date.dataset.lang;
    date.innerHTML = dateObject.toLocaleDateString(language, options);
  });
}

/*
   Replace `DOM[sa-event-name]` with a call to SA;
   a DOM element can have
   -`sa-event-name`
   - `sa-event-href` || `href` (if anchor)
*/
const handleAnalyticsElementClick = (event) => {
  event.preventDefault();
  const $el = event.currentTarget;

  const eventName = $el.getAttribute("sa-event-name");
  const eventHref =
    $el.getAttribute("href") || $el.getAttribute("sa-event-href");
  const eventData = eventName && eventHref;
  const eventTracked =
    window.sa_event && window.sa_event_loaded && !navigator.doNotTrack;
  if (eventData && eventTracked) {
    window.sa_event(eventName, () => {
      window.location.href = eventHref;
    });
  } else {
    window.location.href = eventHref;
  }
};

/* find all DOM elements with attribute `sa-event-name`;
   and replace their click handler by a SA click wrapper */
const analyticsElements = document.querySelectorAll("[sa-event-name]");
if (analyticsElements && analyticsElements.length) {
  analyticsElements.forEach((element) => {
    element.addEventListener("click", handleAnalyticsElementClick);
  });
}
