function toggleMenu() {
    const menu = document.getElementById("profileMenu");
    menu.classList.toggle("hidden");  // hiddenクラスをトグルして表示/非表示を切り替える
}

document.addEventListener('DOMContentLoaded', () => {
    const hamburgerBtn = document.querySelector('.hamburger-btn');
    hamburgerBtn.addEventListener('click', toggleMenu);  // ボタンにクリックイベントリスナーを追加
});

