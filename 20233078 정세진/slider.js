$.fn.imageSlider = function (options) {
  const settings = $.extend(
    {
      width: 1050,
      height: 400,
    },
    options
  );

  const $slider = this;
  const $images = $slider.find(".images");
  const $imageItems = $images.find(".image");
  const imageCount = $imageItems.length;
  let currentIndex = 0;

  $slider.css({
    position: "relative",
    width: settings.width,
    height: settings.height,
    overflow: "hidden",
  });

  $images.css({
    display: "flex",
    width: settings.width * (imageCount + 1),
    position: "relative",
    transition: "left 0.5s ease-in-out",
  });

  $imageItems.css({
    flex: "none",
    width: settings.width,
    height: settings.height,
  });

  const $firstClone = $imageItems.first().clone();
  $images.append($firstClone);

  const $buttonContainer = $("<div>").addClass("slider-buttons");
  for (let i = 0; i < imageCount; i++) {
    const $button = $("<button>")
      .attr("data-index", i)
      .text(i + 1)
      .on("click", function () {
        currentIndex = parseInt($(this).attr("data-index"));
        updateSlider();
      });
    $buttonContainer.append($button);
  }
  $slider.append($buttonContainer);

  function updateSlider() {
    const newLeft = -currentIndex * settings.width;
    $images.css("left", newLeft + "px");

    $buttonContainer.find("button").removeClass("active");
    $buttonContainer
      .find(`button[data-index=${currentIndex % imageCount}]`)
      .addClass("active");
  }

  $images.on("transitionend", function () {
    if (currentIndex === imageCount) {
      $images.css("transition", "none");
      $images.css("left", "0px");
      currentIndex = 0;

      setTimeout(() => {
        $images.css("transition", "left 0.5s ease-in-out");
      });
    }
  });

  setInterval(function () {
    currentIndex = (currentIndex + 1) % (imageCount + 1);
    updateSlider();
  }, 3000);

  updateSlider();
};
