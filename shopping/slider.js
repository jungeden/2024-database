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

  // 슬라이더의 초기 상태 설정
  $slider.css({
    position: "relative",
    width: settings.width,
    height: settings.height,
    overflow: "hidden",
  });

  $images.css({
    display: "flex",
    width: settings.width * (imageCount + 1), // 마지막에 첫 번째 이미지를 복제하기 때문에 추가
    position: "relative",
    transition: "left 0.5s ease-in-out",
  });

  $imageItems.css({
    flex: "none",
    width: settings.width,
    height: settings.height,
  });

  // 마지막에 첫 번째 이미지 복제(무한 스크롤 효과)
  const $firstClone = $imageItems.first().clone();
  $images.append($firstClone);

  // 네비게이션 버튼 추가
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

  // 슬라이더 이동 함수
  function updateSlider() {
    const newLeft = -currentIndex * settings.width;
    $images.css("left", newLeft + "px");

    // 버튼 활성화 상태 업데이트
    $buttonContainer.find("button").removeClass("active");
    $buttonContainer
      .find(`button[data-index=${currentIndex % imageCount}]`)
      .addClass("active");
  }

  // 슬라이더 이동이 끝난 후 처리(무한 스크롤)
  $images.on("transitionend", function () {
    if (currentIndex === imageCount) {
      $images.css("transition", "none");
      $images.css("left", "0px");
      currentIndex = 0;

      // 다시 transition 설정 복원
      setTimeout(() => {
        $images.css("transition", "left 0.5s ease-in-out");
      });
    }
  });

  // 자동 슬라이더
  setInterval(function () {
    currentIndex = (currentIndex + 1) % (imageCount + 1);
    updateSlider();
  }, 3000);

  // 초기 활성 버튼
  updateSlider();
};

// $.fn.imageSlider = function (options) {
//   const settings = $.extend(
//     {
//       width: 1050,
//       height: 400,
//     },
//     options
//   );

//   const $slider = this;
//   const $images = $slider.find(".images");
//   const $imageItems = $images.find(".image");
//   const imageCount = $imageItems.length;
//   let currentIndex = 0;

//   // 초기화
//   $slider.css({
//     position: "relative",
//     width: settings.width,
//     height: settings.height,
//     overflow: "hidden",
//   });

//   $images.css({
//     display: "flex",
//     width: settings.width * imageCount,
//     position: "relative",
//     transition: "left 0.5s ease-in-out",
//   });

//   $imageItems.css({
//     flex: "none",
//     width: settings.width,
//     height: settings.height,
//   });

//   // 버튼 추가
//   const $buttonContainer = $("<div>").addClass("slider-buttons");
//   for (let i = 0; i < imageCount; i++) {
//     const $button = $("<button>")
//       .attr("data-index", i)
//       .text(i + 1)
//       .on("click", function () {
//         currentIndex = parseInt($(this).attr("data-index"));
//         updateSlider();
//       });
//     $buttonContainer.append($button);
//   }
//   $slider.append($buttonContainer);

//   // 슬라이더 업데이트 함수
//   function updateSlider() {
//     const newLeft = -currentIndex * settings.width;
//     $images.css("left", newLeft + "px");

//     $buttonContainer.find("button").removeClass("active");
//     $buttonContainer
//       .find(`button[data-index=${currentIndex}]`)
//       .addClass("active");
//   }

//   // 자동 슬라이더
//   setInterval(function () {
//     currentIndex = (currentIndex + 1) % imageCount;
//     updateSlider();
//   }, 3000);

//   // 초기 활성 버튼
//   updateSlider();
// };
