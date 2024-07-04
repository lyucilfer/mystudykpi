let toggleBtn = document.getElementById('toggle-btn');
let body = document.body;
let darkMode = localStorage.getItem('dark-mode');
let logoImg = document.getElementById('logoImg');

const enableDarkMode = () => {
   toggleBtn.classList.replace('fa-sun', 'fa-moon');
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
   if (logoImg) {
      logoImg.src = 'img/darkmode_logo.png';
   }
}

const disableDarkMode = () => {
   toggleBtn.classList.replace('fa-moon', 'fa-sun');
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
   if (logoImg) {
      logoImg.src = 'img/lightmode_logo.png';
   }
}

if (darkMode === 'enabled') {
   enableDarkMode();
}

toggleBtn.onclick = (e) => {
   darkMode = localStorage.getItem('dark-mode');
   if (darkMode === 'disabled') {
      enableDarkMode();
   } else {
      disableDarkMode();
   }
}

document.getElementById('toggle-btn').addEventListener('click', function () {
    document.body.classList.toggle('dark-mode');
});

document.getElementById('menu-btn').addEventListener('click', function () {
    document.getElementById('overlay').style.display = 'block';
    document.body.classList.add('sidebar-active');
});

document.getElementById('close-btn').addEventListener('click', function () {
    document.getElementById('overlay').style.display = 'none';
    document.body.classList.remove('sidebar-active');
});

let profile = document.querySelector('.header .flex .profile');
let search = document.querySelector('.header .flex .search-form');
let sideBar = document.querySelector('.side-bar');

document.querySelector('#user-btn').onclick = () => {
   profile.classList.toggle('active');
   search.classList.remove('active');
}

document.querySelector('#menu-btn').onclick = () => {
   sideBar.classList.toggle('active');
   body.classList.toggle('active');
   body.classList.toggle('sidebar-active');
   searchForm.classList.remove('active');
}

document.querySelector('#close-btn').onclick = () => {
   sideBar.classList.remove('active');
   body.classList.remove('active');
   body.classList.remove('sidebar-active');
}

window.onscroll = () => {
   profile.classList.remove('active');
   search.classList.remove('active');

   if (window.innerWidth < 1200) {
      sideBar.classList.remove('active');
      body.classList.remove('active');
   }
}
