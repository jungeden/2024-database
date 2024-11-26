// 페이지별 고유 키 생성
const key = `scrollPosition_${location.pathname}`;

// 스크롤 위치 저장
window.addEventListener("beforeunload", () => {
  const scrollPosition = window.scrollY;
  localStorage.setItem(key, scrollPosition);
});

// 스크롤 위치 복원
window.addEventListener("load", () => {
  const savedPosition = localStorage.getItem(key);
  if (savedPosition) {
    window.scrollTo(0, parseInt(savedPosition, 10));
  }
});
