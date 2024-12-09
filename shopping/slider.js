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

  // 초기화
  $slider.css({
    position: "relative",
    width: settings.width,
    height: settings.height,
    overflow: "hidden",
  });

  $images.css({
    display: "flex",
    width: settings.width * imageCount,
    position: "relative",
    transition: "left 0.5s ease-in-out",
  });

  $imageItems.css({
    flex: "none",
    width: settings.width,
    height: settings.height,
  });

  // 버튼 추가
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

  // 슬라이더 업데이트 함수
  function updateSlider() {
    const newLeft = -currentIndex * settings.width;
    $images.css("left", newLeft + "px");

    $buttonContainer.find("button").removeClass("active");
    $buttonContainer
      .find(`button[data-index=${currentIndex}]`)
      .addClass("active");
  }

  // 자동 슬라이더
  setInterval(function () {
    currentIndex = (currentIndex + 1) % imageCount;
    updateSlider();
  }, 3000);

  // 초기 활성 버튼
  updateSlider();
};
